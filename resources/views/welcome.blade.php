@extends('layouts.app')

@section('content')
<div style="text-align: center; padding: 4rem 1rem;" class="animate-fade">
    <h1 style="font-size: 4rem; font-weight: 800; background: linear-gradient(to right, #f91880, #ff7675); -webkit-background-clip: text; -webkit-text-fill-color: transparent; margin-bottom: 1.5rem; letter-spacing: -2px;">
        Unleash Your Inner Glow
    </h1>
    <p style="font-size: 1.25rem; color: var(--text-light); max-width: 650px; margin: 0 auto 3.5rem; font-weight: 400;">
        Professional makeup services tailored for your most special moments. Book your appointment today and let us handle the glam.
    </p>
    
    <div style="display: flex; gap: 1rem; justify-content: center;">
        @auth
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="btn btn-primary" style="padding: 1rem 2.5rem;">Go to Dashboard</a>
            @else
                <a href="{{ route('client.dashboard') }}" class="btn btn-primary" style="padding: 1rem 2.5rem;">My Bookings</a>
            @endif
        @else
            <a href="{{ route('register') }}" class="btn btn-primary" style="padding: 1rem 2.5rem; font-size: 1rem;">Get Started Now</a>
            <a href="{{ route('login') }}" class="btn" style="border: 1px solid var(--border); color: var(--text-dark); background: white; padding: 1rem 2.5rem; font-size: 1rem;">Sign In</a>
        @endauth
    </div>

    <div style="margin-top: 6rem; display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 2rem;">
        <div class="glass-card">
            <div style="font-size: 2.5rem; margin-bottom: 1.25rem;">💄</div>
            <h3 style="margin-bottom: 0.75rem; font-weight: 700;">Expert Artistry</h3>
            <p style="color: var(--text-light); font-size: 0.95rem;">Years of experience in bridal, editorial, and event makeup sessions.</p>
        </div>
        <div class="glass-card">
            <div style="font-size: 2.5rem; margin-bottom: 1.25rem;">✨</div>
            <h3 style="margin-bottom: 0.75rem; font-weight: 700;">Premium Products</h3>
            <p style="color: var(--text-light); font-size: 0.95rem;">We only use the highest quality, skin-friendly professional brands.</p>
        </div>
        <div class="glass-card">
            <div style="font-size: 2.5rem; margin-bottom: 1.25rem;">📅</div>
            <h3 style="margin-bottom: 0.75rem; font-weight: 700;">Easy Booking</h3>
            <p style="color: var(--text-light); font-size: 0.95rem;">Schedule your session in seconds with our seamless online system.</p>
        </div>
    </div>
</div>
@endsection
