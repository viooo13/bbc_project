<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\UserCart;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    private function getCart(Request $request): array
    {
        $user = $request->user();
        if ($user) {
            $userCart = UserCart::firstOrCreate(
                ['user_id' => $user->id],
                ['items' => []]
            );

            return is_array($userCart->items) ? $userCart->items : [];
        }

        return $request->session()->get('cart', []);
    }

    private function clearCart(Request $request): void
    {
        $user = $request->user();
        if ($user) {
            UserCart::updateOrCreate(
                ['user_id' => $user->id],
                ['items' => []]
            );
        }

        $request->session()->put('cart', []);
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
            'customer_phone' => ['required', 'string', 'max:50', 'regex:/^[0-9]+$/'],
            'customer_email' => 'required|email|max:255',
            'event_name' => 'required|string|max:255',
            'event_date' => 'required|date',
            'delivery_time' => 'required|string|max:50',
            'delivery_address' => 'required|string|max:1000',
            'latitude' => 'nullable|string',
            'longitude' => 'nullable|string',
            'delivery_method' => 'required|string|max:100',
            'payment_method' => 'required|string|max:100',
            'notes' => 'nullable|string|max:2000',
        ]);

        $subtotal = $this->subtotal($items);

        $orderId = 'ORD-' . now()->format('YmdHis') . '-' . Str::upper(Str::random(5));

        Pesanan::create([
            'user_id' => optional($request->user())->id,
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
                'latitude' => $data['latitude'] ?? null,
                'longitude' => $data['longitude'] ?? null,
                'delivery_method' => $data['delivery_method'] ?? null,
                'payment_method' => $data['payment_method'] ?? null,
                'notes' => $data['notes'] ?? null,
            ]),
            'status' => 'pending',
        ]);

        $this->clearCart($request);

        return redirect()->route('transaksi.show', ['orderId' => $orderId]);
    }
}
