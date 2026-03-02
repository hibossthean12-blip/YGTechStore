@extends('layouts.app')

@section('title', 'Contact Us')
@section('meta_description', 'Get in touch with TechStore. We respond within 24 hours.')

@section('styles')
<style>
    .contact-hero { background: #fff; padding: 52px 0 48px; text-align: center; border-bottom: 1px solid #edf2f7; }
    .contact-hero h1 { font-size: 2.2rem; font-weight: 800; color: #1a1a2e; margin-bottom: 12px; letter-spacing: -.5px; }
    .contact-hero p { font-size: 1rem; color: #6b7280; max-width: 480px; margin: 0 auto; line-height: 1.7; }

    /* INFO CARDS */
    .contact-info-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 20px; margin: 40px 0; }
    @media(max-width:768px){.contact-info-grid{grid-template-columns:1fr;}}
    .contact-info-card { background: #fff; border: 1px solid #edf2f7; border-radius: 14px; padding: 28px 24px; text-align: center; transition: all .2s; }
    .contact-info-card:hover { transform: translateY(-4px); box-shadow: 0 10px 30px rgba(0,0,0,.08); border-color: transparent; }
    .contact-icon { width: 54px; height: 54px; border-radius: 50%; margin: 0 auto 14px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; }
    .contact-icon.purple { background: #f3e8ff; color: #7c3aed; }
    .contact-icon.blue   { background: #dbeafe; color: #2563eb; }
    .contact-icon.green  { background: #d1fae5; color: #059669; }
    .contact-info-title { font-size: .95rem; font-weight: 700; color: #1a1a2e; margin-bottom: 6px; }
    .contact-info-val   { font-size: .875rem; color: #6b7280; line-height: 1.6; }

    /* MAIN GRID */
    .contact-grid { display: grid; grid-template-columns: 3fr 2fr; gap: 28px; padding: 0 0 60px; }
    @media(max-width:900px){.contact-grid{grid-template-columns:1fr;}}

    /* FORM */
    .contact-form-card { background: #fff; border: 1px solid #edf2f7; border-radius: 16px; padding: 32px; }
    .form-card-title { font-size: 1.2rem; font-weight: 800; color: #1a1a2e; margin-bottom: 24px; }
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
    @media(max-width:560px){.form-row{grid-template-columns:1fr;}}
    .form-group { margin-bottom: 18px; }
    .form-label { display: block; font-size: .825rem; font-weight: 600; color: #374151; margin-bottom: 6px; }
    .form-label .required { color: #ef4444; margin-left: 2px; }
    .form-input { width: 100%; padding: 11px 14px; border: 1.5px solid #e2e8f0; border-radius: 10px; font-size: .875rem; color: #1a1a2e; background: #fff; outline: none; transition: all .2s; }
    .form-input:focus { border-color: #6c3fff; box-shadow: 0 0 0 3px rgba(108,63,255,.1); }
    .form-input::placeholder { color: #a0aec0; }
    textarea.form-input { resize: vertical; min-height: 120px; }
    .btn-submit { width: 100%; padding: 14px; background: #1a1a2e; color: #fff; border-radius: 12px; font-size: 1rem; font-weight: 700; display: flex; align-items: center; justify-content: center; gap: 10px; transition: all .2s; border: none; cursor: pointer; margin-top: 4px; }
    .btn-submit:hover { background: #6c3fff; transform: translateY(-1px); box-shadow: 0 6px 20px rgba(108,63,255,.3); }
    .error-msg { color: #ef4444; font-size: .775rem; margin-top: 4px; }

    /* SIDE CARDS */
    .side-card { background: #fff; border: 1px solid #edf2f7; border-radius: 14px; padding: 24px; margin-bottom: 20px; }
    .side-card-title { font-size: .95rem; font-weight: 700; color: #1a1a2e; margin-bottom: 14px; display: flex; align-items: center; gap: 8px; }
    .hours-row { display: flex; justify-content: space-between; font-size: .85rem; padding: 6px 0; border-bottom: 1px solid #f0f4f8; }
    .hours-row:last-child { border-bottom: none; }
    .hours-day { color: #6b7280; }
    .hours-time { font-weight: 600; color: #1a1a2e; }

    /* FAQ */
    .faq-item { margin-bottom: 12px; }
    .faq-q { font-size: .875rem; font-weight: 700; color: #1a1a2e; margin-bottom: 4px; }
    .faq-a { font-size: .825rem; color: #6b7280; line-height: 1.6; }

    /* LIVE CHAT */
    .live-chat-card { background: linear-gradient(135deg,#6c3fff,#a855f7); border-radius: 14px; padding: 24px; color: #fff; }
    .live-chat-title { font-size: 1rem; font-weight: 700; margin-bottom: 8px; }
    .live-chat-desc  { font-size: .825rem; opacity: .85; margin-bottom: 16px; line-height: 1.6; }
    .btn-live-chat { width: 100%; padding: 12px; background: rgba(255,255,255,.15); color: #fff; border-radius: 10px; font-size: .875rem; font-weight: 700; border: 1.5px solid rgba(255,255,255,.4); display: flex; align-items: center; justify-content: center; gap: 8px; transition: all .2s; cursor: pointer; }
    .btn-live-chat:hover { background: rgba(255,255,255,.25); border-color: #fff; }
</style>
@endsection

@section('content')

<!-- HERO -->
<div class="contact-hero">
    <h1>Contact Us</h1>
    <p>Have a question? We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
</div>

<div style="background:#f8f9fa;padding-top:40px;">
<div class="container">

    <!-- INFO CARDS -->
    <div class="contact-info-grid">
        <div class="contact-info-card">
            <div class="contact-icon purple"><i class="fas fa-phone-alt"></i></div>
            <div class="contact-info-title">Phone</div>
            <div class="contact-info-val">+1 (555) 123-4567<br>Mon-Fri 9am-6pm EST</div>
        </div>
        <div class="contact-info-card">
            <div class="contact-icon blue"><i class="fas fa-envelope"></i></div>
            <div class="contact-info-title">Email</div>
            <div class="contact-info-val">support@ygtechstore.com<br>We reply within 24 hours</div>
        </div>
        <div class="contact-info-card">
            <div class="contact-icon green"><i class="fas fa-map-marker-alt"></i></div>
            <div class="contact-info-title">Location</div>
            <div class="contact-info-val">123 Tech Street<br>San Francisco, CA 94102</div>
        </div>
    </div>

    <!-- MAIN CONTENT GRID -->
    <div class="contact-grid">
        <!-- FORM -->
        <div class="contact-form-card">
            <div class="form-card-title">Send us a Message</div>

            <form action="{{ route('contact.store') }}" method="POST" novalidate>
                @csrf
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="first_name">First Name <span class="required">*</span></label>
                        <input type="text" id="first_name" name="first_name" class="form-input" value="{{ old('first_name') }}" required>
                        @error('first_name')<div class="error-msg">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="last_name">Last Name <span class="required">*</span></label>
                        <input type="text" id="last_name" name="last_name" class="form-input" value="{{ old('last_name') }}" required>
                        @error('last_name')<div class="error-msg">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="email">Email <span class="required">*</span></label>
                    <input type="email" id="email" name="email" class="form-input" value="{{ old('email') }}" required>
                    @error('email')<div class="error-msg">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" class="form-input" value="{{ old('phone') }}" placeholder="+1 (555) 000-0000">
                </div>

                <div class="form-group">
                    <label class="form-label" for="subject">Subject <span class="required">*</span></label>
                    <input type="text" id="subject" name="subject" class="form-input" value="{{ old('subject') }}" required>
                    @error('subject')<div class="error-msg">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="message">Message <span class="required">*</span></label>
                    <textarea id="message" name="message" class="form-input" placeholder="How can we help you?" required>{{ old('message') }}</textarea>
                    @error('message')<div class="error-msg">{{ $message }}</div>@enderror
                </div>

                <button type="submit" class="btn-submit">
                    <i class="fas fa-paper-plane"></i> Send Message
                </button>
            </form>
        </div>

        <!-- SIDEBAR -->
        <div>
            <!-- BUSINESS HOURS -->
            <div class="side-card">
                <div class="side-card-title"><i class="fas fa-clock" style="color:#6c3fff;"></i> Business Hours</div>
                <div class="hours-row"><span class="hours-day">Monday - Friday</span><span class="hours-time">9:00 AM - 6:00 PM</span></div>
                <div class="hours-row"><span class="hours-day">Saturday</span><span class="hours-time">10:00 AM - 4:00 PM</span></div>
                <div class="hours-row"><span class="hours-day">Sunday</span><span class="hours-time" style="color:#ef4444;">Closed</span></div>
            </div>

            <!-- FAQ -->
            <div class="side-card">
                <div class="side-card-title"><i class="fas fa-question-circle" style="color:#6c3fff;"></i> Frequently Asked Questions</div>
                <div class="faq-item">
                    <div class="faq-q">What is your return policy?</div>
                    <div class="faq-a">We offer a 30-day return policy on all products. Items must be in original condition.</div>
                </div>
                <div class="faq-item">
                    <div class="faq-q">Do you offer international shipping?</div>
                    <div class="faq-a">Yes, we ship worldwide. Shipping costs vary by location.</div>
                </div>
                <div class="faq-item">
                    <div class="faq-q">How can I track my order?</div>
                    <div class="faq-a">You'll receive a tracking number via email once your order ships.</div>
                </div>
            </div>

            <!-- LIVE CHAT -->
            <div class="live-chat-card">
                <div class="live-chat-title"><i class="fas fa-comments"></i> Need Immediate Help?</div>
                <p class="live-chat-desc">Our YG Tech store customer support team is available via live chat during business hours.</p>
                <button class="btn-live-chat"><i class="fas fa-comment-dots"></i> Start Live Chat</button>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
