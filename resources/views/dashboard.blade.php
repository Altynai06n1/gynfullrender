@extends('layouts.app')

@section('title', __('messages.dashboard.title'))

@section('content')
<!-- WELCOME BANNER -->
<div class="card-premium" style="background: linear-gradient(135deg, #161616 0%, #050505 100%); border-color: var(--primary); overflow: hidden; position: relative; margin-bottom: 40px;">
    <div style="position: relative; z-index: 2;">
        <h1 class="dashboard-banner-title" style="font-size: 2.5rem; font-weight: 900; margin-bottom: 10px;">{{ __('messages.dashboard.welcome', ['name' => explode(' ', $user->name)[0]]) }} 🔥</h1>
        <p class="dashboard-banner-subtitle" style="color: var(--text-dim); font-size: 1.1rem; max-width: 600px;">{{ __('messages.dashboard.subtitle' ?? 'Today is a great day to reach new heights. Check your workout plan and track your progress.') }}</p>
        
        <div class="dashboard-banner-btns" style="display: flex; gap: 15px; margin-top: 30px;">
            <a href="{{ route('workouts.create') }}" class="btn-premium btn-neon">
                <i class="fas fa-plus"></i> {{ __('messages.workouts.create') }}
            </a>
            <a href="{{ route('upload.index') }}" class="btn-premium btn-outline">
                <i class="fas fa-camera"></i> {{ __('messages.nav.log') }}
            </a>
        </div>

    </div>
    
    <!-- Abstract Background Shape -->
    <div style="position: absolute; right: -50px; top: -50px; width: 300px; height: 300px; background: var(--primary); filter: blur(150px); opacity: 0.1; pointer-events: none;"></div>
</div>

<!-- STATS GRID -->
<div class="stat-grid">
    <div class="stat-box">
        <div class="stat-icon-wrap"><i class="fas fa-fire"></i></div>
        <div class="stat-info">
            <h4>{{ __('messages.nav.workouts') }}</h4>
            <div class="value">{{ $workoutsCount }}</div>
        </div>
    </div>
    <div class="stat-box">
        <div class="stat-icon-wrap" style="color: #3b82f6; background: rgba(59, 130, 246, 0.1);"><i class="fas fa-trophy"></i></div>
        <div class="stat-info">
            <h4>{{ __('messages.nav.events') }}</h4>
            <div class="value">{{ $gymNewsCount }}</div>
        </div>
    </div>
    <div class="stat-box">
        <div class="stat-icon-wrap" style="color: #f59e0b; background: rgba(245, 158, 11, 0.1);"><i class="fas fa-users"></i></div>
        <div class="stat-info">
            <h4>{{ __('messages.admin.role') }}</h4>
            <div class="value" style="font-size: 1.2rem; text-transform: uppercase; color: var(--primary);">{{ $user->getRoleNames()->first() }}</div>
        </div>
    </div>
    <div class="stat-box">
        <div class="stat-icon-wrap" style="color: #ef4444; background: rgba(239, 68, 68, 0.1);"><i class="fas fa-bolt"></i></div>
        <div class="stat-info">
            <h4>{{ __('messages.dashboard.stats.status' ?? 'Activity') }}</h4>
            <div class="value">Elite</div>
        </div>
    </div>
</div>

<div class="dashboard-content-grid" style="display: grid; grid-template-columns: 1.6fr 1fr; gap: 30px;">
    <!-- LEFT COLUMN: RECENT WORKOUTS -->
    <div class="card-premium">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
            <h3 style="font-weight: 800; font-size: 1.3rem;"><i class="fas fa-clock-rotate-left" style="color: var(--primary); margin-right: 10px;"></i> {{ __('messages.dashboard.recent_activity' ?? 'Recent Activity') }}</h3>
            <a href="{{ route('workouts.index') }}" style="color: var(--primary); text-decoration: none; font-size: 0.9rem; font-weight: 600;">{{ __('messages.common.view_all' ?? 'View All') }}</a>
        </div>
        
        <div style="display: flex; flex-direction: column; gap: 15px;">
            @forelse(\App\Models\Workout::latest()->take(4)->get() as $workout)
            <div style="display: flex; align-items: center; gap: 20px; padding: 20px; background: var(--bg-surface); border: 1px solid var(--border); border-radius: 18px;">
                <div style="width: 50px; height: 50px; border-radius: 12px; background: rgba(255,255,255,0.03); display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-person-running" style="color: var(--text-dim);"></i>
                </div>
                <div style="flex: 1;">
                    <h5 style="font-size: 1rem; font-weight: 700; margin-bottom: 3px;">{{ $workout->title }}</h5>
                    <p style="color: var(--text-dim); font-size: 0.85rem;">{{ \Illuminate\Support\Str::limit($workout->description, 60) }}</p>
                </div>
                <div style="text-align: right;">
                    <div style="font-size: 0.8rem; color: var(--primary); font-weight: 700;">ACTIVE</div>
                    <div style="font-size: 0.75rem; color: var(--text-dim);">{{ $workout->created_at->format('H:i') }}</div>
                </div>
            </div>
            @empty
            <div style="text-align: center; padding: 40px; color: var(--text-dim);">
                <i class="fas fa-dumbbell" style="font-size: 2rem; margin-bottom: 10px; opacity: 0.2;"></i>
                <p>{{ __('messages.workouts.no_workouts') }}</p>
            </div>
            @endforelse
        </div>
    </div>

    <!-- RIGHT COLUMN: UPCOMING EVENTS -->
    <div class="card-premium" style="background: rgba(57, 255, 20, 0.02); border-color: rgba(57, 255, 20, 0.1);">
        <h3 style="font-weight: 800; font-size: 1.3rem; margin-bottom: 25px;"><i class="fas fa-calendar-star" style="color: #f59e0b; margin-right: 10px;"></i> {{ __('messages.events.title') }}</h3>
        
        <div style="display: flex; flex-direction: column; gap: 20px;">
            @forelse(\App\Models\GymNews::orderBy('event_date', 'asc')->take(3)->get() as $event)
            <div style="position: relative; padding-left: 20px; border-left: 2px solid var(--primary);">
                <div style="font-size: 0.75rem; color: var(--primary); font-weight: 800; margin-bottom: 5px; text-transform: uppercase;">{{ $event->event_date->format('d M, Y') }}</div>
                <h5 style="font-size: 0.95rem; font-weight: 700; margin-bottom: 5px;">{{ $event->title }}</h5>
                <p style="color: var(--text-dim); font-size: 0.8rem;">{{ \Illuminate\Support\Str::limit($event->description, 50) }}</p>
            </div>
            @empty 
            <p style="color: var(--text-dim); font-size: 0.9rem; text-align: center;">{{ __('messages.events.no_events') }}</p>
            @endforelse
            
            <a href="{{ route('gym-news.index') }}" class="btn-premium btn-outline" style="width: 100%; justify-content: center; margin-top: 20px;">
                {{ __('messages.common.view_all' ?? 'View All') }}
            </a>
        </div>
    </div>
    </div>
</div>

<style>
    @media (max-width: 1024px) {
        .dashboard-content-grid {
            grid-template-columns: 1fr !important;
        }
    }

    @media (max-width: 768px) {
        .dashboard-banner-title {
            font-size: 1.8rem !important;
        }
        
        .dashboard-banner-subtitle {
            font-size: 0.95rem !important;
        }

        .dashboard-banner-btns {
            flex-direction: column;
        }

        .dashboard-banner-btns .btn-premium {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endsection
