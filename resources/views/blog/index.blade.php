@extends('layouts.app')

@section('title', __('messages.blog.title'))

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px;">
    <div>
        <h1 style="font-size: 2.5rem; font-weight: 800; letter-spacing: -1px; margin-bottom: 10px;">{{ __('messages.blog.title') }}</h1>
        <p style="color: var(--text-dim);">{{ __('messages.blog.subtitle') }}</p>
    </div>
    @hasanyrole('admin|super-admin')
    <a href="{{ route('blog.create') }}" class="btn-premium btn-neon">
        <i class="fas fa-plus"></i> {{ __('messages.blog.create') }}
    </a>
    @endhasanyrole
</div>

@if($posts->isEmpty())
    <div class="card-premium" style="text-align: center; padding: 100px 20px;">
        <i class="fas fa-newspaper" style="font-size: 4rem; color: var(--border); margin-bottom: 20px; display: block;"></i>
        <h2 style="color: var(--text-dim);">{{ __('messages.blog.no_posts') }}</h2>
    </div>
@else
    <div class="grid-3">
        @foreach($posts as $post)
            <div class="card-premium" style="display: flex; flex-direction: column; height: 100%;">
                <div style="margin-bottom: 20px;">
                    <span style="display: inline-block; padding: 5px 12px; background: rgba(57, 255, 20, 0.1); border-radius: 8px; color: var(--primary); font-size: 0.75rem; font-weight: 800; text-transform: uppercase; margin-bottom: 15px;">
                        {{ __('messages.blog.categories.' . $post->category) }}
                    </span>
                    <h3 style="font-size: 1.4rem; font-weight: 800; line-height: 1.3; margin-bottom: 15px; color: white;">{{ $post->title }}</h3>
                    <p style="color: var(--text-dim); font-size: 0.95rem; line-height: 1.6; margin-bottom: 20px;">
                        {{ Str::limit(strip_tags($post->content), 120) }}
                    </p>
                </div>
                
                <div style="margin-top: auto; display: flex; align-items: center; justify-content: space-between; padding-top: 20px; border-top: 1px solid var(--border);">
                    <div style="font-size: 0.8rem; color: var(--text-dim);">
                        <i class="far fa-calendar-alt"></i> {{ $post->created_at->format('d.m.Y') }}
                    </div>
                    <a href="{{ route('blog.show', $post->slug) }}" style="color: var(--primary); font-weight: 700; text-decoration: none; font-size: 0.9rem; display: flex; align-items: center; gap: 5px;">
                        {{ __('messages.blog.read_more') }} <i class="fas fa-arrow-right" style="font-size: 0.8rem;"></i>
                    </a>
                </div>

                @hasanyrole('admin|super-admin')
                <div style="display: flex; gap: 10px; margin-top: 15px;">
                    <a href="{{ route('blog.edit', $post->id) }}" class="btn-premium btn-outline" style="padding: 8px 15px; font-size: 0.8rem; flex: 1; justify-content: center;">
                        <i class="fas fa-edit"></i> {{ __('messages.common.edit') }}
                    </a>
                    <form action="{{ route('blog.destroy', $post->id) }}" method="POST" style="flex: 1;" onsubmit="return confirm('{{ __('messages.common.confirm_delete') }}')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-premium btn-outline" style="padding: 8px 15px; font-size: 0.8rem; width: 100%; justify-content: center; color: #ef4444;">
                            <i class="fas fa-trash"></i> {{ __('messages.common.delete') }}
                        </button>
                    </form>
                </div>
                @endhasanyrole
            </div>
        @endforeach
    </div>
@endif
@endsection
