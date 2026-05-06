@extends('layouts.app')

@section('title', __('messages.blog.create'))

@section('content')
<div style="max-width: 800px; margin: 0 auto;">
    <div style="display: flex; align-items: center; gap: 20px; margin-bottom: 40px;">
        <a href="{{ route('blog.index') }}" class="menu-toggle" style="display: flex; text-decoration: none;">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h1 style="font-size: 2rem; font-weight: 800; letter-spacing: -1px;">{{ __('messages.blog.create') }}</h1>
    </div>

    <div class="card-premium">
        <form action="{{ route('blog.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label class="form-label">{{ __('messages.workouts.name') }}</label>
                <input type="text" name="title" class="form-input" placeholder="{{ __('messages.blog.placeholder_title') }}" required value="{{ old('title') }}">
                @error('title') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">{{ __('messages.blog.category') }}</label>
                <select name="category" class="form-input" required>
                    <option value="" disabled selected>{{ __('messages.common.search') }}...</option>
                    <option value="nutrition" {{ old('category') == 'nutrition' ? 'selected' : '' }}>{{ __('messages.blog.categories.nutrition') }}</option>
                    <option value="health" {{ old('category') == 'health' ? 'selected' : '' }}>{{ __('messages.blog.categories.health') }}</option>
                    <option value="exercise" {{ old('category') == 'exercise' ? 'selected' : '' }}>{{ __('messages.blog.categories.exercise') }}</option>
                </select>
                @error('category') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">{{ __('messages.workouts.description') }}</label>
                <textarea name="content" class="form-input" style="min-height: 300px; resize: vertical;" placeholder="{{ __('messages.blog.placeholder_content') }}" required>{{ old('content') }}</textarea>
                @error('content') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div style="display: flex; gap: 15px; margin-top: 40px;">
                <button type="submit" class="btn-premium btn-neon" style="flex: 1; justify-content: center;">
                    <i class="fas fa-check"></i> {{ __('messages.common.create') }}
                </button>
                <a href="{{ route('blog.index') }}" class="btn-premium btn-outline" style="flex: 1; justify-content: center;">
                    {{ __('messages.common.cancel') }}
                </a>
            </div>
        </form>
    </div>
</div>

<style>
    select.form-input {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='white'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 20px center;
        background-size: 20px;
    }
    select.form-input option {
        background: var(--bg-card);
        color: white;
    }
</style>
@endsection
