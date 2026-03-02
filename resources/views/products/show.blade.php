@extends('layouts.app')

@section('title', $product->name)
@section('meta_description', $product->description)

@section('styles')
<style>
    .product-detail { padding: 48px 0; }
    .breadcrumb { display: flex; align-items: center; gap: 8px; font-size: .825rem; color: #6b7280; margin-bottom: 32px; flex-wrap: wrap; }
    .breadcrumb a { color: #6c3fff; }
    .breadcrumb a:hover { text-decoration: underline; }
    .breadcrumb-sep { color: #d1d5db; }

    .product-layout { display: grid; grid-template-columns: 1fr 1fr; gap: 56px; align-items: start; }
    @media(max-width:768px){ .product-layout { grid-template-columns: 1fr; gap: 32px; } }

    .product-img-wrap { border-radius: 20px; overflow: hidden; background: #f8f9fa; aspect-ratio: 1; border: 1px solid #edf2f7; }
    .product-img-wrap img { width: 100%; height: 100%; object-fit: cover; }

    .product-detail-body {}
    .detail-category { font-size: .75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: #6c3fff; margin-bottom: 10px; }
    .detail-name { font-size: 1.9rem; font-weight: 800; color: #1a1a2e; line-height: 1.2; margin-bottom: 12px; letter-spacing: -.5px; }
    .detail-rating-row { display: flex; align-items: center; gap: 10px; margin-bottom: 16px; }
    .detail-stars { color: #f59e0b; font-size: 1.1rem; }
    .detail-price { font-size: 2rem; font-weight: 800; color: #1a1a2e; margin-bottom: 8px; }
    .detail-stock { font-size: .875rem; color: #6b7280; margin-bottom: 24px; }
    .detail-stock span { color: #10b981; font-weight: 600; }
    .detail-desc { font-size: .95rem; color: #4a5568; line-height: 1.8; margin-bottom: 28px; padding-bottom: 28px; border-bottom: 1px solid #edf2f7; }
    .detail-actions { display: flex; gap: 12px; flex-wrap: wrap; }
    .btn-detail-cart { flex: 1; min-width: 200px; padding: 15px 24px; background: #1a1a2e; color: #fff; border-radius: 12px; font-size: 1rem; font-weight: 700; display: flex; align-items: center; justify-content: center; gap: 10px; transition: all .2s; border: none; cursor: pointer; }
    .btn-detail-cart:hover { background: #6c3fff; transform: translateY(-2px); box-shadow: 0 6px 20px rgba(108,63,255,.3); }
    .btn-detail-cart.added { background: #10b981; }

    /* GUARANTEE BADGES */
    .guarantee-row { display: flex; gap: 16px; margin-top: 28px; flex-wrap: wrap; }
    .guarantee { display: flex; align-items: center; gap: 6px; font-size: .8rem; color: #6b7280; }
    .guarantee i { color: #10b981; }

    /* REVIEWS */
    .reviews-section { padding: 48px 0; background: #fff; }
    .reviews-header { margin-bottom: 28px; }
    .reviews-title { font-size: 1.4rem; font-weight: 800; color: #1a1a2e; }
    .review-card { background: #f8f9fa; border-radius: 12px; padding: 20px; margin-bottom: 16px; border: 1px solid #edf2f7; }
    .review-top { display: flex; align-items: center; gap: 12px; margin-bottom: 8px; }
    .review-avatar { width: 38px; height: 38px; border-radius: 50%; background: linear-gradient(135deg,#6c3fff,#a855f7); color: #fff; font-size: .85rem; font-weight: 700; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .review-author { font-weight: 700; font-size: .9rem; color: #1a1a2e; }
    .review-date { font-size: .775rem; color: #a0aec0; }
    .review-stars { color: #f59e0b; font-size: .85rem; margin-left: auto; }
    .review-text { font-size: .875rem; color: #4a5568; line-height: 1.7; }
    .no-reviews { text-align: center; padding: 40px; color: #6b7280; }
</style>
@endsection

@section('content')

<div class="product-detail">
    <div class="container">
        <!-- BREADCRUMB -->
        <nav class="breadcrumb" aria-label="Breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span class="breadcrumb-sep"><i class="fas fa-chevron-right" style="font-size:.65rem;"></i></span>
            <a href="{{ route('products.index') }}">Products</a>
            <span class="breadcrumb-sep"><i class="fas fa-chevron-right" style="font-size:.65rem;"></i></span>
            <a href="{{ route('products.index', ['category' => $product->category->slug ?? '']) }}">{{ $product->category->name ?? '' }}</a>
            <span class="breadcrumb-sep"><i class="fas fa-chevron-right" style="font-size:.65rem;"></i></span>
            <span style="color:#1a1a2e;">{{ $product->name }}</span>
        </nav>

        <div class="product-layout">
            <!-- IMAGE -->
            <div class="product-img-wrap">
                <img src="/{{ $product->image_url }}"
                     alt="{{ $product->name }}"
                     onerror="this.src='https://placehold.co/600x600/f0ecff/6c3fff?text={{ urlencode($product->name) }}'">
            </div>

            <!-- DETAILS -->
            <div class="product-detail-body">
                <div class="detail-category">{{ $product->category->name ?? '' }}</div>
                <h1 class="detail-name">{{ $product->name }}</h1>

                @php
                    $avg   = round($product->ratings->avg('rating') ?? 0, 1);
                    $count = $product->ratings->count();
                @endphp
                <div class="detail-rating-row">
                    <span class="detail-stars">
                        @for($i=1;$i<=5;$i++)
                            @if($i<=floor($avg))★@elseif($i-.5<=$avg)★@else☆@endif
                        @endfor
                    </span>
                    <span style="font-size:.875rem;color:#6b7280;">{{ $avg }} ({{ $count }} review{{ $count !== 1 ? 's' : '' }})</span>
                </div>

                <div class="detail-price">${{ number_format($product->price, 2) }}</div>
                <div class="detail-stock">
                    @if($product->stock > 0)
                        <span>✓ In Stock</span> — {{ $product->stock }} units available
                    @else
                        <span style="color:#ef4444;font-weight:600;">Out of Stock</span>
                    @endif
                </div>

                <p class="detail-desc">{{ $product->description }}</p>

                <div class="detail-actions">
                    <button class="btn-detail-cart" onclick="addToCart({{ $product->id }}, this)">
                        <i class="fas fa-shopping-cart"></i> Add to Cart
                    </button>
                </div>

                <div class="guarantee-row">
                    <div class="guarantee"><i class="fas fa-truck"></i> Free Shipping over $50</div>
                    <div class="guarantee"><i class="fas fa-undo"></i> 30-Day Returns</div>
                    <div class="guarantee"><i class="fas fa-shield-alt"></i> 1-Year Warranty</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- REVIEWS -->
<section class="reviews-section">
    <div class="container">
        <div class="reviews-header">
            <h2 class="reviews-title">Customer Reviews <span style="color:#6b7280;font-size:1rem;font-weight:500;">({{ $product->ratings->count() }})</span></h2>
        </div>

        @if($product->ratings->isEmpty())
            <div class="no-reviews">
                <i class="fas fa-comment-alt" style="font-size:2.5rem;color:#d1d5db;margin-bottom:12px;display:block;"></i>
                <p style="font-weight:600;color:#4a5568;">No reviews yet</p>
                <p style="font-size:.875rem;">Be the first to review this product!</p>
            </div>
        @else
            @foreach($product->ratings as $rating)
                <div class="review-card">
                    <div class="review-top">
                        <div class="review-avatar">{{ substr($rating->user->name ?? 'U', 0, 1) }}</div>
                        <div>
                            <div class="review-author">{{ $rating->user->name ?? 'Anonymous' }}</div>
                            <div class="review-date">{{ \Carbon\Carbon::parse($rating->created_at)->format('M d, Y') }}</div>
                        </div>
                        <div class="review-stars">
                            @for($i=1;$i<=5;$i++)★@endfor
                            ({{ $rating->rating }})
                        </div>
                    </div>
                    <p class="review-text">{{ $rating->review }}</p>
                </div>
            @endforeach
        @endif
    </div>
</section>

@endsection
