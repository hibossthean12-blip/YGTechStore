<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Get cart from session.
     */
    private function getCart(): array
    {
        return session()->get('cart', []);
    }

    private function saveCart(array $cart): void
    {
        session()->put('cart', $cart);
    }

    public function index()
    {
        $cart = $this->getCart();
        $items = $this->hydrateCart($cart);
        $total = collect($items)->sum('subtotal');

        return response()->json(['items' => $items, 'total' => $total, 'count' => count($items)]);
    }

    public function add(Request $request)
    {
        $request->validate(['product_id' => 'required|exists:products,id', 'quantity' => 'integer|min:1']);

        $productId = $request->product_id;
        $quantity = $request->get('quantity', 1);
        $cart = $this->getCart();

        if (isset($cart[$productId])) {
            $cart[$productId] += $quantity;
        }
        else {
            $cart[$productId] = $quantity;
        }

        $this->saveCart($cart);

        $items = $this->hydrateCart($cart);
        $total = collect($items)->sum('subtotal');

        return response()->json([
            'success' => true,
            'message' => 'Added to cart',
            'items' => $items,
            'total' => $total,
            'count' => count($items),
        ]);
    }

    public function update(Request $request)
    {
        $request->validate(['product_id' => 'required|exists:products,id', 'quantity' => 'required|integer|min:1']);

        $cart = $this->getCart();
        $cart[$request->product_id] = $request->quantity;
        $this->saveCart($cart);

        $items = $this->hydrateCart($cart);
        $total = collect($items)->sum('subtotal');

        return response()->json(['success' => true, 'items' => $items, 'total' => $total, 'count' => count($items)]);
    }

    public function remove(Request $request)
    {
        $request->validate(['product_id' => 'required']);

        $cart = $this->getCart();
        unset($cart[$request->product_id]);
        $this->saveCart($cart);

        $items = $this->hydrateCart($cart);
        $total = collect($items)->sum('subtotal');

        return response()->json(['success' => true, 'items' => $items, 'total' => $total, 'count' => count($items)]);
    }

    public function clear()
    {
        session()->forget('cart');
        return response()->json(['success' => true, 'items' => [], 'total' => 0, 'count' => 0]);
    }

    private function hydrateCart(array $cart): array
    {
        if (empty($cart)) {
            return [];
        }

        $products = Product::whereIn('id', array_keys($cart))->get()->keyBy('id');
        $items = [];

        foreach ($cart as $productId => $quantity) {
            if ($product = $products->get($productId)) {
                $subtotal = $product->price * $quantity;
                $items[] = [
                    'product_id' => $productId,
                    'name' => $product->name,
                    'price' => $product->price,
                    'image_url' => $product->image_url,
                    'quantity' => $quantity,
                    'subtotal' => $subtotal,
                ];
            }
        }

        return $items;
    }
}
