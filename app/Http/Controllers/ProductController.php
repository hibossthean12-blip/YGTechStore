<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $query = Product::with('category');

        // Category filter
        if ($request->filled('category') && $request->category !== 'all') {
            $query->whereHas('category', fn($q) => $q->where('slug', $request->category));
        }

        // Sorting
        $sort = $request->get('sort', 'featured');
        match ($sort) {
                'price_asc' => $query->orderBy('price', 'asc'),
                'price_desc' => $query->orderBy('price', 'desc'),
                default => $query->orderByDesc('is_featured')->orderBy('id'),
            };

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(fn($q) => $q->where('name', 'like', "%{$search}%")
            ->orWhere('description', 'like', "%{$search}%"));
        }

        $products = $query->get();
        $total = $products->count();

        return view('products.index', compact('products', 'categories', 'total', 'sort'));
    }

    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);

        return view('products.show', compact('product'));
    }

    public function create()
    {
        if (!auth()->user() || !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action. Only admins can create products.');
        }

        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        if (!auth()->user() || !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
            'is_featured' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            try {
                $result = cloudinary()->uploadApi()->upload($request->file('image')->getRealPath());
                $validated['image_url'] = $result['secure_url'];
            } catch (\Exception $e) {
                return back()->with('error', 'Cloudinary Upload Failed: ' . $e->getMessage() . '. Please ensure CLOUDINARY_URL is set on Render.');
            }
        }
        else {
            $validated['image_url'] = 'images/placeholder.jpg';
        }

        $validated['is_featured'] = $request->has('is_featured');

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }

    public function edit($id)
    {
        if (!auth()->user() || !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        if (!auth()->user() || !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
            'is_featured' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            if (!config('filesystems.disks.cloudinary.url')) {
                return back()->with('error', 'Cloudinary configuration is missing. Please check your Render Environment Variables (CLOUDINARY_URL).');
            }
            $result = cloudinary()->uploadApi()->upload($request->file('image')->getRealPath());
            $validated['image_url'] = $result['secure_url'];
        }

        $validated['is_featured'] = $request->has('is_featured');

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        if (!auth()->user() || !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}
