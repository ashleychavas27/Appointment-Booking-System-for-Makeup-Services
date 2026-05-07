@extends('layouts.app')

@section('content')
<div style="text-align: center; padding: 4rem 1rem;" class="animate-fade">
    <h1 style="font-size: 4rem; font-weight: 700; background: linear-gradient(to right, #ff4d94, #fab1a0); -webkit-background-clip: text; -webkit-text-fill-color: transparent; margin-bottom: 1rem;">
        Unleash Your Inner Glow
    </h1>
    <p style="font-size: 1.2rem; opacity: 0.8; max-width: 600px; margin: 0 auto 3rem;">
        Professional makeup services tailored for your most special moments. Book your appointment today and let us handle the glam.
    </p>
    
    <div style="display: flex; gap: 1.5rem; justify-content: center;">
        @auth
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="btn btn-primary" style="padding: 1rem 2rem;">Go to Dashboard</a>
            @else
                <a href="{{ route('client.dashboard') }}" class="btn btn-primary" style="padding: 1rem 2rem;">My Bookings</a>
            @endif
        @else
            <a href="{{ route('register') }}" class="btn btn-primary" style="padding: 1rem 2rem;">Get Started</a>
            <a href="{{ route('login') }}" class="btn" style="border: 1px solid var(--primary); color: var(--primary); padding: 1rem 2rem;">Sign In</a>
        @endauth
    </div>

    <div style="margin-top: 5rem; display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem;">
        <div class="glass-card">
            <div style="font-size: 2.5rem; margin-bottom: 1rem;">💄</div>
            <h3 style="margin-bottom: 0.5rem;">Expert Artistry</h3>
            <p style="opacity: 0.7; font-size: 0.9rem;">Years of experience in bridal, editorial, and event makeup.</p>
        </div>
        <div class="glass-card">
            <div style="font-size: 2.5rem; margin-bottom: 1rem;">✨</div>
            <h3 style="margin-bottom: 0.5rem;">Premium Products</h3>
            <p style="opacity: 0.7; font-size: 0.9rem;">We only use the highest quality, skin-friendly makeup brands.</p>
        </div>
        <div class="glass-card">
            <div style="font-size: 2.5rem; margin-bottom: 1rem;">📅</div>
            <h3 style="margin-bottom: 0.5rem;">Easy Booking</h3>
            <p style="opacity: 0.7; font-size: 0.9rem;">Schedule your session in seconds with our online system.</p>
        </div>
    </div>
</div>
@endsection
