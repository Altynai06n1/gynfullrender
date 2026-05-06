@extends('layouts.app')

@section('title', __('messages.events.edit') . ' — GymHub')

@section('content')
<div style="max-width: 800px; margin: 0 auto;">
    <div style="margin-bottom: 2rem;">
        <h1 class="section-title"><i class="fas fa-edit" style="color: var(--info);"></i> {{ __('messages.events.edit') }}</h1>
        <p class="section-subtitle">{{ __('messages.events.subtitle') }}</p>
    </div>

    <div class="card">
        <form action="{{ route('gym-news.update', $event->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label class="form-label" for="title">{{ __('messages.events.name') }}</label>
                <input type="text" name="title" id="title" class="form-input" required value="{{ old('title', $event->title) }}">
                @error('title') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="event_date">{{ __('messages.events.date') }}</label>
                <input type="date" name="event_date" id="event_date" class="form-input" required value="{{ old('event_date', $event->event_date->format('Y-m-d')) }}">
                @error('event_date') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="description">{{ __('messages.workouts.description') }}</label>
                <textarea name="description" id="description" class="form-input" required>{{ old('description', $event->description) }}</textarea>
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
