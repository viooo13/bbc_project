<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Paket;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private function getCart(Request $request): array
    {
        return $request->session()->get('cart', []);
    }

    private function saveCart(Request $request, array $cart): void
    {
        $request->session()->put('cart', $cart);
    }

    private function cartItemKey(string $type, int $id): string
    {
        return $type . ':' . $id;
    }

    public function index(Request $request)
    {
        $cart = $this->getCart($request);

        $items = array_values($cart);
        $subtotal = 0;
        foreach ($items as $item) {
            $subtotal += ((float) ($item['price'] ?? 0)) * ((int) ($item['quantity'] ?? 0));
        }

        return view('cart', [
            'items' => $items,
            'subtotal' => $subtotal,
        ]);
    }

    public function add(Request $request)
    {
        $data = $request->validate([
            'type' => 'required|in:menu,paket',
            'id' => 'required|integer|min:1',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $type = $data['type'];
        $id = (int) $data['id'];
        $quantity = (int) ($data['quantity'] ?? 1);

        if ($type === 'menu') {
            $product = Menu::findOrFail($id);
            $name = (string) $product->name;
            $price = (float) $product->price;
            $image = $product->image ? asset($product->image) : null;
        } else {
            $product = Paket::findOrFail($id);
            $name = (string) $product->name;
            $price = (float) $product->price;
            $image = $product->image ? asset($product->image) : null;
        }

        $cart = $this->getCart($request);
        $key = $this->cartItemKey($type, $id);

        if (isset($cart[$key])) {
            $cart[$key]['quantity'] = ((int) $cart[$key]['quantity']) + $quantity;
        } else {
            $cart[$key] = [
                'key' => $key,
                'type' => $type,
                'id' => $id,
                'name' => $name,
                'price' => $price,
                'quantity' => $quantity,
                'image' => $image,
            ];
        }

        $this->saveCart($request, $cart);

        return response()->json([
            'ok' => true,
            'count' => $this->countItems($cart),
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'key' => 'required|string',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = $this->getCart($request);
        if (!isset($cart[$data['key']])) {
            return response()->json(['ok' => false], 404);
        }

        $cart[$data['key']]['quantity'] = (int) $data['quantity'];
        $this->saveCart($request, $cart);

        return response()->json([
            'ok' => true,
            'count' => $this->countItems($cart),
        ]);
    }

    public function remove(Request $request)
    {
        $data = $request->validate([
            'key' => 'required|string',
        ]);

        $cart = $this->getCart($request);
        unset($cart[$data['key']]);
        $this->saveCart($request, $cart);

        return response()->json([
            'ok' => true,
            'count' => $this->countItems($cart),
        ]);
    }

    public function clear(Request $request)
    {
        $this->saveCart($request, []);

        return response()->json([
            'ok' => true,
            'count' => 0,
        ]);
    }

    public function apiCount(Request $request)
    {
        $cart = $this->getCart($request);

        return response()->json([
            'count' => $this->countItems($cart),
        ]);
    }

    private function countItems(array $cart): int
    {
        $count = 0;
        foreach ($cart as $item) {
            $count += (int) ($item['quantity'] ?? 0);
        }
        return $count;
    }
}
