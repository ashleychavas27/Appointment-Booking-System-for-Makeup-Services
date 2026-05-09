@extends('layouts.app')

@section('content')
<div style="display: flex; justify-content: center; align-items: center; min-height: 70vh;">
    <div class="glass-card animate-fade" style="width: 100%; max-width: 450px;">
        <h2 style="text-align: center; margin-bottom: 2rem; font-weight: 700; font-size: 2rem;">Create Account</h2>
        
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <span style="color: #ff7675; font-size: 0.8rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
                @error('password')
                    <span style="color: #ff7675; font-size: 0.8rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" required>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 1rem; padding: 1rem;">Register Now</button>
        </form>

        <p style="text-align: center; margin-top: 2rem; opacity: 0.7; font-size: 0.9rem;">
            Already have an account? <a href="{{ route('login') }}" style="color: var(--primary); text-decoration: none;">Sign In</a>
        </p>
    </div>
</div>
@endsection
