@extends('layouts.app')

@section('title', __('messages.admin.title') . ' — GymHub')

@section('content')
<div style="margin-bottom: 2rem;">
    <h1 class="section-title">
        <i class="fas fa-shield-alt" style="color: var(--warning);"></i>
        {{ __('messages.admin.title') }}
    </h1>
    <p class="section-subtitle">{{ __('messages.admin.subtitle') }}</p>
</div>

{{-- Хабарламалар --}}
@if(session('success'))
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger">
        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
    </div>
@endif

{{-- Статистика --}}
<div class="grid-3" style="margin-bottom: 2rem;">
    <div class="stat-card">
        <div class="stat-icon blue"><i class="fas fa-users"></i></div>
        <div>
            <div class="stat-value">{{ $users->count() }}</div>
            <div class="stat-label">{{ __('messages.dashboard.stats.users') }}</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon yellow"><i class="fas fa-user-tag"></i></div>
        <div>
            <div class="stat-value">{{ $roles->count() }}</div>
            <div class="stat-label">{{ __('messages.admin.roles') }}</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green"><i class="fas fa-key"></i></div>
        <div>
            <div class="stat-value">{{ $permissions->count() }}</div>
            <div class="stat-label">{{ __('messages.admin.permissions') }}</div>
        </div>
    </div>
</div>

{{-- Пайдаланушылар кестесі --}}
<div class="card" style="margin-bottom: 2rem;">
    <div class="card-header">
        <i class="fas fa-users"></i> {{ __('messages.admin.users_list') }}
    </div>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('messages.auth.name') }}</th>
                    <th>{{ __('messages.auth.email') }}</th>
                    <th>{{ __('messages.admin.role') }}</th>
                    @can('manage users')
                    <th>{{ __('messages.admin.change_role') }}</th>
                    <th>{{ __('messages.common.actions') }}</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td style="color: var(--text-muted);">{{ $user->id }}</td>
                    <td>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <div class="nav-avatar" style="width:34px; height:34px; font-size:0.85rem; flex-shrink:0;">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <span style="font-weight: 600;">{{ $user->name }}</span>
                            @if($user->id === auth()->id())
                                <span class="badge badge-green" style="font-size:0.65rem;">{{ __('messages.admin.you') }}</span>
                            @endif
                        </div>
                    </td>
                    <td style="color: var(--text-secondary);">{{ $user->email }}</td>
                    <td>
                        @foreach($user->roles as $role)
                            @php
                                $badgeClass = match($role->name) {
                                    'super-admin' => 'badge-red',
                                    'admin'       => 'badge-yellow',
                                    'moderator'   => 'badge-blue',
                                    default       => 'badge-green',
                                };
                            @endphp
                            <span class="badge {{ $badgeClass }}">{{ __('messages.roles.' . $role->name) }}</span>
                        @endforeach
                        @if($user->roles->isEmpty())
                            <span class="badge badge-green">{{ __('messages.roles.user') }}</span>
                        @endif
                    </td>
                    @can('manage users')
                    <td>
                        @if($user->id !== auth()->id())
                        <form action="{{ route('admin.users.role', $user->id) }}" method="POST" style="display: flex; gap: 6px; align-items: center;">
                            @csrf
                            @method('PATCH')
                            <select name="role" class="form-input" style="padding: 6px 10px; height: auto; font-size: 0.82rem;">
                                @foreach($roles as $role)
                                    <option value="{{ $role->name }}"
                                        {{ $user->roles->first()?->name === $role->name ? 'selected' : '' }}>
                                        {{ __('messages.roles.' . $role->name) }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-secondary btn-sm" title="{{ __('messages.common.save') }}">
                                <i class="fas fa-check"></i>
                            </button>
                        </form>
                        @else
                            <span style="color: var(--text-muted); font-size: 0.8rem;">—</span>
                        @endif
                    </td>
                    <td>
                        @if($user->id !== auth()->id())
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                              onsubmit="return confirm('{{ __('messages.admin.delete_user_confirm', ['name' => $user->name]) }}')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i> {{ __('messages.common.delete') }}
                            </button>
                        </form>
                        @else
                            <span style="color: var(--text-muted); font-size: 0.8rem;">—</span>
                        @endif
                    </td>
                    @endcan
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; color: var(--text-muted); padding: 2rem;">
                        {{ __('messages.admin.no_users') }}
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Рольдер мен рұқсаттар --}}
<div class="grid-2">
    <div class="card">
        <div class="card-header"><i class="fas fa-user-tag"></i> {{ __('messages.admin.roles') }}</div>
        @foreach($roles as $role)
        <div style="margin-bottom: 1rem; padding: 0.75rem; background: rgba(16,185,129,0.05); border-radius: 10px; border: 1px solid var(--border);">
            <div style="font-weight: 600; margin-bottom: 0.5rem; display: flex; justify-content: space-between; align-items: center;">
                <span><i class="fas fa-crown" style="color: var(--warning);"></i> {{ __('messages.roles.' . $role->name) }}</span>
                <span class="badge badge-blue">{{ $role->permissions->count() }} {{ __('messages.admin.permissions') }}</span>
            </div>
            <div style="display: flex; flex-wrap: wrap; gap: 4px; margin-top: 0.5rem;">
                @foreach($role->permissions as $perm)
                    <span class="badge badge-green" style="font-size: 0.65rem;">{{ $perm->name }}</span>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>

    <div class="card">
        <div class="card-header"><i class="fas fa-key"></i> {{ __('messages.admin.all_permissions') }}</div>
        <div class="permission-grid">
            @foreach($permissions as $perm)
                <div class="permission-item">
                    <i class="fas fa-check-circle"></i> {{ $perm->name }}
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

