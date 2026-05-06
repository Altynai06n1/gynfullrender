@extends('layouts.app')

@section('title', __('messages.events.create') . ' — GymHub')

@section('content')
<div style="max-width: 800px; margin: 0 auto;">
    <div style="margin-bottom: 2rem;">
        <h1 class="section-title"><i class="fas fa-calendar-plus" style="color: var(--info);"></i> {{ __('messages.events.create') }}</h1>
        <p class="section-subtitle">{{ __('messages.events.subtitle') }}</p>
    </div>

    <div class="card">
        <form action="{{ route('gym-news.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label" for="title">{{ __('messages.events.name') }}</label>
                <input type="text" name="title" id="title" class="form-input" placeholder="{{ __('messages.events.placeholder_title') }}" required value="{{ old('title') }}">
                @error('title') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="event_date">{{ __('messages.events.date') }}</label>
                <input type="date" name="event_date" id="event_date" class="form-input" required value="{{ old('event_date') }}">
                @error('event_date') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="description">{{ __('messages.workouts.description') }}</label>
                <textarea name="description" id="description" class="form-input" placeholder="{{ __('messages.events.placeholder_description') }}" required>{{ old('description') }}</textarea>
                @error('description') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div style="display: flex; gap: 12px; margin-top: 2rem;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> {{ __('messages.common.save') }}
                </button>
                <a href="{{ route('gym-news.index') }}" class="btn btn-secondary">
                    {{ __('messages.common.back') }}
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
