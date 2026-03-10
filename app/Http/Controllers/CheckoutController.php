<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    private function getCart(Request $request): array
    {
        return $request->session()->get('cart', []);
    }

    private function cartItems(array $cart): array
    {
        return array_values($cart);
    }

    private function subtotal(array $items): float
    {
        $subtotal = 0;
        foreach ($items as $item) {
            $subtotal += ((float) ($item['price'] ?? 0)) * ((int) ($item['quantity'] ?? 0));
        }
        return (float) $subtotal;
    }

    public function index(Request $request)
    {
        $items = $this->cartItems($this->getCart($request));
        $subtotal = $this->subtotal($items);

        return view('checkout', [
            'items' => $items,
            'subtotal' => $subtotal,
        ]);
    }

    public function store(Request $request)
    {
        $items = $this->cartItems($this->getCart($request));
        if (count($items) === 0) {
            return redirect()->route('cart.index');
        }

        $data = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:50',
            'customer_email' => 'required|email|max:255',
            'event_name' => 'nullable|string|max:255',
            'event_date' => 'nullable|date',
            'delivery_time' => 'nullable|string|max:50',
            'delivery_address' => 'nullable|string|max:1000',
            'delivery_method' => 'nullable|string|max:100',
            'payment_method' => 'nullable|string|max:100',
            'notes' => 'nullable|string|max:2000',
        ]);

        $subtotal = $this->subtotal($items);

        $orderId = 'ORD-' . now()->format('YmdHis') . '-' . Str::upper(Str::random(5));

        Pesanan::create([
            'order_id' => $orderId,
            'customer_name' => $data['customer_name'],
            'customer_email' => $data['customer_email'],
            'customer_phone' => $data['customer_phone'],
            'total_price' => $subtotal,
            'items' => $items,
            'special_request' => json_encode([
                'event_name' => $data['event_name'] ?? null,
                'event_date' => $data['event_date'] ?? null,
                'delivery_time' => $data['delivery_time'] ?? null,
                'delivery_address' => $data['delivery_address'] ?? null,
                'delivery_method' => $data['delivery_method'] ?? null,
                'payment_method' => $data['payment_method'] ?? null,
                'notes' => $data['notes'] ?? null,
            ]),
            'status' => 'pending',
        ]);

        $request->session()->put('cart', []);

        return redirect()->route('transaksi.show', ['orderId' => $orderId]);
    }
}
