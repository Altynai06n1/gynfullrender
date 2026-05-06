@extends('layouts.app')

@section('title', __('messages.auth.reset_password') . ' — GymHub')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow border-0" style="border-radius: 15px;">
                <div class="card-header bg-primary text-white text-center py-3" style="border-radius: 15px 15px 0 0;">
                    <h4 class="mb-0">{{ __('messages.auth.reset_password') }}</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('password.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('messages.auth.email') }}</label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ $email ?? old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('messages.auth.password') }}</label>
                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">{{ __('messages.auth.confirm_password') }}</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary py-2">{{ __('messages.auth.reset_password_btn') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

