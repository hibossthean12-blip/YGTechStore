@extends('layouts.app')

@section('title', 'Manage Orders')

@section('content')
<div class="section" style="padding: 40px 0;">
    <div class="container">
        <h1 style="font-size: 2rem; font-weight: 800; color: #1a1a2e; margin-bottom: 32px;">Customer Orders</h1>

        <div class="order-list">
            @forelse($orders as $order)
                <div class="order-card">
                    <div class="order-header">
                        <div>
                            <span class="order-id">Order #{{ $order->id }}</span>
                            <div class="order-customer">{{ $order->user->name }}</div>
                            <div class="order-date"><i class="far fa-calendar-alt" style="margin-right:6px;"></i>{{ $order->created_at->format('M d, Y | H:i') }}</div>
                        </div>
                        <div style="text-align: right;">
                            <div style="display: flex; gap: 8px; justify-content: flex-end; margin-bottom: 8px;">
                                @if($order->status === 'pending')
                                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <input type="hidden" name="status" value="delivered">
                                        <button type="submit" class="status-btn btn-confirm">Confirm</button>
                                    </form>
                                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <input type="hidden" name="status" value="cancelled">
                                        <button type="submit" class="status-btn btn-cancel">Cancel</button>
                                    </form>
                                @endif
                            </div>
                            <span class="status-badge 
                                {{ $order->status === 'pending' ? 'status-pending' : ($order->status === 'cancelled' ? 'status-cancelled' : 'status-completed') }}">
                                @if($order->status === 'delivered')
                                    Confirm
                                @elseif($order->status === 'cancelled')
                                    Cancel
                                @else
                                    {{ $order->status }}
                                @endif
                            </span>
                            <div class="order-total-val" style="margin-top:8px;">${{ number_format($order->total_amount, 2) }}</div>
                        </div>
                    </div>
                    
                    <div class="order-body">
                        <!-- Left: Shipping Info -->
                        <div>
                            <div class="order-section-title">Shipping Details</div>
                            <div class="shipping-box">
                                <i class="fas fa-map-marker-alt text-purple-600 mr-2" style="color:#6c3fff;"></i>
                                {{ $order->shipping_address }}
                            </div>
                        </div>

                        <!-- Right: Products -->
                        <div>
                            <div class="order-section-title">Ordered Products</div>
                            <div class="product-item-list">
                                @foreach($order->items as $item)
                                    <div class="product-item">
                                        <img src="/{{ $item->product->image_url }}" 
                                             alt="{{ $item->product->name }}" 
                                             class="product-thumb"
                                             onerror="this.src='https://placehold.co/100x100?text=Product'">
                                        <div class="product-info">
                                            <div class="product-name-sm">{{ $item->product->name }}</div>
                                            <div class="product-meta-sm">Qty: {{ $item->quantity }} &times; ${{ number_format($item->price, 2) }}</div>
                                        </div>
                                        <div class="product-name-sm">
                                            ${{ number_format($item->quantity * $item->price, 2) }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div style="background: #fff; border-radius: 16px; border: 1px solid #edf2f7; padding: 60px; text-align: center;">
                    <div style="width: 70px; height: 70px; background: #f8fafc; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; color: #a0aec0;">
                        <i class="fas fa-shopping-bag" style="font-size: 1.5rem;"></i>
                    </div>
                    <h3 style="font-size: 1.25rem; font-weight: 800; color: #1a1a2e; margin-bottom: 8px;">No orders found</h3>
                    <p style="color: #718096;">When customers place orders, they will appear here.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
