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

        return view('transaksi', [
            'pesanan' => $pesanan,
        ]);
    }

    public function pay(Request $request, string $orderId)
    {
        $pesanan = Pesanan::where('order_id', $orderId)->firstOrFail();

        if ($pesanan->status === 'pending') {
            $pesanan->update(['status' => 'confirmed']);

            // Proses Kirim Notifikasi WA ke Nomor Admin Otomatis
            // Menggunakan Fonnte (Satu Nomor Pengirim/Bot, Satu Nomor Admin/Penerima)
            $nomorAdmin = ''; 
            $tokenFonnte = 'iVYAMrABUfg37ybY3mMp'; // Ganti dengan Token Fonnte akun Bot (Pengirim)
            $pesan = "Halo Admin, pesanan baru ID *{$pesanan->order_id}* a/n *{$pesanan->customer_name}* senilai Rp " . number_format($pesanan->total_price, 0, ',', '.') . " telah dibayar dan siap diproses.\n\nSilakan cek Dashboard!";

            try {
                $response = Http::withHeaders([
                    'Authorization' => $tokenFonnte,
                ])->post('https://api.fonnte.com/send', [
                    'target' => $nomorAdmin,
                    'message' => $pesan,
                ]);
                
                Log::info("Notifikasi WA terkirim ke {$nomorAdmin}. Response: " . $response->body());
            } catch (\Exception $e) {
                Log::error("Gagal kirim notifikasi WA: " . $e->getMessage());
            }
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
}
