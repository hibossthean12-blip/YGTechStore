<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::with('category', 'ratings')
            ->where('is_featured', true)
            ->get();

        $categories = Category::all();

        return view('home', compact('featuredProducts', 'categories'));
    }
}
