<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function show(Request $request, string $orderId)
    {
        $pesanan = Pesanan::where('order_id', $orderId)->firstOrFail();

        return view('transaksi', [
            'pesanan' => $pesanan,
        ]);
    }
}
