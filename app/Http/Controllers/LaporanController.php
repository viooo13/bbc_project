<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        // Total penjualan keseluruhan
        $totalSales = Pesanan::where('status', 'completed')->sum('total_price');

        // Penjualan per tahun
        $yearlySales = Pesanan::where('status', 'completed')
            ->selectRaw('YEAR(created_at) as year, SUM(total_price) as total, COUNT(*) as orders')
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->get();

        // Penjualan paket bakso
        $paketSales = 0;
        $paketOrders = Pesanan::where('status', 'completed')->get();

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
        $currentMonthSales = Pesanan::where('status', 'completed')
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->sum('total_price');

        // Penjualan bulan lalu
        $lastMonth = now()->subMonth();
        $lastMonthSales = Pesanan::where('status', 'completed')
            ->whereYear('created_at', $lastMonth->year)
            ->whereMonth('created_at', $lastMonth->month)
            ->sum('total_price');

        return view('admin.laporan.index', compact(
            'totalSales',
            'yearlySales',
            'paketSales',
            'yearlyPaketSales',
            'currentMonthSales',
            'lastMonthSales'
        ));
    }
}