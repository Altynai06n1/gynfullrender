@extends('layouts.app')

@section('title', __('messages.workouts.create'))

@section('content')
<div style="max-width: 800px; margin: 0 auto;">
    <div style="margin-bottom: 2rem;">
        <h1 class="section-title">
            <i class="fas fa-plus-circle" style="color: var(--primary);"></i>
            {{ __('messages.workouts.create') }}
        </h1>
        <p style="color: var(--text-dim);">{{ __('messages.workouts.subtitle') }}</p>
    </div>

    <div class="card-premium">
        <form action="{{ route('workouts.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label class="form-label" for="title">{{ __('messages.workouts.name') }}</label>
                <input type="text" name="title" id="title" class="form-input" 
                       placeholder="{{ __('messages.workouts.placeholder_title') }}" required value="{{ old('title') }}">
                @error('title') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="description">{{ __('messages.workouts.description') }}</label>
                <textarea name="description" id="description" class="form-input" 
                          placeholder="{{ __('messages.workouts.placeholder_description') }}" 
                          style="min-height: 150px; resize: vertical;" required>{{ old('description') }}</textarea>
                @error('description') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div style="display: flex; gap: 15px; margin-top: 2rem; border-top: 1px solid var(--border); padding-top: 2rem;">
                <button type="submit" class="btn-premium btn-neon">
                    <i class="fas fa-save"></i> {{ __('messages.common.save') }}
                </button>
                <a href="{{ route('workouts.index') }}" class="btn-premium btn-outline">
                    {{ __('messages.common.back') }}
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
