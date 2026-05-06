@extends('layouts.app')

@section('title', __('messages.auth.login') . ' — GymHub')

@section('content')
<div class="login-architecture">
    <div class="login-card-v2">
        <div class="login-visual">
            <div class="visual-content">
                <i class="fas fa-dumbbell"></i>
                <h2>GymHub</h2>
                <p>{{ __('messages.dashboard.welcome', ['name' => '']) }}</p>
            </div>
            <div class="visual-blur"></div>
        </div>
        
        <div class="login-form-side">
            <div class="form-header">
                <h3>{{ __('messages.auth.login') }}</h3>
                <p>{{ __('messages.dashboard.welcome', ['name' => '']) }}</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group-v2">
                    <label><i class="fas fa-at"></i> {{ __('messages.auth.email') }}</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="member@gymhub.kz" required autofocus>
                    @error('email')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group-v2">
                    <label><i class="fas fa-lock"></i> {{ __('messages.auth.password') }}</label>
                    <input type="password" name="password" placeholder="••••••••" required>
                    @error('password')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-footer-actions">
                    <label class="remember-me">
                        <input type="checkbox" name="remember">
                        <span>{{ __('messages.auth.remember_me') }}</span>
                    </label>
                    <a href="{{ route('password.request') }}" class="forgot-link">{{ __('messages.auth.forgot_password') }}</a>
                </div>

                <button type="submit" class="gym-btn">
                    <span>{{ __('messages.auth.login') }}</span>
                    <i class="fas fa-arrow-right"></i>
                </button>
            </form>

            <div class="auth-switch">
                {{ __('messages.auth.no_account') }} <a href="{{ route('register') }}">{{ __('messages.auth.register') }}</a>
            </div>
        </div>
    </div>
</div>

<style>
    .login-architecture {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: calc(100vh - 150px);
        perspective: 1000px;
    }

    .login-card-v2 {
        display: flex;
        width: 90%; /* Percentage-based width for fluidity */
        max-width: 900px; /* Fixed cap for desktop readability */
        background: #141414;
        border-radius: 30px;
        overflow: hidden;
        border: 1px solid rgba(57, 255, 20, 0.3);
        box-shadow: 0 40px 100px rgba(0,0,0,0.7);
        animation: cardAppear 0.8s cubic-bezier(0.16, 1, 0.3, 1);
    }

    @keyframes cardAppear {
        from { transform: translateY(50px) rotateX(-10deg); opacity: 0; }
        to { transform: translateY(0) rotateX(0); opacity: 1; }
    }

    .login-visual {
        flex: 1;
        background: linear-gradient(135deg, #0a0a0a 0%, #1c1c1c 100%);
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .visual-content {
        position: relative;
        z-index: 2;
        text-align: center;
        color: white;
    }

    .visual-content i {
        font-size: 5rem;
        margin-bottom: 2rem;
        color: #39FF14;
        filter: drop-shadow(0 0 20px rgba(57,255,20,0.4));
    }

    .visual-content h2 {
        font-size: 2.5rem;
        font-weight: 900;
        letter-spacing: -1px;
        color: white;
    }

    .login-form-side {
        flex: 1.2;
        padding: 4rem;
        background: #0d0d0d;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .form-header h3 {
        font-size: 2rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
        color: white;
    }

    .form-header p {
        color: #a3a3a3;
        margin-bottom: 2.5rem;
    }

    .form-group-v2 {
        margin-bottom: 1.5rem;
    }

    .form-group-v2 label {
        display: block;
        font-size: 0.85rem;
        font-weight: 600;
        color: #39FF14;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .form-group-v2 input {
        width: 100%;
        background: #141414;
        border: 1px solid #262626;
        padding: 14px 18px;
        border-radius: 12px;
        color: white;
        font-size: 1rem;
        transition: 0.3s;
    }

    .form-group-v2 input:focus {
        outline: none;
        border-color: #39FF14;
        background: #0d0d0d;
        box-shadow: 0 0 0 4px rgba(57, 255, 20, 0.1);
    }

    .form-footer-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .remember-me {
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        color: #a3a3a3;
        font-size: 0.85rem;
    }

    .forgot-link {
        color: #39FF14;
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .gym-btn {
        width: 100%;
        background: linear-gradient(90deg, #39FF14, #2ee60f);
        border: none;
        padding: 16px;
        border-radius: 12px;
        color: black;
        font-weight: 700;
        font-size: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        cursor: pointer;
        transition: 0.3s;
    }

    .gym-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(57, 255, 20, 0.4);
    }

    .auth-switch {
        margin-top: 2rem;
        text-align: center;
        color: #525252;
        font-size: 0.9rem;
    }

    .auth-switch a {
        color: #39FF14;
        text-decoration: none;
        font-weight: 700;
    }

    .error-text {
        color: #ef4444;
        font-size: 0.8rem;
        margin-top: 5px;
        display: block;
    }

    @media (max-width: 950px) {
        .login-card-v2 { width: 95%; max-width: 450px; flex-direction: column; border-radius: 20px; }
        .login-visual { display: none; }
        .login-form-side { padding: 2.5rem 1.5rem; }
        .form-header h3 { font-size: 1.6rem; }
    }

    @media (max-width: 480px) {
        .login-architecture { min-height: auto; padding: 40px 0; }
        .gym-btn { padding: 14px; }
    }
</style>
@endsection
