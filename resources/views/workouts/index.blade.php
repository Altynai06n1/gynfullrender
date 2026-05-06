@extends('layouts.app')

@section('title', __('messages.workouts.title'))

@section('content')
<div class="section-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px; gap: 20px;">
    <div>
        <h1 class="section-title">
            <i class="fas fa-person-running" style="color: var(--primary);"></i>
            {{ __('messages.workouts.title') }}
        </h1>
        <p style="color: var(--text-dim);">{{ __('messages.workouts.subtitle' ?? 'All available workout types and programs') }}</p>
    </div>
    
    @can('create workouts')
    <a href="{{ route('workouts.create') }}" class="btn-premium btn-neon">
        <i class="fas fa-plus"></i> {{ __('messages.workouts.create') }}
    </a>
    @endcan
</div>

<div class="grid-3">
    @forelse($projects as $project)
    <div class="card-premium">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 20px;">
            <div style="width: 50px; height: 50px; border-radius: 12px; background: rgba(57, 255, 20, 0.1); display: flex; align-items: center; justify-content: center; color: var(--primary);">
                <i class="fas fa-dumbbell" style="font-size: 1.5rem;"></i>
            </div>
            <span style="font-size: 0.7rem; color: var(--primary); font-weight: 800; border: 1px solid var(--primary); padding: 4px 10px; border-radius: 50px; text-transform: uppercase;">{{ __('messages.common.active' ?? 'Active') }}</span>
        </div>

        <h3 style="font-size: 1.2rem; font-weight: 800; margin-bottom: 12px;">{{ $project->title }}</h3>
        <p style="color: var(--text-dim); font-size: 0.9rem; line-height: 1.6; margin-bottom: 25px;">
            {{ \Illuminate\Support\Str::limit($project->description, 100) }}
        </p>

        <div style="display: flex; gap: 10px; border-top: 1px solid var(--border); padding-top: 20px;">
            @can('edit workouts')
            <a href="{{ route('workouts.edit', $project->id) }}" class="btn-premium btn-outline" style="padding: 10px 15px;">
                <i class="fas fa-edit"></i>
            </a>
            @endcan
            
            @can('delete workouts')
            <form action="{{ route('workouts.destroy', $project->id) }}" method="POST" style="display:inline;">
                @csrf @method('DELETE')
                <button class="btn-premium btn-outline" style="padding: 10px 15px; color: #ef4444; border-color: rgba(239, 68, 68, 0.2);" onclick="return confirm('{{ __('messages.common.confirm_delete' ?? 'Are you sure?') }}')">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
            @endcan
        </div>
    </div>
    @empty
    <div class="card-premium" style="grid-column: 1 / -1; text-align: center; padding: 60px;">
        <i class="fas fa-folder-open" style="font-size: 3rem; color: var(--border); margin-bottom: 20px;"></i>
        <p style="color: var(--text-dim);">{{ __('messages.workouts.no_workouts') }}</p>
    </div>
    @endforelse
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
