@extends('layouts.app')

@section('title', __('messages.auth.forgot_password') . ' — GymHub')

@section('content')
<div style="display: flex; justify-content: center; align-items: center; min-height: 80vh;">
    <div class="card-premium" style="max-width: 500px; width: 100%; text-align: center;">
        <div style="font-size: 3.5rem; color: var(--primary); margin-bottom: 25px; filter: drop-shadow(0 0 15px var(--primary-glow));">
            <i class="fas fa-key-skeleton"></i>
        </div>
        
        <h2 style="font-size: 2rem; font-weight: 800; margin-bottom: 15px; letter-spacing: -1px;">{{ strtoupper(__('messages.auth.forgot_password')) }}</h2>
        <p style="color: var(--text-dim); margin-bottom: 35px; line-height: 1.6;">{{ __('messages.auth.forgot_password_subtitle') }}</p>

        @if (session('status'))
            <div style="background: rgba(57, 255, 20, 0.1); border: 1px solid var(--primary); color: var(--primary); padding: 15px; border-radius: 12px; margin-bottom: 25px; font-weight: 600; font-size: 0.9rem;">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div style="text-align: left; margin-bottom: 30px;">
                <label style="display: block; font-size: 0.8rem; font-weight: 800; color: var(--primary); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 10px;">
                    {{ __('messages.auth.email') }}
                </label>
                <div style="position: relative;">
                    <i class="fas fa-envelope" style="position: absolute; left: 20px; top: 50%; transform: translateY(-50%); color: var(--text-dim);"></i>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                           placeholder="{{ __('messages.auth.placeholder_email') }}"
                           style="width: 100%; background: #0a0a0a; border: 1px solid var(--border); padding: 16px 16px 16px 50px; border-radius: 15px; color: white; font-family: inherit; font-size: 1rem; transition: all 0.3s;">
                </div>
                @error('email')
                    <p style="color: #ef4444; font-size: 0.8rem; margin-top: 8px; font-weight: 600;">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn-premium btn-neon" style="width: 100%; justify-content: center; padding: 18px; font-size: 1rem;">
                {{ __('messages.auth.send_link') }} <i class="fas fa-paper-plane" style="margin-left: 10px;"></i>
            </button>
        </form>

        <div style="margin-top: 30px; padding-top: 25px; border-top: 1px solid var(--border);">
            <a href="{{ route('login') }}" style="color: var(--text-dim); text-decoration: none; font-size: 0.9rem; font-weight: 600; transition: 0.3s;" onmouseover="this.style.color='#39FF14'" onmouseout="this.style.color='#a0a0a0'">
                <i class="fas fa-arrow-left" style="margin-right: 8px;"></i> {{ __('messages.auth.back_to_login') }}
            </a>
        </div>
    </div>
</div>
@endsection
