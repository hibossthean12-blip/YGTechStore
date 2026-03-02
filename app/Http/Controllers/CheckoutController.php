<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('products.index')->with('error', 'Your cart is empty.');
        }

        $items = $this->hydrateCart($cart);
        $total = collect($items)->sum('subtotal');

        return view('checkout', compact('items', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'house_number' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'village' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('products.index')->with('error', 'Your cart is empty.');
        }

        $items = $this->hydrateCart($cart);
        $total = collect($items)->sum('subtotal');

        $address = "Phone: {$request->phone_number}, House No: {$request->house_number}, Street: {$request->street}, Village: {$request->village}, District: {$request->district}, Province: {$request->province}, City: {$request->city}, Country: Cambodia";

        try {
            DB::beginTransaction();

            $order = Order::create([
                'user_id' => auth()->id(),
                'total_amount' => $total,
                'status' => 'pending',
                'shipping_address' => $address,
            ]);

            foreach ($items as $item) {
                $product = Product::lockForUpdate()->find($item['product_id']);

                if (!$product || $product->stock < $item['quantity']) {
                    throw new \Exception("Insufficient stock for product: {$item['name']}");
                }

                $product->decrement('stock', $item['quantity']);

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            DB::commit();

            session()->forget('cart');

            return redirect()->route('home')->with('success', 'Your order has been placed successfully! It will be delivered within 7-14 business days. Thank you for using our platform!');
        }
        catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage() ?: 'Something went wrong while processing your order. Please try again.');
        }
    }

    private function hydrateCart(array $cart): array
    {
        $products = Product::whereIn('id', array_keys($cart))->get()->keyBy('id');
        $items = [];

        foreach ($cart as $productId => $quantity) {
            if ($product = $products->get($productId)) {
                $items[] = [
                    'product_id' => $productId,
                    'name' => $product->name,
                    'price' => $product->price,
                    'image_url' => $product->image_url,
                    'quantity' => $quantity,
                    'subtotal' => $product->price * $quantity,
                ];
            }
        }

        return $items;
    }
}
