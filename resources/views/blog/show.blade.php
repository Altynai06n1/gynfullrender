@extends('layouts.app')

@section('title', $post->title)

@section('content')
<div style="max-width: 900px; margin: 0 auto;">
    <a href="{{ route('blog.index') }}" style="display: inline-flex; align-items: center; gap: 10px; color: var(--text-dim); text-decoration: none; font-weight: 600; margin-bottom: 30px; transition: var(--transition);" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='var(--text-dim)'">
        <i class="fas fa-arrow-left"></i> {{ __('messages.common.back') }}
    </a>

    <div class="card-premium" style="padding: 50px;">
        <span style="display: inline-block; padding: 5px 15px; background: rgba(57, 255, 20, 0.1); border-radius: 10px; color: var(--primary); font-size: 0.85rem; font-weight: 800; text-transform: uppercase; margin-bottom: 25px;">
            {{ __('messages.blog.categories.' . $post->category) }}
        </span>
        
        <h1 style="font-size: clamp(2rem, 5vw, 3.5rem); font-weight: 900; line-height: 1.1; letter-spacing: -2px; margin-bottom: 25px; color: white;">
            {{ $post->title }}
        </h1>

        <div style="display: flex; align-items: center; gap: 20px; color: var(--text-dim); font-size: 0.9rem; margin-bottom: 40px; padding-bottom: 30px; border-bottom: 1px solid var(--border);">
            <div style="display: flex; align-items: center; gap: 8px;">
                <i class="far fa-calendar-alt" style="color: var(--primary);"></i>
                {{ $post->created_at->format('d M, Y') }}
            </div>
            <div style="display: flex; align-items: center; gap: 8px;">
                <i class="far fa-clock" style="color: var(--primary);"></i>
                {{ round(str_word_count($post->content) / 200) ?: 1 }} min read
            </div>
        </div>

        <div style="font-size: 1.15rem; line-height: 1.8; color: #e0e0e0; white-space: pre-line;">
            {!! $post->content !!}
        </div>

        @hasanyrole('admin|super-admin')
        <div style="display: flex; gap: 15px; margin-top: 50px; padding-top: 30px; border-top: 1px solid var(--border);">
            <a href="{{ route('blog.edit', $post->id) }}" class="btn-premium btn-neon">
                <i class="fas fa-edit"></i> {{ __('messages.common.edit') }}
            </a>
            <form action="{{ route('blog.destroy', $post->id) }}" method="POST" onsubmit="return confirm('{{ __('messages.common.confirm_delete') }}')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-premium btn-outline" style="color: #ef4444; border-color: rgba(239, 68, 68, 0.2);">
                    <i class="fas fa-trash"></i> {{ __('messages.common.delete') }}
                </button>
            </form>
        </div>
        @endhasanyrole
    </div>
</div>
@endsection
