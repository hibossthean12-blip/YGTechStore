@extends('layouts.app')

@section('title', 'Contact Messages')

@section('content')
<div class="section" style="padding: 40px 0;">
    <div class="container">
        <h1 style="font-size: 2rem; font-weight: 800; color: #1a1a2e; margin-bottom: 32px;">Customer Service</h1>

        <div class="order-list">
            @forelse($contacts as $contact)
                <div class="order-card">
                    <div class="order-header">
                        <div>
                            <span class="order-id">Message #{{ $contact->id }}</span>
                            <div class="order-customer">{{ $contact->first_name }} {{ $contact->last_name }}</div>
                            <div class="order-date"><i class="far fa-clock" style="margin-right:6px;"></i>{{ $contact->created_at->diffForHumans() }}</div>
                        </div>
                        <div style="text-align: right;">
                            <span class="status-badge {{ $contact->status === 'pending' ? 'status-pending' : 'status-completed' }}">
                                {{ $contact->status }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="order-body">
                        <!-- Left: Customer Contact Info -->
                        <div>
                            <div class="order-section-title">Customer Details</div>
                            <div class="shipping-box">
                                <div style="margin-bottom: 8px;">
                                    <i class="fas fa-envelope" style="color:#6c3fff; width:20px;"></i>
                                    <a href="mailto:{{ $contact->email }}" style="color: inherit; text-decoration: none; font-weight: 600;">{{ $contact->email }}</a>
                                </div>
                                @if($contact->phone)
                                    <div>
                                        <i class="fas fa-phone-alt" style="color:#6c3fff; width:20px;"></i>
                                        <span style="font-weight: 600;">{{ $contact->phone }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Right: Message Content -->
                        <div>
                            <div class="order-section-title">Message: "{{ $contact->subject }}"</div>
                            <div style="background: #fff; padding: 16px; border-radius: 12px; border: 1px solid #f1f5f9; font-size: .9rem; color: #4a5568; line-height: 1.7; white-space: pre-line;">
                                {{ $contact->message }}
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div style="background: #fff; border-radius: 16px; border: 1px solid #edf2f7; padding: 60px; text-align: center;">
                    <div style="width: 70px; height: 70px; background: #f8fafc; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; color: #a0aec0;">
                        <i class="fas fa-envelope-open-text" style="font-size: 1.5rem;"></i>
                    </div>
                    <h3 style="font-size: 1.25rem; font-weight: 800; color: #1a1a2e; margin-bottom: 8px;">No messages found</h3>
                    <p style="color: #718096;">When customers send messages, they will appear here.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
