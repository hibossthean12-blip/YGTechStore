@extends('layouts.app')

@section('title', 'Manage Products')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Manage Products</h1>
            <a href="{{ route('products.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-indigo-700 transition">
                <i class="fas fa-plus mr-2"></i> Add New Product
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="p-4 font-semibold text-gray-600">Product</th>
                            <th class="p-4 font-semibold text-gray-600">Category</th>
                            <th class="p-4 font-semibold text-gray-600">Price</th>
                            <th class="p-4 font-semibold text-gray-600">Stock</th>
                            <th class="p-4 font-semibold text-gray-600 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="p-4 flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-md overflow-hidden bg-gray-100 shrink-0">
                                        <img src="/{{ $product->image_url }}" class="w-full h-full object-cover">
                                    </div>
                                    <span class="font-medium text-gray-800">{{ $product->name }}</span>
                                </td>
                                <td class="p-4 text-gray-600">{{ $product->category->name ?? 'N/A' }}</td>
                                <td class="p-4 font-medium text-gray-800">${{ number_format($product->price, 2) }}</td>
                                <td class="p-4">
                                    @if($product->stock > 0)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            {{ $product->stock }} in stock
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            Out of stock
                                        </span>
                                    @endif
                                </td>
                                <td class="p-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('products.edit', $product->id) }}" class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 p-2 rounded-md transition" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 bg-red-50 p-2 rounded-md transition" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-8 text-center text-gray-500">
                                    No products found. <a href="{{ route('products.create') }}" class="text-indigo-600 hover:underline">Create one</a>.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection
