@extends('layouts.app')

@section('title', 'About Us')

@section('styles')
<style>
    .about-hero {
        background: linear-gradient(135deg, #1a1a2e 0%, #2d1b69 100%);
        padding: 100px 0;
        text-align: center;
        color: #fff;
        position: relative;
        overflow: hidden;
    }

    .about-hero::after {
        content: '';
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: url('https://www.transparenttextures.com/patterns/cubes.png');
        opacity: 0.05;
    }

    .about-hero h1 {
        font-size: 3.5rem;
        font-weight: 900;
        margin-bottom: 20px;
        letter-spacing: -1px;
    }

    .about-hero p {
        font-size: 1.25rem;
        opacity: 0.8;
        max-width: 700px;
        margin: 0 auto;
        line-height: 1.6;
    }

    .about-section {
        padding: 80px 0;
    }

    .about-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 60px;
        align-items: center;
    }

    @media (max-width: 900px) {
        .about-grid {
            grid-template-columns: 1fr;
        }
    }

    .about-content h2 {
        font-size: 2.2rem;
        font-weight: 800;
        color: #1a1a2e;
        margin-bottom: 24px;
        line-height: 1.2;
    }

    .about-content p {
        font-size: 1.1rem;
        color: #4a5568;
        line-height: 1.8;
        margin-bottom: 24px;
    }

    .brand-logos {
        display: flex;
        flex-wrap: wrap;
        gap: 32px;
        margin-top: 40px;
        align-items: center;
    }

    .brand-logo {
        height: 40px;
        opacity: 0.5;
        transition: opacity 0.3s;
        filter: grayscale(100%);
    }

    .brand-logo:hover {
        opacity: 1;
        filter: grayscale(0%);
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
        margin-top: 60px;
    }

    .stat-card {
        background: #fff;
        padding: 32px;
        border-radius: 20px;
        border: 1px solid #edf2f7;
        text-align: center;
        box-shadow: 0 4px 12px rgba(0,0,0,0.02);
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 800;
        color: #6c3fff;
        display: block;
        margin-bottom: 8px;
    }

    .stat-label {
        font-size: 0.875rem;
        font-weight: 700;
        color: #718096;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .mission-box {
        background: #f8fafc;
        border-radius: 24px;
        padding: 48px;
        border: 1px solid #edf2f7;
    }

    .feature-list {
        list-style: none;
        padding: 0;
        margin-top: 24px;
    }

    .feature-list li {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 16px;
        font-weight: 600;
        color: #2d3748;
    }

    .feature-list i {
        color: #10b981;
    }
</style>
@endsection

@section('content')
<div class="about-hero">
    <div class="container">
        <h1>Welcome to <span style="color: #a78bfa;">YG Tech store</span></h1>
        <p>Driven by quality, powered by innovation. We bring you the world's finest technology products, all in one place.</p>
    </div>
</div>

<div class="about-section">
    <div class="container">
        <div class="about-grid">
            <div class="about-content">
                <h2>Excellence That Speaks For Itself</h2>
                <p>At **YG Tech store**, we believe that everyone deserves access to high-performance technology without compromise. Team YG is dedicated to curating a premium selection of quality products from globally recognized brands. Whether you're a professional seeking high-end gear or a tech enthusiast looking for the latest gadgets, we've got you covered.</p>
                <p>Our team meticulously selects every item in our inventory, ensuring it meets our rigorous standards for performance, durability, and style. We aren't just selling products; we're providing the tools that empower your digital lifestyle.</p>
                
                <div class="brand-logos">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/f/fa/Apple_logo_black.svg" alt="Apple" class="brand-logo" style="height: 30px;">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/2/24/Samsung_Logo.svg" alt="Samsung" class="brand-logo">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/6/69/Sony_logo.svg" alt="Sony" class="brand-logo">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/b/bd/HP_logo_2012.svg" alt="HP" class="brand-logo" style="height: 30px;">
                </div>
            </div>
            
            <div class="mission-box">
                <h3 style="font-size: 1.5rem; font-weight: 800; margin-bottom: 20px;">Why Choose Team YG?</h3>
                <p style="color: #718096; line-height: 1.7;">We bridge the gap between world-class brands and tech lovers in Cambodia and beyond. Our commitment extends beyond the point of sale.</p>
                <ul class="feature-list">
                    <li><i class="fas fa-check-circle"></i> 100% Authentic Brand Products</li>
                    <li><i class="fas fa-check-circle"></i> Localized Support & Warranty</li>
                    <li><i class="fas fa-check-circle"></i> Curated Tech Recommendations</li>
                    <li><i class="fas fa-check-circle"></i> Fast & Secure Delivery (7-14 target)</li>
                </ul>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <span class="stat-number">50+</span>
                <span class="stat-label">Global Brands</span>
            </div>
            <div class="stat-card">
                <span class="stat-number">10k+</span>
                <span class="stat-label">Happy Customers</span>
            </div>
            <div class="stat-card">
                <span class="stat-number">24/7</span>
                <span class="stat-label">Expert Support</span>
            </div>
        </div>
    </div>
</div>
@endsection
