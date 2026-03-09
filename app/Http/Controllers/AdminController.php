<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\Product;

class AdminController extends Controller
{
    public function dashboard()
    {
        return redirect()->route('home');
    }

    public function products()
    {
        $products = Product::with('category')->get();
        return view('admin.products', compact('products'));
    }

    public function orders()
    {
        $orders = \App\Models\Order::with(['user', 'items.product'])->latest()->get();
        return view('admin.orders', compact('orders'));
    }

    public function contacts()
    {
        $contacts = \App\Models\ContactMessage::latest()->get();
        return view('admin.contacts', compact('contacts'));
    }

    public function updateOrderStatus($id, \Illuminate\Http\Request $request)
    {
        $order = \App\Models\Order::findOrFail($id);
        $status = $request->input('status');

        if (in_array($status, ['delivered', 'cancelled'])) {
            $order->update(['status' => $status]);
            return back()->with('success', 'Order status updated successfully!');
        }

        return back()->with('error', 'Invalid status update.');
    }

    public function replyToMessage($id, \Illuminate\Http\Request $request)
    {
        $message = \App\Models\ContactMessage::findOrFail($id);
        $reply = $request->input('reply');

        if ($reply) {
            $message->update([
                'reply' => $reply,
                'status' => 'replied',
                'replied_at' => now(),
            ]);
            return back()->with('success', 'Reply sent successfully!');
        }

        return back()->with('error', 'Reply cannot be empty.');
    }
}
