@extends('layouts.app')

@section('title', __('messages.workouts.edit') . ' — GymHub')

@section('content')
<div style="max-width: 800px; margin: 0 auto;">
    <div style="margin-bottom: 2rem;">
        <h1 class="section-title"><i class="fas fa-edit" style="color: var(--primary);"></i> {{ __('messages.workouts.edit') }}</h1>
        <p class="section-subtitle">{{ __('messages.workouts.subtitle') }}</p>
    </div>

    <div class="card">
        <form action="{{ route('workouts.update', $project->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label class="form-label" for="title">{{ __('messages.workouts.name') }}</label>
                <input type="text" name="title" id="title" class="form-input" required value="{{ old('title', $project->title) }}">
                @error('title') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="description">{{ __('messages.workouts.description') }}</label>
                <textarea name="description" id="description" class="form-input" required>{{ old('description', $project->description) }}</textarea>
                @error('description') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div style="display: flex; gap: 12px; margin-top: 2rem;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> {{ __('messages.common.save') }}
                </button>
                <a href="{{ route('workouts.index') }}" class="btn btn-secondary">
                    {{ __('messages.common.back') }}
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
