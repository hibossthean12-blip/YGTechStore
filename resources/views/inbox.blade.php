@extends('layouts.app')

@section('title', 'Messenger - Inbox')

@section('styles')
<style>
    .messenger-container {
        max-width: 1000px;
        margin: 40px auto;
        padding: 0 24px;
        display: flex;
        flex-direction: column;
        gap: 32px;
    }

    .messenger-header {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .messenger-title {
        font-size: 2rem;
        font-weight: 800;
        color: #1a1a2e;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .messenger-badge {
        background: #f0ecff;
        color: #6c3fff;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 700;
    }

    .message-thread {
        background: #fff;
        border-radius: 20px;
        border: 1px solid #edf2f7;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.04);
        display: flex;
        flex-direction: column;
    }

    .thread-header {
        background: #f8fafc;
        padding: 20px 32px;
        border-bottom: 1px solid #edf2f7;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .subject-info h3 {
        font-size: 1.1rem;
        font-weight: 800;
        color: #1a1a2e;
        margin-bottom: 4px;
    }

    .subject-info p {
        font-size: 0.85rem;
        color: #718096;
    }

    .thread-body {
        padding: 32px;
        display: flex;
        flex-direction: column;
        gap: 24px;
        background: #fdfbff;
    }

    /* BUBBLES */
    .bubble {
        max-width: 80%;
        padding: 16px 20px;
        border-radius: 18px;
        font-size: 0.95rem;
        line-height: 1.6;
        position: relative;
    }

    .bubble-user {
        align-self: flex-end;
        background: #6c3fff;
        color: #fff;
        border-bottom-right-radius: 4px;
    }

    .bubble-admin {
        align-self: flex-start;
        background: #fff;
        color: #1a1a2e;
        border: 1px solid #e2e8f0;
        border-bottom-left-radius: 4px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.02);
    }

    .bubble-meta {
        font-size: 0.7rem;
        margin-top: 8px;
        display: block;
        opacity: 0.8;
    }

    .bubble-admin .bubble-meta {
        color: #718096;
    }

    .bubble-user .bubble-meta {
        color: rgba(255,255,255,0.9);
        text-align: right;
    }

    .admin-tag {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        color: #6c3fff;
        margin-bottom: 6px;
        display: block;
    }

    .empty-inbox {
        text-align: center;
        padding: 80px 40px;
        background: #fff;
        border-radius: 20px;
        border: 2px dashed #e2e8f0;
    }

    .empty-inbox i {
        font-size: 3.5rem;
        color: #cbd5e0;
        margin-bottom: 24px;
    }

    .empty-inbox h3 {
        font-size: 1.5rem;
        font-weight: 800;
        color: #1a1a2e;
        margin-bottom: 12px;
    }

    .empty-inbox p {
        color: #718096;
        margin-bottom: 32px;
    }

    .btn-contact {
        padding: 14px 32px;
        background: #6c3fff;
        color: #fff;
        border-radius: 12px;
        font-weight: 700;
        transition: all 0.2s;
    }

    .btn-contact:hover {
        background: #5b34d9;
        transform: translateY(-2px);
    }
</style>
@endsection

@section('content')
<div class="messenger-container">
    <div class="messenger-header">
        <h1 class="messenger-title"><i class="fas fa-comments" style="color: #6c3fff;"></i> Messenger</h1>
        <span class="messenger-badge">{{ $messages->count() }} Conversations</span>
    </div>

    @forelse($messages as $msg)
    <div class="message-thread">
        <div class="thread-header">
            <div class="subject-info">
                <h3>{{ $msg->subject }}</h3>
                <p>Started on {{ $msg->created_at->format('M d, Y') }}</p>
            </div>
            <span class="status-badge {{ $msg->status === 'replied' ? 'status-completed' : 'status-pending' }}">
                {{ $msg->status === 'replied' ? 'Replied' : 'Waiting' }}
            </span>
        </div>

        <div class="thread-body">
            <!-- User Message Bubble -->
            <div class="bubble bubble-user">
                {{ $msg->message }}
                <span class="bubble-meta">{{ $msg->created_at->diffForHumans() }}</span>
            </div>

            <!-- Admin Reply Bubble -->
            @if($msg->reply)
            <div class="bubble bubble-admin">
                <span class="admin-tag">Support Team</span>
                {{ $msg->reply }}
                <span class="bubble-meta">{{ $msg->replied_at ? $msg->replied_at->diffForHumans() : '' }}</span>
            </div>
            @endif
        </div>
    </div>
    @empty
    <div class="empty-inbox">
        <i class="fas fa-paper-plane"></i>
        <h3>Your Mailbox is Empty</h3>
        <p>You haven't sent any messages yet. If you have a question, send us a message!</p>
        <a href="{{ route('contact') }}" class="btn-contact">Send Message</a>
    </div>
    @endforelse
</div>
@endsection
