<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\Product;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function products()
    {
        $products = Product::with('category')->get();
        return view('admin.products', compact('products'));
    }

    public function contacts()
    {
        $contacts = ContactMessage::latest()->get();
        return view('admin.contacts', compact('contacts'));
    }
}
