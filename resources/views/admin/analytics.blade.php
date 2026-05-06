@extends('layouts.app')

@section('title', __('messages.admin.analytics') . ' — GymHub')

@section('content')
<div style="margin-bottom: 2rem;">
    <h1 class="section-title">
        <i class="fas fa-chart-bar" style="color: var(--info);"></i>
        {{ __('messages.admin.analytics_title') }}
    </h1>
    <p class="section-subtitle">{{ __('messages.admin.analytics_subtitle') }}</p>
</div>

{{-- Негізгі метрикалар --}}
<div class="grid-3" style="margin-bottom: 2rem;">
    <div class="stat-card">
        <div class="stat-icon blue"><i class="fas fa-users"></i></div>
        <div>
            <div class="stat-value">{{ $usersCount }}</div>
            <div class="stat-label">{{ __('messages.admin.users') }}</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green"><i class="fas fa-dumbbell"></i></div>
        <div>
            <div class="stat-value">{{ $workoutsCount }}</div>
            <div class="stat-label">{{ __('messages.nav.workouts') }}</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon yellow"><i class="fas fa-calendar-check"></i></div>
        <div>
            <div class="stat-value">{{ $gymNewsCount }}</div>
            <div class="stat-label">{{ __('messages.nav.events') }}</div>
        </div>
    </div>
</div>

{{-- Қысқаша мәліметтер --}}
<div class="card">
    <div class="card-header"><i class="fas fa-info-circle"></i> {{ __('messages.admin.about_system') }}</div>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-top: 1rem;">
        <div style="text-align: center; padding: 1.5rem; background: rgba(16,185,129,0.05); border-radius: 12px; border: 1px solid rgba(16,185,129,0.15);">
            <div style="font-size: 2.5rem; color: var(--primary); margin-bottom: 0.5rem;">
                <i class="fas fa-dumbbell"></i>
            </div>
            <div style="font-size: 1.5rem; font-weight: 800;">{{ $workoutsCount }}</div>
            <div style="color: var(--text-muted); font-size: 0.85rem; margin-top: 0.25rem;">{{ __('messages.nav.workouts') }}</div>
        </div>
        <div style="text-align: center; padding: 1.5rem; background: rgba(59,130,246,0.05); border-radius: 12px; border: 1px solid rgba(59,130,246,0.15);">
            <div style="font-size: 2.5rem; color: var(--info); margin-bottom: 0.5rem;">
                <i class="fas fa-calendar-alt"></i>
            </div>
            <div style="font-size: 1.5rem; font-weight: 800;">{{ $gymNewsCount }}</div>
            <div style="color: var(--text-muted); font-size: 0.85rem; margin-top: 0.25rem;">{{ __('messages.nav.events') }}</div>
        </div>
        <div style="text-align: center; padding: 1.5rem; background: rgba(245,158,11,0.05); border-radius: 12px; border: 1px solid rgba(245,158,11,0.15);">
            <div style="font-size: 2.5rem; color: var(--warning); margin-bottom: 0.5rem;">
                <i class="fas fa-user-friends"></i>
            </div>
            <div style="font-size: 1.5rem; font-weight: 800;">{{ $usersCount }}</div>
            <div style="color: var(--text-muted); font-size: 0.85rem; margin-top: 0.25rem;">{{ __('messages.admin.users') }}</div>
        </div>
    </div>
</div>
@endsection

