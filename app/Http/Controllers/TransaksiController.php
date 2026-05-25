<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $tab = $request->query('tab', 'semua');

        $baseQuery = Pesanan::query();
        if (!$user) {
            $baseQuery->whereRaw('1 = 0');
        } else {
            $baseQuery->where(function ($q) use ($user) {
                $q->where('user_id', $user->id);

                if (!empty($user->email)) {
                    $q->orWhere(function ($legacy) use ($user) {
                        $legacy->whereNull('user_id')
                            ->where('customer_email', $user->email);
                    });
                }

                if (!empty($user->phone)) {
                    $q->orWhere(function ($legacy) use ($user) {
                        $legacy->whereNull('user_id')
                            ->where('customer_phone', $user->phone);
                    });
                }
            });
        }
        $orderIds = (clone $baseQuery)->pluck('order_id')->filter();
        $reviewedOrderIds = $orderIds->isEmpty()
            ? []
            : Testimonial::whereIn('order_id', $orderIds)->pluck('order_id')->filter()->all();

        $query = clone $baseQuery;

        if ($tab === 'belum-dibayar') {
            $query->where('status', 'pending');
        } elseif ($tab === 'menunggu-konfirmasi') {
            $query->whereIn('status', ['paid', 'rejected']);
        } elseif ($tab === 'diproses') {
            $query->whereIn('status', ['confirmed', 'shipped']);
        } elseif ($tab === 'selesai') {
            $query->where('status', 'completed');
            if (!empty($reviewedOrderIds)) {
                $query->whereNotIn('order_id', $reviewedOrderIds);
            }
        }

        $orders = $query->orderByDesc('created_at')->get();

        return view('user.pesanan', [
            'orders' => $orders,
            'tab' => $tab,
            'reviewedOrderIds' => $reviewedOrderIds,
        ]);
    }

    public function show(Request $request, string $orderId)
    {
        $pesanan = Pesanan::where('order_id', $orderId)->firstOrFail();

        // Generasi Midtrans Snap Token secara otomatis jika status pending
        if ($pesanan->status === 'pending' && !$pesanan->snap_token) {
            $snapToken = $this->generateMidtransSnapToken($pesanan);
            if ($snapToken) {
                $pesanan->update(['snap_token' => $snapToken]);
            }
        }

        return view('transaksi', [
            'pesanan' => $pesanan,
        ]);
    }

    /**
     * Re-generate Snap Token jika expired atau invalid.
     */
    public function regenerateSnapToken(Request $request, string $orderId)
    {
        $pesanan = Pesanan::where('order_id', $orderId)->firstOrFail();

        if ($pesanan->status !== 'pending') {
            return response()->json([
                'success' => false,
                'message' => 'Pesanan ini sudah tidak dalam status pending'
            ], 400);
        }

        // Force re-generate snap token
        $snapToken = $this->generateMidtransSnapToken($pesanan);
        if ($snapToken) {
            $pesanan->update(['snap_token' => $snapToken]);
            return response()->json([
                'success' => true,
                'snap_token' => $snapToken,
                'message' => 'Snap token berhasil di-regenerate'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Gagal men-generate token pembayaran. Silakan coba lagi.'
        ], 500);
    }


    public function pay(Request $request, string $orderId)
    {
        $pesanan = Pesanan::where('order_id', $orderId)->firstOrFail();

        if ($pesanan->status === 'pending') {
            $this->markOrderAsConfirmed($pesanan, 'Pembayaran');
        }

        return response()->json([
            'success' => true,
            'message' => 'Pembayaran berhasil dikonfirmasi',
            'order_id' => $pesanan->order_id,
            'customer_name' => $pesanan->customer_name,
            'total_price' => $pesanan->total_price,
            'items_count' => count(is_array($pesanan->items) ? $pesanan->items : []),
        ]);
    }

    public function syncStatus(Request $request, string $orderId)
    {
        $pesanan = Pesanan::where('order_id', $orderId)->firstOrFail();

        if ($pesanan->status !== 'pending' && $pesanan->status !== 'paid') {
            return response()->json([
                'success' => true,
                'message' => 'Status pesanan sudah terupdate',
                'status' => $pesanan->status
            ]);
        }

        $serverKey = config('services.midtrans.server_key');
        if (empty($serverKey)) {
            return response()->json([
                'success' => false,
                'message' => 'Konfigurasi Midtrans belum lengkap'
            ], 400);
        }

        try {
            $authHeader = base64_encode($serverKey . ':');
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic ' . $authHeader,
            ])->timeout(10)->get("https://api.sandbox.midtrans.com/v2/{$orderId}/status");

            if ($response->successful()) {
                $result = $response->json();
                $transactionStatus = $result['transaction_status'] ?? '';
                
                if ($transactionStatus === 'settlement' || $transactionStatus === 'capture') {
                    $this->markOrderAsConfirmed($pesanan, 'Midtrans QRIS');
                    return response()->json([
                        'success' => true,
                        'message' => 'Pembayaran berhasil dikonfirmasi',
                        'status' => 'confirmed'
                    ]);
                } elseif ($transactionStatus === 'pending') {
                    return response()->json([
                        'success' => true,
                        'message' => 'Pembayaran masih tertunda',
                        'status' => 'pending'
                    ]);
                } elseif (in_array($transactionStatus, ['deny', 'cancel', 'expire'])) {
                    $pesanan->update([
                        'status' => 'rejected',
                        'rejection_reason' => 'Pembayaran ditolak atau kedaluwarsa oleh sistem Midtrans'
                    ]);
                    return response()->json([
                        'success' => true,
                        'message' => 'Pembayaran ditolak atau kedaluwarsa',
                        'status' => 'rejected'
                    ]);
                }
            }
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal memverifikasi status pembayaran ke Midtrans'
            ], 500);

        } catch (\Exception $e) {
            Log::error('Midtrans Sync Status Error for order ' . $orderId . ': ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem saat memverifikasi pembayaran'
            ], 500);
        }
    }

    public function callback(Request $request)
    {
        $serverKey = config('services.midtrans.server_key');
        if (empty($serverKey)) {
            return response()->json(['message' => 'Config missing'], 500);
        }

        $json = $request->json()->all();
        
        $orderId = $json['order_id'] ?? '';
        $statusCode = $json['status_code'] ?? '';
        $grossAmount = $json['gross_amount'] ?? '';
        $signatureKey = $json['signature_key'] ?? '';
        $transactionStatus = $json['transaction_status'] ?? '';

        $localSignature = hash("sha512", $orderId . $statusCode . $grossAmount . $serverKey);
        
        if ($localSignature !== $signatureKey) {
            return response()->json(['message' => 'Invalid signature key'], 403);
        }

        $pesanan = Pesanan::where('order_id', $orderId)->first();
        if (!$pesanan) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        if ($pesanan->status === 'pending' || $pesanan->status === 'paid') {
            if ($transactionStatus === 'settlement' || $transactionStatus === 'capture') {
                $this->markOrderAsConfirmed($pesanan, 'Midtrans Webhook');
            } elseif (in_array($transactionStatus, ['deny', 'cancel', 'expire'])) {
                $pesanan->update([
                    'status' => 'rejected',
                    'rejection_reason' => 'Pembayaran ditolak atau kedaluwarsa oleh sistem Midtrans'
                ]);
            }
        }

        return response()->json(['message' => 'OK']);
    }

    private function initMidtrans()
    {
        \Midtrans\Config::$serverKey = config('services.midtrans.server_key');
        \Midtrans\Config::$isProduction = (bool) config('services.midtrans.is_production', false);
        \Midtrans\Config::$isSanitized = (bool) config('services.midtrans.is_sanitized', true);
        \Midtrans\Config::$is3ds = (bool) config('services.midtrans.is_3ds', true);
    }

    private function generateMidtransSnapToken(Pesanan $pesanan)
    {
        $serverKey = config('services.midtrans.server_key');
        if (empty($serverKey)) {
            return null;
        }

        try {
            $this->initMidtrans();

            $items = [];
            $orderItems = is_array($pesanan->items) ? $pesanan->items : [];
            foreach ($orderItems as $item) {
                $items[] = [
                    'id' => $item['id'] ?? uniqid('item_'),
                    'price' => (int) ($item['price'] ?? 0),
                    'quantity' => (int) ($item['quantity'] ?? 1),
                    'name' => substr($item['name'] ?? 'Product', 0, 50),
                ];
            }

            $params = [
                'transaction_details' => [
                    'order_id' => $pesanan->order_id,
                    'gross_amount' => (int) $pesanan->total_price,
                ],
                'item_details' => $items,
                'customer_details' => [
                    'first_name' => $pesanan->customer_name,
                    'email' => $pesanan->customer_email,
                    'phone' => $pesanan->customer_phone,
                ],

            ];

            return \Midtrans\Snap::getSnapToken($params);
        } catch (\Exception $e) {
            Log::error('Midtrans Snap Generation Error for order ' . $pesanan->order_id . ': ' . $e->getMessage());
            return null;
        }
    }

    private function markOrderAsConfirmed(Pesanan $pesanan, string $type = 'Pembayaran')
    {
        $pesanan->update(['status' => 'confirmed']);

        $nomorAdmin = '6282123368495'; 
        $tokenFonnte = 'bNje3r35BUGGfCq1o19M'; 
        $pesan = "📦 *Pesanan Baru Dikonfirmasi ({$type})*\n\n" .
                 "Order ID: {$pesanan->order_id}\n" .
                 "Customer: {$pesanan->customer_name}\n" .
                 "Total: Rp " . number_format($pesanan->total_price, 0, ',', '.') . "\n\n" .
                 "Status: {$type} Diterima\n\n" .
                 "Silakan verifikasi di dashboard admin.";

        try {
            $response = Http::withHeaders([
                'Authorization' => $tokenFonnte,
            ])->post('https://api.fonnte.com/send', [
                'target' => $nomorAdmin,
                'message' => $pesan,
                'countryCode' => '62',
            ]);
            
            Log::info("Notifikasi WA terkirim ke {$nomorAdmin}. Response: " . $response->body());
        } catch (\Exception $e) {
            Log::error("Gagal kirim notifikasi WA: " . $e->getMessage());
        }
    }




}
