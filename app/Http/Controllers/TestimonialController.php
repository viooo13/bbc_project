<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'nullable|string|max:255',
            'customer_name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'required|string|max:2000',
        ]);

        Testimonial::create([
            'order_id' => $validated['order_id'] ?? null,
            'customer_name' => $validated['customer_name'],
            'rating' => (int) $validated['rating'],
            'content' => $validated['content'],
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Terima kasih! Testimoni berhasil dikirim.',
            ]);
        }

        return redirect()->route('home')->with('success', 'Testimoni berhasil dikirim.');
    }
}
