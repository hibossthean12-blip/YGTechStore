<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>YG Tech store - @yield('title', 'Premium Tech Products')</title>
    <meta name="description" content="@yield('meta_description', 'Discover the latest technology and gadgets with fast shipping and unbeatable prices at TechStore.')">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body { font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif; background: #f8f9fa; color: #1a1a2e; line-height: 1.6; min-height: 100vh; }
        a { text-decoration: none; color: inherit; }
        img { max-width: 100%; height: auto; display: block; }
        button { cursor: pointer; border: none; background: none; font-family: inherit; }
        input, textarea, select { font-family: inherit; }

        /* NAVBAR */
        .navbar { position: sticky; top: 0; z-index: 1000; background: #fff; border-bottom: 1px solid #e8ecf0; box-shadow: 0 2px 12px rgba(0,0,0,.06); }
        .navbar-inner { max-width: 1280px; margin: 0 auto; padding: 0 24px; height: 64px; display: flex; align-items: center; gap: 20px; }
        .navbar-brand { font-size: 1.35rem; font-weight: 800; color: #0f0f23; letter-spacing: -.5px; flex-shrink: 0; }
        .navbar-brand span { color: #6c3fff; }
        .navbar-nav { display: flex; align-items: center; gap: 4px; list-style: none; flex-shrink: 0; }
        .navbar-nav a { padding: 8px 14px; border-radius: 8px; font-size: .875rem; font-weight: 500; color: #4a5568; transition: all .15s; }
        .navbar-nav a:hover, .navbar-nav a.active { background: #f0ecff; color: #6c3fff; }
        .navbar-search { flex: 1; max-width: 400px; position: relative; }
        .navbar-search input { width: 100%; padding: 9px 16px 9px 40px; border: 1.5px solid #e2e8f0; border-radius: 10px; font-size: .875rem; background: #f8fafc; outline: none; transition: all .2s; }
        .navbar-search input:focus { border-color: #6c3fff; background: #fff; box-shadow: 0 0 0 3px rgba(108,63,255,.1); }
        .navbar-search input::placeholder { color: #a0aec0; }
        .search-icon { position: absolute; left: 13px; top: 50%; transform: translateY(-50%); color: #a0aec0; font-size: .85rem; }
        .navbar-actions { display: flex; align-items: center; gap: 8px; margin-left: auto; }
        .btn-cart { position: relative; width: 42px; height: 42px; border-radius: 10px; background: #f0ecff; color: #6c3fff; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; transition: all .2s; }
        .btn-cart:hover { background: #6c3fff; color: #fff; transform: translateY(-1px); }
        .cart-badge { position: absolute; top: -5px; right: -5px; background: #ff4757; color: #fff; font-size: .65rem; font-weight: 700; width: 18px; height: 18px; border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 2px solid #fff; }
        .btn-auth { padding: 8px 18px; border-radius: 9px; font-size: .85rem; font-weight: 600; transition: all .2s; display: inline-flex; align-items: center; }
        .btn-login { background: #f0ecff; color: #6c3fff; }
        .btn-login:hover { background: #e4dcff; }
        .btn-register { background: #6c3fff; color: #fff; }
        .btn-register:hover { background: #5a30d9; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(108,63,255,.35); }

        /* LAYOUT */
        .main-content { min-height: calc(100vh - 64px - 280px); }
        .container { max-width: 1280px; margin: 0 auto; padding: 0 24px; }
        .section { padding: 64px 0; }

        /* BUTTONS */
        .btn { display: inline-flex; align-items: center; gap: 8px; padding: 13px 26px; border-radius: 10px; font-size: .9rem; font-weight: 600; transition: all .2s; cursor: pointer; }
        .btn-primary { background: #6c3fff; color: #fff; }
        .btn-primary:hover { background: #5a30d9; transform: translateY(-2px); box-shadow: 0 6px 20px rgba(108,63,255,.4); }
        .btn-outline-white { background: transparent; color: #fff; border: 2px solid rgba(255,255,255,.6); }
        .btn-outline-white:hover { background: rgba(255,255,255,.15); border-color: #fff; }
        .btn-dark { background: #1a1a2e; color: #fff; }
        .btn-dark:hover { background: #0f0f23; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(0,0,0,.3); }

        /* PRODUCT CARD */
        .product-card { background: #fff; border-radius: 16px; overflow: hidden; border: 1px solid #edf2f7; transition: all .3s; display: flex; flex-direction: column; }
        .product-card:hover { transform: translateY(-6px); box-shadow: 0 20px 40px rgba(0,0,0,.12); border-color: transparent; }
        .product-card-img { position: relative; overflow: hidden; background: #f8f9fa; }
        .product-card-img img { width: 100%; height: 220px; object-fit: cover; transition: transform .4s; }
        .product-card:hover .product-card-img img { transform: scale(1.06); }
        .product-card-body { padding: 16px; flex: 1; display: flex; flex-direction: column; }
        .product-category-tag { font-size: .7rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: #6c3fff; margin-bottom: 6px; }
        .product-name { font-size: .95rem; font-weight: 700; color: #1a1a2e; margin-bottom: 8px; line-height: 1.3; flex: 1; }

        .product-price { font-size: 1.15rem; font-weight: 800; color: #1a1a2e; margin-bottom: 14px; }
        .btn-add-cart { width: 100%; padding: 11px; background: #1a1a2e; color: #fff; border-radius: 10px; font-size: .85rem; font-weight: 600; display: flex; align-items: center; justify-content: center; gap: 8px; transition: all .2s; border: none; cursor: pointer; }
        .btn-add-cart:hover { background: #6c3fff; transform: translateY(-1px); }
        .btn-add-cart.added { background: #10b981; }

        /* GRID */
        .products-grid { display: grid; grid-template-columns: repeat(4,1fr); gap: 24px; }
        @media(max-width:1100px){.products-grid{grid-template-columns:repeat(3,1fr);}}
        @media(max-width:768px){.products-grid{grid-template-columns:repeat(2,1fr);}}
        @media(max-width:480px){.products-grid{grid-template-columns:1fr;}}

        /* CART SIDEBAR */
        .cart-overlay { position: fixed; inset: 0; background: rgba(0,0,0,.5); z-index: 9000; opacity: 0; pointer-events: none; transition: opacity .3s; }
        .cart-overlay.open { opacity: 1; pointer-events: all; }
        .cart-sidebar { position: fixed; top: 0; right: 0; width: 420px; max-width: 100vw; height: 100vh; background: #fff; z-index: 9001; transform: translateX(100%); transition: transform .35s cubic-bezier(.4,0,.2,1); display: flex; flex-direction: column; box-shadow: -10px 0 40px rgba(0,0,0,.15); }
        .cart-sidebar.open { transform: translateX(0); }
        .cart-header { padding: 20px 24px; border-bottom: 1px solid #edf2f7; display: flex; align-items: center; justify-content: space-between; flex-shrink: 0; }
        .cart-header h2 { font-size: 1.1rem; font-weight: 700; }
        .cart-close { width: 36px; height: 36px; border-radius: 8px; background: #f8f9fa; display: flex; align-items: center; justify-content: center; color: #6b7280; transition: all .15s; }
        .cart-close:hover { background: #fee2e2; color: #ef4444; }
        .cart-body { flex: 1; overflow-y: auto; padding: 16px 24px; }
        .cart-empty { display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100%; text-align: center; gap: 16px; padding: 60px 0; }
        .cart-empty-icon { font-size: 3.5rem; color: #d1d5db; }
        .cart-empty p { font-size: 1rem; font-weight: 500; color: #6b7280; }
        .cart-empty small { font-size: .85rem; color: #a0aec0; }
        .cart-item { display: flex; align-items: center; gap: 14px; padding: 14px 0; border-bottom: 1px solid #f0f4f8; }
        .cart-item-img { width: 64px; height: 64px; border-radius: 10px; overflow: hidden; flex-shrink: 0; background: #f8f9fa; }
        .cart-item-img img { width: 100%; height: 100%; object-fit: cover; }
        .cart-item-details { flex: 1; min-width: 0; }
        .cart-item-name { font-size: .875rem; font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .cart-item-price { font-size: .8rem; color: #6b7280; margin-top: 2px; }
        .cart-item-controls { display: flex; align-items: center; gap: 8px; margin-top: 6px; }
        .qty-btn { width: 26px; height: 26px; border-radius: 6px; border: 1.5px solid #e2e8f0; background: #fff; display: flex; align-items: center; justify-content: center; font-size: .8rem; color: #4a5568; transition: all .15s; cursor: pointer; }
        .qty-btn:hover { border-color: #6c3fff; color: #6c3fff; background: #f0ecff; }
        .qty-display { font-size: .875rem; font-weight: 600; min-width: 20px; text-align: center; }
        .cart-item-remove { color: #ef4444; font-size: .8rem; margin-left: auto; padding: 4px 8px; border-radius: 6px; transition: background .15s; flex-shrink: 0; }
        .cart-item-remove:hover { background: #fee2e2; }
        .cart-item-subtotal { font-size: .9rem; font-weight: 700; flex-shrink: 0; }
        .cart-footer { padding: 20px 24px; border-top: 1px solid #edf2f7; flex-shrink: 0; background: #fff; }
        .cart-total { display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; }
        .cart-total span:first-child { font-size: .9rem; color: #6b7280; }
        .cart-total-amount { font-size: 1.3rem; font-weight: 800; }
        .btn-checkout { width: 100%; padding: 14px; background: linear-gradient(135deg,#6c3fff,#a855f7); color: #fff; border-radius: 12px; font-size: 1rem; font-weight: 700; display: flex; align-items: center; justify-content: center; gap: 8px; transition: all .2s; border: none; cursor: pointer; }
        .btn-checkout:hover { opacity: .9; transform: translateY(-1px); box-shadow: 0 6px 20px rgba(108,63,255,.4); }

        /* FLASH / ALERT */
        .alert { padding: 14px 20px; border-radius: 10px; margin-bottom: 20px; font-size: .9rem; display: flex; align-items: center; gap: 10px; }
        .alert-success { background: #d1fae5; color: #065f46; border-left: 4px solid #10b981; }
        .alert-error { background: #fee2e2; color: #991b1b; border-left: 4px solid #ef4444; }

        /* TOAST */
        .toast-container { position: fixed; bottom: 24px; right: 24px; z-index: 10000; display: flex; flex-direction: column; gap: 10px; }
        .toast { background: #1a1a2e; color: #fff; padding: 14px 20px; border-radius: 12px; font-size: .875rem; font-weight: 500; display: flex; align-items: center; gap: 10px; box-shadow: 0 8px 25px rgba(0,0,0,.2); animation: slideInR .3s ease, fadeOut .3s ease 2.5s forwards; border-left: 4px solid #10b981; }
        @keyframes slideInR { from{transform:translateX(100px);opacity:0} to{transform:translateX(0);opacity:1} }
        @keyframes fadeOut { to{opacity:0;transform:translateX(100px)} }

        /* FOOTER */
        .footer { background: #1a1a2e; color: #a0aec0; padding: 48px 0 24px; margin-top: 60px; }
        .footer-grid { display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 40px; max-width: 1280px; margin: 0 auto; padding: 0 24px 40px; border-bottom: 1px solid rgba(255,255,255,.08); }
        @media(max-width:768px){.footer-grid{grid-template-columns:1fr 1fr;}}
        .footer-brand-text { font-size: 1.3rem; font-weight: 800; color: #fff; margin-bottom: 12px; }
        .footer-brand-text span { color: #a78bfa; }
        .footer-desc { font-size: .875rem; line-height: 1.7; }
        .footer-heading { color: #fff; font-size: .85rem; font-weight: 700; text-transform: uppercase; letter-spacing: .8px; margin-bottom: 16px; }
        .footer-links { list-style: none; display: flex; flex-direction: column; gap: 8px; }
        .footer-links a { font-size: .875rem; color: #a0aec0; transition: color .15s; }
        .footer-links a:hover { color: #fff; }
        .footer-bottom { display: flex; align-items: center; justify-content: space-between; max-width: 1280px; margin: 0 auto; padding: 24px 24px 0; font-size: .8rem; }
        @media(max-width:480px){.footer-bottom{flex-direction:column;gap:8px;text-align:center;}}

        /* USER DROPDOWN */
        .user-menu { position: relative; }
        .user-avatar { width: 38px; height: 38px; border-radius: 50%; background: linear-gradient(135deg,#6c3fff,#a855f7); color: #fff; font-size: .85rem; font-weight: 700; display: flex; align-items: center; justify-content: center; cursor: pointer; border: 2px solid #fff; box-shadow: 0 2px 8px rgba(108,63,255,.3); }
        .user-dropdown { position: absolute; top: calc(100% + 10px); right: 0; background: #fff; border: 1px solid #edf2f7; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,.12); min-width: 180px; z-index: 2000; overflow: hidden; display: none; }
        .user-menu:hover .user-dropdown, .user-menu:focus-within .user-dropdown { display: block; }
        .user-dropdown a, .user-dropdown button { display: flex; align-items: center; gap: 10px; padding: 12px 16px; font-size: .875rem; color: #4a5568; width: 100%; text-align: left; transition: background .15s; background: none; border: none; cursor: pointer; }
        .user-dropdown a:hover, .user-dropdown button:hover { background: #f8fafc; color: #1a1a2e; }
        .dropdown-divider { border: none; border-top: 1px solid #edf2f7; margin: 4px 0; }

        /* ORDER MANAGE STYLES */
        .order-card { background: #fff; border-radius: 16px; border: 1px solid #edf2f7; margin-bottom: 24px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.03); }
        .order-header { padding: 20px 24px; border-bottom: 1px solid #f0f4f8; display: flex; justify-content: space-between; align-items: center; background: #fbfbfc; }
        .order-id { font-size: .75rem; font-weight: 700; color: #6c3fff; text-transform: uppercase; letter-spacing: 1px; }
        .order-customer { font-size: 1.1rem; font-weight: 800; color: #1a1a2e; margin: 4px 0; }
        .order-date { font-size: .85rem; color: #718096; }
        .status-badge { padding: 6px 12px; border-radius: 20px; font-size: .75rem; font-weight: 700; text-transform: uppercase; }
        .status-pending { background: #fff7ed; color: #c2410c; }
        .status-completed { background: #ecfdf5; color: #047857; }
        .status-cancelled { background: #fff5f5; color: #c53030; }

        /* Action Buttons */
        .status-btn { padding: 6px 14px; border-radius: 8px; font-size: 0.75rem; font-weight: 700; cursor: pointer; transition: all 0.2s; border: none; text-transform: uppercase; letter-spacing: 0.5px; }
        .btn-confirm { background: #6c3fff; color: white; }
        .btn-confirm:hover { background: #5a32d6; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(108, 63, 255, 0.2); }
        .btn-cancel { background: #f1f5f9; color: #64748b; }
        .btn-cancel:hover { background: #e2e8f0; color: #0f172a; }
    .btn-cancel-order { padding: 8px 16px; border-radius: 8px; font-size: 0.8rem; font-weight: 700; color: #e53e3e; background: #fff5f5; border: 1px solid #feb2b2; cursor: pointer; transition: all 0.2s; }
    .btn-cancel-order:hover { background: #fee2e2; color: #c53030; }
        .order-body { padding: 24px; display: grid; grid-template-columns: 1fr 1fr; gap: 32px; }
        @media(max-width:768px){ .order-body { grid-template-columns: 1fr; } }
        .order-section-title { font-size: .8rem; font-weight: 700; color: #a0aec0; text-transform: uppercase; letter-spacing: .5px; margin-bottom: 12px; }
        .shipping-box { background: #f8fafc; padding: 16px; border-radius: 12px; border: 1px solid #f1f5f9; font-size: .9rem; color: #4a5568; line-height: 1.6; }
        .product-item { display: flex; align-items: center; gap: 12px; padding: 10px 0; border-bottom: 1px solid #f1f5f9; }
        .product-item:last-child { border-bottom: none; }
        .product-thumb { width: 50px; height: 50px; border-radius: 8px; object-fit: cover; background: #f1f5f9; }
        .product-info { flex: 1; }
        .product-name-sm { font-size: .875rem; font-weight: 700; color: #1a1a2e; }
        .product-meta-sm { font-size: .8rem; color: #718096; }
        .order-total-val { font-size: 1.25rem; font-weight: 800; color: #1a1a2e; text-align: right; }
    </style>
    @yield('styles')
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar">
    <div class="navbar-inner">
        <a href="{{ route('home') }}" class="navbar-brand">YG<span> Tech store</span></a>
        <ul class="navbar-nav">
            <li><a href="{{ route('products.index') }}" class="{{ request()->routeIs('products.*') ? 'active' : '' }}">Products</a></li>
            @if(!auth()->check() || !auth()->user()->isAdmin())
                <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About Us</a></li>
                <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
            @endif
            @auth
                @if(auth()->user()->isAdmin())
                    <li><a href="{{ route('admin.orders') }}" class="{{ request()->routeIs('admin.orders') ? 'active' : '' }}">Customer Order</a></li>
                    <li><a href="{{ route('admin.contacts') }}" class="{{ request()->routeIs('admin.contacts') ? 'active' : '' }}">Customer Service</a></li>
                @endif
            @endauth
        </ul>
        <form action="{{ route('products.index') }}" method="GET" class="navbar-search">
            <i class="fas fa-search search-icon"></i>
            <input type="text" name="search" placeholder="Search products..." value="{{ request('search') }}" autocomplete="off">
        </form>
        <div class="navbar-actions">
            @if(!auth()->check() || !auth()->user()->isAdmin())
                <button class="btn-cart" onclick="toggleCart()">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="cart-badge" id="cartBadge" style="display:none;">0</span>
                </button>
            @endif
@auth
                <div class="user-menu" tabindex="0">
                    <div class="user-avatar">{{ substr(auth()->user()->name, 0, 1) }}</div>
                    <div class="user-dropdown">
                        @if(!auth()->user()->isAdmin())
                            <a href="{{ route('profile.edit') }}"><i class="fas fa-user-circle"></i> Profile</a>
                            <a href="{{ route('orders.index') }}"><i class="fas fa-shopping-bag"></i> My Orders</a>
                        @endif
                        <hr class="dropdown-divider">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"><i class="fas fa-sign-out-alt"></i> Log Out</button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="btn btn-auth btn-login">Log In</a>
                <a href="{{ route('register') }}" class="btn btn-auth btn-register">Register</a>
            @endauth
        </div>
    </div>
</nav>

@if(session('success'))
<div class="container" style="padding-top:16px;">
    <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
</div>
@endif

<main class="main-content">
    @yield('content')
</main>

@if(!auth()->check() || !auth()->user()->isAdmin())
<!-- FOOTER -->
<footer class="footer">
    <div class="footer-grid">
        <div>
            <div class="footer-brand-text">YG<span> Tech store</span></a></div>
            <p class="footer-desc">Your one-stop destination for premium technology products. Quality guaranteed, shipped worldwide.</p>
        </div>
        <div>
            <div class="footer-heading">Shop</div>
            <ul class="footer-links">
                <li><a href="{{ route('products.index') }}">All Products</a></li>
                <li><a href="{{ route('products.index', ['category'=>'audio']) }}">Audio</a></li>
                <li><a href="{{ route('products.index', ['category'=>'wearables']) }}">Wearables</a></li>
                <li><a href="{{ route('products.index', ['category'=>'computers']) }}">Computers</a></li>
            </ul>
        </div>
        <div>
            <div class="footer-heading">Company</div>
            <ul class="footer-links">
                <li><a href="{{ route('about') }}">About Us</a></li>
                <li><a href="{{ route('contact') }}">Contact Us</a></li>
                <li><a href="{{ route('privacy.policy') }}">Privacy Policy</a></li>
                <li><a href="{{ route('terms.service') }}">Terms of Service</a></li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <span>&copy; {{ date('Y') }} TechStore. All rights reserved.</span>
        <span>Made with <i class="fas fa-heart" style="color:#a78bfa;"></i> for tech lovers</span>
    </div>
</footer>
@endif




<!-- CART SIDEBAR -->
<div class="cart-overlay" id="cartOverlay" onclick="toggleCart()"></div>
<div class="cart-sidebar" id="cartSidebar">
    <div class="cart-header">
        <h2><i class="fas fa-shopping-bag" style="color:#6c3fff;margin-right:8px;"></i>Shopping Cart (<span id="cartCount">0</span> items)</h2>
        <button class="cart-close" onclick="toggleCart()"><i class="fas fa-times"></i></button>
    </div>
    <div class="cart-body" id="cartBody">
        <div class="cart-empty">
            <div class="cart-empty-icon"><i class="fas fa-shopping-bag"></i></div>
            <p>Your cart is empty</p>
            <small>Add some products to get started</small>
        </div>
    </div>
    <div class="cart-footer" id="cartFooter" style="display:none;">
        <div class="cart-total">
            <span>Total</span>
            <span class="cart-total-amount" id="cartTotal">$0.00</span>
        </div>
        @if(!auth()->check())
            <a href="{{ route('login') }}" class="btn-checkout"><i class="fas fa-sign-in-alt"></i> Login to Checkout</a>
        @else
            <a href="{{ route('checkout.index') }}" class="btn-checkout"><i class="fas fa-lock"></i> Checkout</a>
        @endif
    </div>
</div>

<div class="toast-container" id="toastContainer"></div>

<script>
    const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').content;
    const ASSET_URL = "{{ asset('') }}";

    function toggleCart() {
        const overlay = document.getElementById('cartOverlay');
        const sidebar = document.getElementById('cartSidebar');
        const isOpen  = sidebar.classList.contains('open');
        overlay.classList.toggle('open', !isOpen);
        sidebar.classList.toggle('open', !isOpen);
        if (!isOpen) loadCart();
    }

    async function loadCart() {
        try {
            const res  = await fetch('{{ route("cart.index") }}');
            const data = await res.json();
            updateCartUI(data);
        } catch(e) {}
    }

    function updateCartUI(data) {
        const badge  = document.getElementById('cartBadge');
        const body   = document.getElementById('cartBody');
        const footer = document.getElementById('cartFooter');
        document.getElementById('cartCount').textContent = data.count;
        document.getElementById('cartTotal').textContent = '$' + parseFloat(data.total || 0).toFixed(2);
        badge.textContent    = data.count;
        badge.style.display  = data.count > 0 ? 'flex' : 'none';

        if (!data.items || data.items.length === 0) {
            body.innerHTML = `<div class="cart-empty"><div class="cart-empty-icon"><i class="fas fa-shopping-bag"></i></div><p>Your cart is empty</p><small>Add some products to get started</small></div>`;
            footer.style.display = 'none';
        } else {
            footer.style.display = 'block';
            body.innerHTML = data.items.map(item => `
                <div class="cart-item">
                    <div class="cart-item-img">
                        <img src="${ASSET_URL}${item.image_url || ''}" alt="${item.name}" onerror="this.src='https://placehold.co/64x64/f0ecff/6c3fff?text=IMG'">
                    </div>
                    <div class="cart-item-details">
                        <div class="cart-item-name">${item.name}</div>
                        <div class="cart-item-price">$${parseFloat(item.price).toFixed(2)} each</div>
                        <div class="cart-item-controls">
                            <button class="qty-btn" onclick="updateQty(${item.product_id}, ${item.quantity - 1})"><i class="fas fa-minus"></i></button>
                            <span class="qty-display">${item.quantity}</span>
                            <button class="qty-btn" onclick="updateQty(${item.product_id}, ${item.quantity + 1})"><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                    <span class="cart-item-subtotal">$${parseFloat(item.subtotal).toFixed(2)}</span>
                    <button class="cart-item-remove" onclick="removeFromCart(${item.product_id})"><i class="fas fa-trash-alt"></i></button>
                </div>`).join('');
        }
    }

    async function addToCart(productId, btn) {
        if (btn) { btn.disabled = true; btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Adding...'; }
        try {
            const res  = await fetch('{{ route("cart.add") }}', { method: 'POST', headers: {'Content-Type':'application/json','X-CSRF-TOKEN':CSRF_TOKEN}, body: JSON.stringify({product_id: productId, quantity: 1}) });
            const data = await res.json();
            if (data.success) {
                updateCartUI(data);
                showToast('Added to cart!');
                if (btn) { btn.innerHTML = '<i class="fas fa-check"></i> Added!'; btn.classList.add('added'); setTimeout(() => { btn.innerHTML = '<i class="fas fa-shopping-cart"></i> Add to Cart'; btn.classList.remove('added'); btn.disabled = false; }, 1500); }
            }
        } catch(e) { if (btn) { btn.disabled = false; btn.innerHTML = '<i class="fas fa-shopping-cart"></i> Add to Cart'; } }
    }

    async function updateQty(productId, quantity) {
        if (quantity < 1) { removeFromCart(productId); return; }
        const res = await fetch('{{ route("cart.update") }}', { method:'POST', headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CSRF_TOKEN}, body: JSON.stringify({product_id: productId, quantity}) });
        const data = await res.json();
        if (data.success) updateCartUI(data);
    }

    async function removeFromCart(productId) {
        const res = await fetch('{{ route("cart.remove") }}', { method:'POST', headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CSRF_TOKEN}, body: JSON.stringify({product_id: productId}) });
        const data = await res.json();
        if (data.success) { updateCartUI(data); showToast('Item removed', 'info'); }
    }

    function showToast(msg, type='success') {
        const el = document.createElement('div');
        el.className = 'toast';
        el.style.borderLeftColor = type === 'success' ? '#10b981' : '#6c3fff';
        el.innerHTML = `<i class="fas fa-${type === 'success' ? 'check-circle' : 'info-circle'}" style="color:${type === 'success' ? '#10b981' : '#6c3fff'}"></i> ${msg}`;
        document.getElementById('toastContainer').appendChild(el);
        setTimeout(() => el.remove(), 2800);
    }

    document.addEventListener('DOMContentLoaded', () => {
        fetch('{{ route("cart.index") }}').then(r => r.json()).then(d => {
            const b = document.getElementById('cartBadge');
            if (d.count > 0) { b.textContent = d.count; b.style.display = 'flex'; }
        }).catch(() => {});
    });
</script>
@yield('scripts')
</body>
</html>
