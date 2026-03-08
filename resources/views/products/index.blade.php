@extends('layouts.app')

@section('title', 'All Products')
@section('meta_description', 'Browse our full collection of premium tech products including audio, wearables, computers, cameras, and more.')

@section('styles')
<style>
    .page-header { background: #fff; border-bottom: 1px solid #edf2f7; padding: 28px 0 0; }
    .page-header-inner { max-width: 1280px; margin: 0 auto; padding: 0 24px; display: flex; align-items: flex-start; justify-content: space-between; gap: 16px; flex-wrap: wrap; }
    .page-title { font-size: 1.8rem; font-weight: 800; color: #1a1a2e; letter-spacing: -.5px; }
    .page-count { font-size: .875rem; color: #6b7280; margin-top: 4px; }
    .btn-add-product { background: #1a1a2e; color: #fff; padding: 10px 20px; border-radius: 10px; font-size: .875rem; font-weight: 600; display: inline-flex; align-items: center; gap: 8px; transition: all .2s; }
    .btn-add-product:hover { background: #6c3fff; transform: translateY(-1px); }

    /* FILTER BAR */
    .filter-bar { background: #fff; border-bottom: 1px solid #edf2f7; padding: 0 24px; max-width: 1280px; margin: 0 auto; display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap; padding-top: 14px; padding-bottom: 14px; }
    .category-tabs { display: flex; gap: 6px; flex-wrap: wrap; }
    .cat-tab { padding: 7px 16px; border-radius: 8px; font-size: .825rem; font-weight: 600; color: #6b7280; border: 1.5px solid #e2e8f0; background: #fff; cursor: pointer; transition: all .15s; text-decoration: none; white-space: nowrap; }
    .cat-tab:hover { border-color: #6c3fff; color: #6c3fff; background: #f0ecff; }
    .cat-tab.active { background: #1a1a2e; color: #fff; border-color: #1a1a2e; }
    .sort-wrap { display: flex; align-items: center; gap: 10px; flex-shrink: 0; }
    .sort-label { font-size: .825rem; color: #6b7280; font-weight: 500; }
    .sort-select { padding: 8px 32px 8px 12px; border: 1.5px solid #e2e8f0; border-radius: 9px; font-size: .825rem; font-weight: 500; color: #1a1a2e; background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath d='M6 8L1 3h10z' fill='%236b7280'/%3E%3C/svg%3E") no-repeat right 10px center; -webkit-appearance: none; outline: none; cursor: pointer; }
    .sort-select:focus { border-color: #6c3fff; }

    .products-section { padding: 36px 0; }
    .no-products { text-align: center; padding: 80px 24px; color: #6b7280; }
    .no-products i { font-size: 3rem; color: #d1d5db; margin-bottom: 16px; }
    .no-products h3 { font-size: 1.2rem; font-weight: 700; color: #1a1a2e; margin-bottom: 8px; }

    /* ADMIN ACTIONS */
    .admin-actions { display: flex; gap: 8px; margin-top: 12px; padding-top: 12px; border-top: 1px solid #edf2f7; }
    .btn-edit { flex: 1; padding: 8px; background: #f0ecff; color: #6c3fff; border-radius: 8px; font-size: .8rem; font-weight: 700; display: flex; align-items: center; justify-content: center; gap: 6px; transition: all .2s; border: none; text-decoration: none; }
    .btn-edit:hover { background: #6c3fff; color: #fff; }
    .btn-delete { padding: 8px 12px; background: #fee2e2; color: #ef4444; border-radius: 8px; font-size: .8rem; font-weight: 700; border: none; cursor: pointer; transition: all .2s; }
    .btn-delete:hover { background: #ef4444; color: #fff; }
</style>
@endsection

@section('content')

<!-- PAGE HEADER -->
<div class="page-header">
    <div class="page-header-inner">
        <div>
            <h1 class="page-title">All Products</h1>
            <p class="page-count">Showing {{ $total }} product{{ $total !== 1 ? 's' : '' }}</p>
        </div>
        @auth
            @if(auth()->user()->isAdmin())
                <a href="{{ route('products.create') }}" class="btn-add-product"><i class="fas fa-plus"></i> Add Product</a>
            @endif
        @endauth
    </div>

    <!-- FILTER BAR -->
    <div style="max-width:1280px;margin:0 auto;">
        <div class="filter-bar">
            <div class="category-tabs">
                <a href="{{ route('products.index', array_merge(request()->except('category'), ['sort' => $sort])) }}"
                   class="cat-tab {{ !request('category') || request('category') === 'all' ? 'active' : '' }}">All Products</a>
                @foreach($categories as $cat)
                    <a href="{{ route('products.index', array_merge(request()->except('category'), ['category' => $cat->slug, 'sort' => $sort])) }}"
                       class="cat-tab {{ request('category') === $cat->slug ? 'active' : '' }}">{{ $cat->name }}</a>
                @endforeach
            </div>
            <div class="sort-wrap">
                <span class="sort-label">Sort by:</span>
                <select class="sort-select" onchange="window.location.href=this.value">
                    <option value="{{ route('products.index', array_merge(request()->except('sort'), ['sort' => 'featured'])) }}" {{ $sort === 'featured' ? 'selected' : '' }}>Featured</option>
                    <option value="{{ route('products.index', array_merge(request()->except('sort'), ['sort' => 'price_asc'])) }}" {{ $sort === 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="{{ route('products.index', array_merge(request()->except('sort'), ['sort' => 'price_desc'])) }}" {{ $sort === 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                </select>
            </div>
        </div>
    </div>
</div>

<!-- PRODUCTS GRID -->
<section class="products-section">
    <div class="container">
        @if($products->isEmpty())
            <div class="no-products">
                <i class="fas fa-search"></i>
                <h3>No products found</h3>
                <p>Try adjusting your search or filter criteria.</p>
                <a href="{{ route('products.index') }}" style="margin-top:16px;display:inline-flex;align-items:center;gap:8px;background:#6c3fff;color:#fff;padding:10px 20px;border-radius:9px;font-weight:600;font-size:.875rem;">Clear Filters</a>
            </div>
        @else
            <div class="products-grid">
                @foreach($products as $product)
                    <div class="product-card">
                        <a href="{{ route('products.show', $product->id) }}" class="product-card-img">
                            <img src="/{{ $product->image_url }}"
                                 alt="{{ $product->name }}"
                                 onerror="this.src='https://placehold.co/400x300/f0ecff/6c3fff?text={{ urlencode(substr($product->name,0,15)) }}'">
                        </a>
                        <div class="product-card-body">
                            <div class="product-category-tag">{{ strtoupper($product->category->name ?? '') }}</div>
                            <a href="{{ route('products.show', $product->id) }}" class="product-name">{{ $product->name }}</a>

                            <div class="product-price">${{ number_format($product->price, 2) }}</div>
                            <button class="btn-add-cart" onclick="addToCart({{ $product->id }}, this)">
                                <i class="fas fa-shopping-cart"></i> Add to Cart
                            </button>


                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

@endsection
