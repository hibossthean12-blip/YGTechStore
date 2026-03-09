@extends('layouts.app')

@section('title', 'My Orders')

@section('styles')
<style>
    .orders-container {
        max-width: 1000px;
        margin: 40px auto;
        padding: 0 24px;
    }

    .page-title {
        font-size: 2rem;
        font-weight: 800;
        color: #1a1a2e;
        margin-bottom: 32px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .order-card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #edf2f7;
        box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        margin-bottom: 24px;
        overflow: hidden;
    }

    .order-header {
        background: #f8fafc;
        padding: 20px 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #edf2f7;
    }

    .order-info {
        display: flex;
        gap: 32px;
    }

    .info-group {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .info-label {
        font-size: 0.75rem;
        font-weight: 700;
        color: #718096;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .info-value {
        font-size: 0.9rem;
        font-weight: 600;
        color: #1a1a2e;
    }

    .order-status {
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
    }

    .status-pending { background: #fef3c7; color: #92400e; }
    .status-completed { background: #d1fae5; color: #065f46; }

    .order-body {
        padding: 24px;
    }

    .item-row {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
        padding-bottom: 20px;
        border-bottom: 1px solid #f1f5f9;
        align-items: center;
    }

    .item-row:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
    }

    .item-img {
        width: 80px;
        height: 80px;
        border-radius: 12px;
        object-fit: cover;
        border: 1px solid #edf2f7;
    }

    .item-details {
        flex: 1;
    }

    .item-name {
        font-size: 1rem;
        font-weight: 700;
        color: #1a1a2e;
        margin-bottom: 4px;
    }

    .item-meta {
        font-size: 0.85rem;
        color: #718096;
    }

    .order-footer {
        background: #fff;
        padding: 16px 24px;
        border-top: 1px solid #edf2f7;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .shipping-to {
        font-size: 0.85rem;
        color: #718096;
        flex: 1;
        margin-right: 20px;
    }

    .shipping-to strong {
        color: #4a5568;
    }

    .empty-state {
        text-align: center;
        padding: 80px 24px;
        background: #fff;
        border-radius: 20px;
        border: 2px dashed #e2e8f0;
    }

    .empty-state i {
        font-size: 3rem;
        color: #cbd5e0;
        margin-bottom: 20px;
    }

    .empty-state h3 {
        font-size: 1.25rem;
        font-weight: 700;
        color: #4a5568;
        margin-bottom: 8px;
    }

    .empty-state p {
        color: #718096;
        margin-bottom: 24px;
    }

    .btn-shop {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #6c3fff;
        color: #fff;
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 700;
        transition: all 0.2s;
    }

    .btn-shop:hover {
        background: #5b34d9;
        transform: translateY(-2px);
    }
</style>
@endsection

@section('content')
<div class="orders-container">
    <h1 class="page-title"><i class="fas fa-shopping-bag" style="color: #6c3fff;"></i> My Orders</h1>

    @forelse($orders as $order)
    <div class="order-card">
        <div class="order-header">
            <div class="order-info">
                <div class="info-group">
                    <span class="info-label">Order Placed</span>
                    <span class="info-value">{{ $order->created_at->format('M d, Y') }}</span>
                </div>
                <div class="info-group">
                    <span class="info-label">Total</span>
                    <span class="info-value">${{ number_format($order->total_amount, 2) }}</span>
                </div>
                <div class="info-group">
                    <span class="info-label">Order #</span>
                    <span class="info-value">{{ str_pad($order->id, 8, '0', STR_PAD_LEFT) }}</span>
                </div>
            </div>
            <span class="order-status 
                {{ $order->status === 'pending' ? 'status-pending' : ($order->status === 'cancelled' ? 'status-cancelled' : 'status-completed') }}">
                @if($order->status === 'delivered')
                    Confirm
                @elseif($order->status === 'cancelled')
                    Cancel
                @else
                    {{ ucfirst($order->status) }}
                @endif
            </span>
        </div>

        <div class="order-body">
            @foreach($order->items as $item)
            <div class="item-row">
                <img src="/{{ $item->product->image_url }}" alt="{{ $item->product->name }}" class="item-img" onerror="this.src='https://placehold.co/100x100/f0ecff/6c3fff?text=IMG'">
                <div class="item-details">
                    <div class="item-name">{{ $item->product->name }}</div>
                    <div class="item-meta">Quantity: {{ $item->quantity }} • ${{ number_format($item->price, 2) }} each</div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="order-footer">
            <div class="shipping-to">
                <i class="fas fa-truck-moving" style="margin-right: 6px;"></i>
                <strong>Shipping to:</strong> {{ $order->shipping_address }}
            </div>
            @if($order->status === 'pending')
            <form action="{{ route('orders.cancel', $order->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn-cancel-order" onclick="return confirm('Are you sure you want to cancel this order?')">Cancel Order</button>
            </form>
            @endif
        </div>
    </div>
    @empty
    <div class="empty-state">
        <i class="fas fa-box-open"></i>
        <h3>No orders yet</h3>
        <p>Looks like you haven't placed any orders with YG Tech store yet.</p>
        <a href="{{ route('products.index') }}" class="btn-shop">Start Shopping</a>
    </div>
    @endforelse
</div>
@endsection
