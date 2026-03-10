<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pesanans = Pesanan::all();
        
        // Group by status for stats
        $stats = [
            'pending' => Pesanan::where('status', 'pending')->count(),
            'confirmed' => Pesanan::where('status', 'confirmed')->count(),
            'shipped' => Pesanan::where('status', 'shipped')->count(),
            'completed' => Pesanan::where('status', 'completed')->count(),
            'rejected' => Pesanan::where('status', 'rejected')->count(),
        ];

        return view('admin.pesanan.index', compact('pesanans', 'stats'));
    }

    /**
     * Show the form for viewing the specified resource.
     */
    public function show($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        return view('admin.pesanan.show', compact('pesanan'));
    }

    /**
     * Confirm the specified resource.
     */
    public function confirm($id)
    {
        Pesanan::findOrFail($id)->update(['status' => 'confirmed']);
        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dikonfirmasi');
    }

    /**
     * Reject the specified resource.
     */
    public function reject($id, Request $request)
    {
        $request->validate([
            'reason' => 'required|string'
        ]);

        Pesanan::findOrFail($id)->update(['status' => 'rejected']);

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil ditolak');
    }

    /**
     * Ship the specified resource.
     */
    public function ship($id)
    {
        Pesanan::findOrFail($id)->update(['status' => 'shipped']);
        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dikirim');
    }

    /**
     * Complete the specified resource.
     */
    public function complete($id)
    {
        Pesanan::findOrFail($id)->update(['status' => 'completed']);
        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil diselesaikan');
    }

    /**
     * Dummy payment confirmation (no payment gateway).
     */
    public function paid($id)
    {
        $pesanan = Pesanan::findOrFail($id);

        if ($pesanan->status !== 'confirmed') {
            return redirect()->route('pesanan.index')->with('success', 'Status pesanan tidak bisa ditandai sudah dibayar.');
        }

        $pesanan->update(['status' => 'completed']);

        return redirect()->route('pesanan.index')->with('success', 'Pembayaran dikonfirmasi. Pesanan ditandai selesai.');
    }
}

