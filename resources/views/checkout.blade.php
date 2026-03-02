@extends('layouts.app')

@section('title', 'Checkout')

@section('styles')
<style>
    .checkout-container {
        max-width: 1000px;
        margin: 40px auto;
        display: grid;
        grid-template-columns: 1fr 380px;
        gap: 32px;
        padding: 0 24px;
    }

    @media (max-width: 900px) {
        .checkout-container {
            grid-template-columns: 1fr;
        }
    }

    .checkout-section {
        background: #fff;
        border-radius: 16px;
        padding: 32px;
        border: 1px solid #edf2f7;
        box-shadow: 0 4px 12px rgba(0,0,0,0.03);
    }

    .section-title {
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 12px;
        color: #1a1a2e;
    }

    .section-title i {
        color: #6c3fff;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .form-group.full {
        grid-column: span 2;
    }

    @media (max-width: 600px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
        .form-group.full {
            grid-column: span 1;
        }
    }

    label {
        font-size: 0.875rem;
        font-weight: 600;
        color: #4a5568;
    }

    input {
        padding: 12px 16px;
        border: 1.5px solid #e2e8f0;
        border-radius: 10px;
        font-size: 0.95rem;
        transition: all 0.2s;
        outline: none;
    }

    input:focus {
        border-color: #6c3fff;
        box-shadow: 0 0 0 3px rgba(108,63,255,0.1);
    }

    .order-summary-card {
        background: #fff;
        border-radius: 16px;
        padding: 24px;
        border: 1px solid #edf2f7;
        position: sticky;
        top: 100px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.03);
    }

    .summary-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
        font-size: 0.9rem;
        color: #4a5568;
    }

    .summary-total {
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid #edf2f7;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-weight: 800;
        font-size: 1.25rem;
        color: #1a1a2e;
    }

    .payment-method {
        margin-top: 24px;
        padding: 16px;
        background: #f8fafc;
        border-radius: 12px;
        border: 1.5px solid #e2e8f0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .payment-method.active {
        border-color: #6c3fff;
        background: #f0ecff;
    }

    .btn-place-order {
        width: 100%;
        margin-top: 24px;
        padding: 16px;
        background: linear-gradient(135deg, #6c3fff, #a855f7);
        color: #fff;
        border-radius: 12px;
        font-size: 1rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        transition: all 0.2s;
    }

    .btn-place-order:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(108,63,255,0.4);
    }

    .item-list {
        margin-bottom: 24px;
        max-height: 300px;
        overflow-y: auto;
    }

    .mini-item {
        display: flex;
        gap: 12px;
        margin-bottom: 12px;
        align-items: center;
    }

    .mini-item img {
        width: 48px;
        height: 48px;
        border-radius: 8px;
        object-fit: cover;
    }

    .mini-item-info {
        flex: 1;
    }

    .mini-item-name {
        font-size: 0.85rem;
        font-weight: 600;
        color: #1a1a2e;
    }

    .mini-item-price {
        font-size: 0.75rem;
        color: #718096;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="checkout-container">
        <!-- FORM SIDE -->
        <form action="{{ route('checkout.store') }}" method="POST" id="checkoutForm">
            @csrf
            <div class="checkout-section">
                <h2 class="section-title"><i class="fas fa-map-marker-alt"></i> Shipping Address</h2>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label for="house_number">House Number</label>
                        <input type="text" id="house_number" name="house_number" placeholder="e.g. 123/45" required>
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" id="phone_number" name="phone_number" placeholder="e.g. 012 345 678" required>
                    </div>
                    <div class="form-group">
                        <label for="village">Village</label>
                        <input type="text" id="village" name="village" placeholder="Village name" required>
                    </div>
                    <div class="form-group">
                        <label for="street">Street</label>
                        <input type="text" id="street" name="street" placeholder="Street name" required>
                    </div>
                    <div class="form-group">
                        <label for="district">District</label>
                        <input type="text" id="district" name="district" placeholder="District" required>
                    </div>
                    <div class="form-group">
                        <label for="city">City/Town</label>
                        <input type="text" id="city" name="city" placeholder="City" required>
                    </div>
                    <div class="form-group">
                        <label for="province">Province</label>
                        <input type="text" id="province" name="province" placeholder="Province" required>
                    </div>
                    <div class="form-group">
                        <label for="country">Country</label>
                        <input type="text" id="country" name="country" value="Cambodia" readonly style="background: #f8fafc; color: #718096; cursor: not-allowed;">
                    </div>
                </div>

                <h2 class="section-title" style="margin-top: 40px;"><i class="fas fa-credit-card"></i> Payment Method</h2>
                <div class="payment-method active">
                    <i class="fas fa-money-bill-wave" style="color: #6c3fff; font-size: 1.25rem;"></i>
                    <div>
                        <div style="font-weight: 700; font-size: 0.9rem;">Cash on Delivery</div>
                        <div style="font-size: 0.75rem; color: #718096;">Pay when your order arrives</div>
                    </div>
                    <i class="fas fa-check-circle" style="margin-left: auto; color: #6c3fff;"></i>
                </div>
            </div>
        </form>

        <!-- SUMMARY SIDE -->
        <div class="order-summary-card">
            <h3 style="font-size: 1.1rem; font-weight: 700; margin-bottom: 20px;">Order Summary</h3>
            
            <div class="item-list">
                @foreach($items as $item)
                <div class="mini-item">
                    <img src="/{{ $item['image_url'] }}" alt="{{ $item['name'] }}" onerror="this.src='https://placehold.co/64x64/f0ecff/6c3fff?text=IMG'">
                    <div class="mini-item-info">
                        <div class="mini-item-name">{{ $item['name'] }}</div>
                        <div class="mini-item-price">{{ $item['quantity'] }} x ${{ number_format($item['price'], 2) }}</div>
                    </div>
                    <div style="font-weight: 700; font-size: 0.85rem;">${{ number_format($item['subtotal'], 2) }}</div>
                </div>
                @endforeach
            </div>

            <div class="summary-item">
                <span>Subtotal</span>
                <span>${{ number_format($total, 2) }}</span>
            </div>
            <div class="summary-item">
                <span>Shipping</span>
                <span style="color: #10b981; font-weight: 600;">FREE</span>
            </div>
            
            <div class="summary-total">
                <span>Total</span>
                <span>${{ number_format($total, 2) }}</span>
            </div>

            <button type="submit" form="checkoutForm" class="btn-place-order">
                <i class="fas fa-lock"></i> Place Order
            </button>
            <p style="text-align: center; font-size: 0.7rem; color: #a0aec0; margin-top: 16px;">
                Secure Checkout Powered by YG Tech store
            </p>
        </div>
    </div>
</div>
@endsection
