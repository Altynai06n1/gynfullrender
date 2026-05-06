@extends('layouts.app')

@section('title', __('messages.auth.register') . ' — GymHub')

@section('content')
<div class="auth-container">
    <div class="auth-header">
        <div class="auth-icon">
            <i class="fas fa-person-running" style="color: var(--primary);"></i>
        </div>
        <h1 style="font-size: 1.8rem; font-weight: 800;">GymHub</h1>
        <p style="color: var(--text-muted); margin-top: 0.5rem;">{{ __('messages.auth.register') }}</p>
    </div>

    <div class="card" style="padding: 2rem;">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label class="form-label">{{ __('messages.auth.name') }}</label>
                <input type="text" name="name" class="form-input" value="{{ old('name') }}"
                       placeholder="{{ __('messages.auth.placeholder_name') }}" required autofocus>
                @error('name')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">{{ __('messages.auth.email') }}</label>
                <input type="email" name="email" class="form-input" value="{{ old('email') }}"
                       placeholder="{{ __('messages.auth.placeholder_email') }}" required>
                @error('email')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">{{ __('messages.auth.password') }}</label>
                <input type="password" name="password" class="form-input"
                       placeholder="{{ __('messages.auth.placeholder_password') }}" required>
                @error('password')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">{{ __('messages.auth.confirm_password') }}</label>
                <input type="password" name="password_confirmation" class="form-input"
                       placeholder="{{ __('messages.auth.placeholder_confirm_password') }}" required>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center;">
                <i class="fas fa-user-plus"></i> {{ __('messages.auth.register') }}
            </button>
        </form>

        <div style="text-align: center; margin-top: 1.5rem; color: var(--text-muted); font-size: 0.85rem;">
            {{ __('messages.auth.already_registered') }}
            <a href="{{ route('login') }}" style="color: var(--primary); text-decoration: none; font-weight: 600;">
                {{ __('messages.auth.login') }}
            </a>
        </div>
    </div>
</div>

<style>
    .auth-container {
        max-width: 440px;
        width: 95%;
        margin: 4rem auto;
    }

    .auth-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .auth-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
    }

    @media (max-width: 768px) {
        .auth-container {
            margin: 2rem auto;
        }
        
        .card {
            padding: 1.5rem !important;
        }
    }

    @media (max-width: 480px) {
        .auth-container {
            margin: 1.5rem auto;
        }
        
        .auth-header h1 {
            font-size: 1.5rem !important;
        }
    }
</style>
@endsection
