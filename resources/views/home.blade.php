@extends('layouts.app')

@section('title', 'Premium Tech Products at Your Fingertips')
@section('meta_description', 'Discover the latest technology and gadgets with fast shipping and unbeatable prices.')

@section('styles')
<style>
    /* HERO */
    .hero {
        background: linear-gradient(135deg, #7c3aed 0%, #4f46e5 50%, #3b82f6 100%);
        padding: 90px 0 100px;
        position: relative;
        overflow: hidden;
    }
    .hero::before {
        content: '';
        position: absolute;
        top: -50%; left: -20%;
        width: 600px; height: 600px;
        background: rgba(255,255,255,.05);
        border-radius: 50%;
    }
    .hero::after {
        content: '';
        position: absolute;
        bottom: -30%; right: -10%;
        width: 400px; height: 400px;
        background: rgba(255,255,255,.04);
        border-radius: 50%;
    }
    .hero-content { max-width: 1280px; margin: 0 auto; padding: 0 24px; position: relative; z-index: 1; }
    .hero-eyebrow { display: inline-flex; align-items: center; gap: 8px; background: rgba(255,255,255,.15); color: #e0d9ff; font-size: .8rem; font-weight: 600; letter-spacing: 1px; text-transform: uppercase; padding: 6px 14px; border-radius: 20px; margin-bottom: 20px; backdrop-filter: blur(8px); border: 1px solid rgba(255,255,255,.2); }
    .hero h1 { font-size: clamp(2.2rem, 5vw, 3.2rem); font-weight: 800; color: #fff; line-height: 1.15; margin-bottom: 16px; letter-spacing: -1px; }
    .hero-sub { font-size: 1.1rem; color: rgba(255,255,255,.8); margin-bottom: 36px; max-width: 520px; line-height: 1.7; }
    .hero-actions { display: flex; gap: 14px; flex-wrap: wrap; }
    .btn-hero-primary { background: #fff; color: #6c3fff; padding: 14px 28px; border-radius: 12px; font-size: .95rem; font-weight: 700; display: inline-flex; align-items: center; gap: 8px; transition: all .2s; }
    .btn-hero-primary:hover { background: #f0ecff; transform: translateY(-2px); box-shadow: 0 8px 24px rgba(0,0,0,.2); }
    .btn-hero-outline { background: transparent; color: #fff; border: 2px solid rgba(255,255,255,.5); padding: 14px 28px; border-radius: 12px; font-size: .95rem; font-weight: 700; display: inline-flex; align-items: center; gap: 8px; transition: all .2s; }
    .btn-hero-outline:hover { background: rgba(255,255,255,.1); border-color: #fff; transform: translateY(-1px); }

    /* FEATURES STRIP */
    .features-strip { background: #fff; padding: 40px 0; }
    .features-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 2px; max-width: 1000px; margin: 0 auto; }
    @media(max-width:640px){.features-grid{grid-template-columns:1fr;gap:16px;}}
    .feature-card { display: flex; flex-direction: column; align-items: center; text-align: center; padding: 28px 24px; border: 1px solid #edf2f7; border-radius: 14px; gap: 12px; margin: 8px; }
    .feature-icon { width: 56px; height: 56px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; }
    .feature-icon.purple { background: #f3e8ff; color: #7c3aed; }
    .feature-icon.blue   { background: #dbeafe; color: #2563eb; }
    .feature-icon.green  { background: #d1fae5; color: #059669; }
    .feature-title { font-size: .95rem; font-weight: 700; color: #1a1a2e; }
    .feature-desc  { font-size: .825rem; color: #6b7280; }

    /* FEATURED PRODUCTS */
    .section-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 32px; }
    .section-title { font-size: 1.6rem; font-weight: 800; color: #1a1a2e; letter-spacing: -.5px; }
    .section-title span { color: #6c3fff; }
    .view-all { font-size: .875rem; font-weight: 600; color: #6c3fff; display: inline-flex; align-items: center; gap: 6px; transition: gap .2s; }
    .view-all:hover { gap: 10px; }
</style>
@endsection

@section('content')

<!-- HERO -->
<section class="hero">
    <div class="hero-content">
        <div class="hero-eyebrow"><i class="fas fa-bolt"></i> New arrivals every week</div>
        <h1>Premium Tech Products<br>at Your Fingertips</h1>
        <p class="hero-desc">Discover the latest technology and gadgets with fast shipping and unbeatable prices at YG Tech store.</p>
        <div class="hero-actions">
            <a href="{{ route('products.index') }}" class="btn-hero-primary"><i class="fas fa-shopping-bag"></i> Shop Now</a>
            <a href="{{ route('contact') }}" class="btn-hero-outline"><i class="fas fa-envelope"></i> Contact Us</a>
        </div>
    </div>
</section>

<!-- FEATURES STRIP -->
<section class="features-strip">
    <div class="container">
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon purple"><i class="fas fa-truck"></i></div>
                <div class="feature-title">Free Shipping</div>
                <div class="feature-desc">On all orders over $50</div>
            </div>
            <div class="feature-card">
                <div class="feature-icon blue"><i class="fas fa-shield-alt"></i></div>
                <div class="feature-title">Secure Payment</div>
                <div class="feature-desc">100% secure transactions</div>
            </div>
            <div class="feature-card">
                <div class="feature-icon green"><i class="fas fa-headset"></i></div>
                <div class="feature-title">24/7 Support</div>
                <div class="feature-desc">Dedicated customer service</div>
            </div>
        </div>
    </div>
</section>

<!-- FEATURED PRODUCTS -->
<section class="section" style="background:#f8f9fa;">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Featured <span>Products</span></h2>
            <a href="{{ route('products.index') }}" class="view-all">View All <i class="fas fa-arrow-right"></i></a>
        </div>
        <div class="products-grid">
            @foreach($featuredProducts as $product)
                <div class="product-card">
                    <a href="{{ route('products.show', $product->id) }}" class="product-card-img">
                        <img src="/{{ $product->image_url }}"
                             alt="{{ $product->name }}"
                             onerror="this.src='https://placehold.co/400x300/f0ecff/6c3fff?text={{ urlencode($product->name) }}'">
                    </a>
                    <div class="product-card-body">
                        <div class="product-category-tag">{{ strtoupper($product->category->name ?? '') }}</div>
                        <a href="{{ route('products.show', $product->id) }}" class="product-name">{{ $product->name }}</a>
                        <div class="product-price">${{ number_format($product->price, 2) }}</div>
                        @if(!auth()->check())
                            <a href="{{ route('login') }}" class="btn-add-cart" style="text-decoration: none; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-sign-in-alt"></i> Login to Order
                            </a>
                        @elseif(!auth()->user()->isAdmin())
                            <button class="btn-add-cart" onclick="addToCart({{ $product->id }}, this)">
                                <i class="fas fa-shopping-cart"></i> Add to Cart
                            </button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>


@endsection
