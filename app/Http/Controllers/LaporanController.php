<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    private function applyFilters($query, Request $request)
    {
        $q = trim((string) $request->query('q', ''));
        $from = $request->query('from');
        $to = $request->query('to');

        if ($q !== '') {
            $query->where(function ($sub) use ($q) {
                $sub->where('order_id', 'like', "%{$q}%")
                    ->orWhere('customer_name', 'like', "%{$q}%");
            });
        }

        if (!empty($from)) {
            $query->whereDate('created_at', '>=', $from);
        }

        if (!empty($to)) {
            $query->whereDate('created_at', '<=', $to);
        }

        return $query;
    }

    public function index(Request $request)
    {
        $baseQuery = Pesanan::where('status', 'completed');
        $baseQuery = $this->applyFilters($baseQuery, $request);

        $completedOrders = (clone $baseQuery)->orderByDesc('created_at')->get();

        // Total penjualan keseluruhan (filtered)
        $totalSales = (clone $baseQuery)->sum('total_price');

        // Penjualan per tahun (filtered)
        $yearlySales = (clone $baseQuery)
            ->selectRaw('YEAR(created_at) as year, SUM(total_price) as total, COUNT(*) as orders')
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->get();

        // Penjualan paket bakso
        $paketSales = 0;
        $paketOrders = (clone $baseQuery)->get();

        foreach ($paketOrders as $order) {
            foreach ($order->items as $item) {
                if (isset($item['type']) && $item['type'] === 'paket') {
                    $paketSales += ($item['price'] ?? 0) * ($item['quantity'] ?? 0);
                }
            }
        }

        // Penjualan paket per tahun
        $yearlyPaketSales = [];
        foreach ($paketOrders as $order) {
            $year = $order->created_at->year;
            if (!isset($yearlyPaketSales[$year])) {
                $yearlyPaketSales[$year] = 0;
            }
            foreach ($order->items as $item) {
                if (isset($item['type']) && $item['type'] === 'paket') {
                    $yearlyPaketSales[$year] += ($item['price'] ?? 0) * ($item['quantity'] ?? 0);
                }
            }
        }

        // Penjualan bulan ini
        $currentMonthSales = (clone $baseQuery)
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->sum('total_price');

        // Penjualan bulan lalu
        $lastMonth = now()->subMonth();
        $lastMonthSales = (clone $baseQuery)
            ->whereYear('created_at', $lastMonth->year)
            ->whereMonth('created_at', $lastMonth->month)
            ->sum('total_price');

        return view('admin.laporan.index', compact(
            'completedOrders',
            'totalSales',
            'yearlySales',
            'paketSales',
            'yearlyPaketSales',
            'currentMonthSales',
            'lastMonthSales'
        ));
    }

    public function export(Request $request)
    {
        $query = Pesanan::where('status', 'completed');
        $query = $this->applyFilters($query, $request);
        $orders = $query->orderByDesc('created_at')->get();

        $filename = 'laporan-penjualan-' . now()->format('Y-m-d_H-i-s') . '.csv';

        return response()->streamDownload(function () use ($orders) {
            $out = fopen('php://output', 'w');
            fwrite($out, "\xEF\xBB\xBF");

            fputcsv($out, ['ID Pesanan', 'Tanggal', 'Pelanggan', 'Telepon', 'Email', 'Qty', 'Total', 'Item Ringkas'], ';');

            foreach ($orders as $o) {
                $items = is_array($o->items ?? null) ? $o->items : [];
                $qty = 0;
                $parts = [];

                foreach ($items as $it) {
                    $q = (int) ($it['quantity'] ?? 0);
                    $qty += $q;
                    $name = (string) ($it['name'] ?? ($it['title'] ?? 'Item'));
                    if ($q > 0) {
                        $parts[] = $name . ' x' . $q;
                    } else {
                        $parts[] = $name;
                    }
                }

                $summary = implode(', ', $parts);

                fputcsv($out, [
                    (string) ($o->order_id ?? ''),
                    optional($o->created_at)->format('Y-m-d H:i:s') ?? '',
                    (string) ($o->customer_name ?? ''),
                    (string) ($o->customer_phone ?? ''),
                    (string) ($o->customer_email ?? ''),
                    $qty,
                    (float) ($o->total_price ?? 0),
                    $summary,
                ], ';');
            }

            fclose($out);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }
}