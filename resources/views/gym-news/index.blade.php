@extends('layouts.app')

@section('title', __('messages.events.title') . ' — GymHub')

@section('content')
<div class="section-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; gap: 20px;">
    <div>
        <h1 class="section-title"><i class="fas fa-calendar-alt" style="color: var(--primary);"></i> {{ __('messages.events.title') }}</h1>
        <p class="section-subtitle" style="margin-bottom: 0;">{{ __('messages.events.subtitle' ?? 'Upcoming competitions and gym events') }}</p>
    </div>
    @can('create gym-news')
    <a href="{{ route('gym-news.create') }}" class="btn-premium btn-neon">
        <i class="fas fa-plus"></i> {{ __('messages.events.create') }}
    </a>
    @endcan
</div>

<div class="grid-2">
    @forelse($events as $event)
    <div class="card" style="display: flex; gap: 1.5rem; flex-direction: column;">
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <div>
                <h3 style="margin-bottom: 0.5rem; display: flex; align-items: center; gap: 8px;">
                    <i class="fas fa-calendar-day" style="color: var(--info);"></i> {{ $event->title }}
                </h3>
                <p style="color: var(--text-secondary); font-size: 0.9rem; margin-bottom: 0.5rem;">
                    {{ $event->description }}
                </p>
            </div>
            <span class="badge badge-blue">{{ $event->event_date->format('d.m.Y') }}</span>
        </div>
        
        <div style="display: flex; justify-content: flex-end; gap: 8px; border-top: 1px solid var(--border); padding-top: 1rem;">
            @can('edit gym-news')
            <a href="{{ route('gym-news.edit', $event->id) }}" class="btn btn-secondary btn-sm"><i class="fas fa-edit"></i> {{ __('messages.common.edit') }}</a>
            @endcan
            
            @can('delete gym-news')
            <form action="{{ route('gym-news.destroy', $event->id) }}" method="POST" style="display:inline;">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('{{ __('messages.common.confirm_delete' ?? 'Delete?') }}')"><i class="fas fa-trash"></i></button>
            </form>
            @endcan
        </div>
    </div>
    @empty
    <div class="card" style="grid-column: 1 / -1; text-align: center; padding: 3rem;">
        <i class="fas fa-folder-open" style="font-size: 3rem; color: var(--text-muted); margin-bottom: 1rem;"></i>
        <p style="color: var(--text-muted);">{{ __('messages.events.no_events') }}</p>
    </div>
    @endforelse
</div>
</div>

<style>
    @media (max-width: 768px) {
        .section-header {
            flex-direction: column;
            align-items: flex-start !important;
        }
        
        .section-header .btn-premium {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endsection
