@extends('layouts.app')

@section('title', __('messages.log.title') . ' — GymHub')

@section('content')
<style>
    /* Integrate with existing CSS variables from layouts.app */
    :root {
        --gym-header: linear-gradient(90deg, #1c1c1c, #39FF14);
        --gym-sidebar: linear-gradient(to bottom, rgba(57, 255, 20, 0.05), rgba(10, 10, 10, 0.02));
    }

    .explorer-wrapper {
        display: flex;
        justify-content: center; 
        padding: 10px 0;
    }

    /* Studio Architecture with Gym Styling */
    .gym-window {
        width: 100%;
        max-width: 100%;
        background: #0a0a0a;
        border: 2px solid var(--primary);
        border-radius: 12px;
        box-shadow: 0 0 50px rgba(57, 255, 20, 0.1);
        overflow: hidden;
        animation: fadeInScale 0.4s ease-out;
    }

    @keyframes fadeInScale {
        from { transform: scale(0.96); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }

    /* Title Bar */
    .gym-title-bar { 
        background: var(--gym-header);
        padding: 10px 18px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        color: white;
    }
 
    .gym-title {
        display: flex;
        align-items: center;
        gap: 12px;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        font-size: 0.9rem;
        color: black;
    }

    .gym-window-controls {
        display: flex;
        gap: 8px;
    }

    .win-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        cursor: pointer;
        opacity: 1;
    }
    .dot-red { background: #ff5f56; }
    .dot-yellow { background: #ffbd2e; }
    .dot-green { background: #27c93f; }

    /* Explorer Content */
    .explorer-grid {
        display: grid;
        grid-template-columns: 260px 1fr;
        min-height: 600px;
    }

    /* Sidebar - Gym Styled */
    .gym-sidebar {
        background: var(--gym-sidebar);
        border-right: 1px solid var(--border);
        padding: 24px;
    }

    .nav-panel {
        background: rgba(57, 255, 20, 0.02);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 18px;
        margin-bottom: 24px;
        backdrop-filter: blur(10px);
    }

    .panel-title {
        color: var(--primary);
        font-weight: 800;
        font-size: 0.75rem;
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .panel-link {
        display: flex;
        align-items: center;
        gap: 12px;
        color: var(--text-secondary);
        text-decoration: none;
        font-size: 0.85rem;
        padding: 8px 0;
        transition: 0.3s;
    }
    .panel-link:hover { color: var(--primary); transform: translateX(5px); }
    .panel-link i { color: var(--primary); width: 16px; }

    /* Main Area */
    .explorer-main {
        padding: 30px;
        background: rgba(10, 10, 10, 0.6);
    }

    /* Upload Box - Neon Gym Style */
    .upload-vault {
        background: linear-gradient(135deg, rgba(57, 255, 20, 0.05) 0%, rgba(34, 197, 94, 0.02) 100%);
        border: 2px dashed var(--primary);
        border-radius: 20px;
        padding: 50px;
        text-align: center;
        margin-bottom: 40px;
        transition: 0.3s;
        position: relative;
        overflow: hidden;
    }
    .upload-vault:hover {
        border-color: #2ee60f;
        background: rgba(57, 255, 20, 0.1);
        transform: translateY(-2px);
    }

    .vault-icon {
        font-size: 4rem;
        color: var(--primary);
        margin-bottom: 20px;
        filter: drop-shadow(0 0 15px rgba(57, 255, 20, 0.4));
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% { transform: scale(1); opacity: 0.8; }
        50% { transform: scale(1.05); opacity: 1; }
        100% { transform: scale(1); opacity: 0.8; }
    }

    /* Custom File Input */
    .gym-file-input {
        background: #141414;
        border: 1px solid var(--border);
        color: white;
        padding: 14px;
        border-radius: 10px;
        width: 100%;
        max-width: 450px;
        margin: 25px auto;
        display: block;
        cursor: pointer;
    }

    /* File Grid */
    .files-layout {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 30px;
        margin-top: 30px;
    }

    .gym-file-card {
        text-align: center;
        padding: 20px;
        border-radius: 16px;
        background: #141414;
        border: 1px solid var(--border);
        transition: 0.3s;
        cursor: pointer;
        position: relative;
    }

    .gym-file-card:hover {
        background: rgba(57, 255, 20, 0.05);
        border-color: var(--primary);
        transform: translateY(-8px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.5);
    }

    .file-icon-wrapper {
        width: 100px;
        height: 100px;
        margin: 0 auto 15px;
        background: linear-gradient(135deg, #1c1c1c, #0a0a0a);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid var(--border);
        transition: 0.3s;
    }
    .gym-file-card:hover .file-icon-wrapper {
        border-color: var(--primary);
        transform: rotate(15deg);
    }

    .gym-icon {
        font-size: 3rem;
        color: var(--primary);
        filter: drop-shadow(0 0 10px rgba(57, 255, 20, 0.3));
    }

    .file-name {
        font-size: 0.85rem;
        color: #f1f5f9;
        font-weight: 600;
        word-break: break-all;
        margin-top: 10px;
        display: block;
    }

    .file-actions {
        position: absolute;
        bottom: 10px;
        right: 10px;
        opacity: 0;
        transition: 0.3s;
    }
    .gym-file-card:hover .file-actions { opacity: 1; }

    .stat-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
    gap: 15px;
    }

    .dashboard-banner-title {
    font-size: clamp(1.6rem, 4vw, 2.5rem);
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .explorer-grid { grid-template-columns: 1fr; }
        .gym-sidebar { position: fixed; bottom: 0; left: 0; right: 0; display: flex; flex-direction: row; justify-content: space-around; padding: 8px; border-top: 1px solid var(--border);}
        .explorer-main { padding: 20px; }
        .upload-vault { padding: 30px 20px; }
        .nav-panel { display: none; }
        .mobile-nav { display: flex; width: 100%; justify-content: space-around; }
    }

    @media (max-width: 768px) {
        .gym-window { border-width: 1px; border-radius: 0; }
        .explorer-wrapper { padding: 0; }
        .vault-icon { font-size: 3rem; }
        .gym-file-input { width: 100%; }
        .files-layout { grid-template-columns: repeat(auto-fill, minmax(130px, 1fr)); gap: 15px; }
        .file-icon-wrapper { width: 80px; height: 80px; }
        .gym-icon { font-size: 2rem; }
    }

    @media (max-width: 480px) {
        .gym-title-bar { padding: 8px 12px; }
        .gym-title { font-size: 0.8rem; }
        .win-dot { width: 10px; height: 10px; }
        .status-bar-desktop { display: none; }
    }   
    
    @media (max-width: 992px) {
        .dashboard-content-grid { grid-template-columns: 1fr; }
    }
    
    @media (max-width: 576px) {
        .upload-vault { padding: 20px 15px; }
    }

</style>

<div class="explorer-wrapper">
    <div class="gym-window">
        <!-- Gym Header -->
        <div class="gym-title-bar">
            <div class="gym-title">
                <i class="fas fa-dumbbell"></i>
                <span>{{ __('messages.log.vault_title') }}</span>
            </div>
            <div class="gym-window-controls">
                <div class="win-dot dot-red"></div>
                <div class="win-dot dot-yellow"></div>
                <div class="win-dot dot-green"></div>
            </div>
        </div>

        <!-- Layout Grid -->
        <div class="explorer-grid">
            <!-- Sidebar -->
            <div class="gym-sidebar">
                <div class="nav-panel">
                    <div class="panel-title"><i class="fas fa-user-tie"></i> {{ __('messages.log.coach_panel') }}</div>
                    <a href="{{ route('workouts.create') }}" class="panel-link"><i class="fas fa-plus"></i> {{ __('messages.workouts.create') }}</a>
                    <a href="#" class="panel-link"><i class="fas fa-heart-pulse"></i> {{ __('messages.log.biometrics') }}</a>
                    <a href="#" class="panel-link"><i class="fas fa-sync-alt"></i> {{ __('messages.log.refresh') }}</a>
                </div>

                <div class="nav-panel">
                    <div class="panel-title"><i class="fas fa-compass"></i> {{ __('messages.log.navigation') }}</div>
                    <a href="{{ route('dashboard') }}" class="panel-link"><i class="fas fa-chart-line"></i> {{ __('messages.nav.dashboard') }}</a>
                    <a href="{{ route('gym-news.index') }}" class="panel-link"><i class="fas fa-calendar-alt"></i> {{ __('messages.nav.events') }}</a>
                    <a href="{{ route('workouts.index') }}" class="panel-link"><i class="fas fa-person-running"></i> {{ __('messages.nav.workouts') }}</a>
                </div>
            </div>

            <!-- Content Area -->
            <div class="explorer-main">
                @if (session('success'))
                    <div class="alert alert-success mt-0 mb-4">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                    </div>
                @endif

                <div class="upload-vault">
                    <div class="vault-icon"><i class="fas fa-cloud-arrow-up"></i></div>
                    <h3 style="color: white; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">{{ __('messages.log.upload_title') }}</h3>
                    <p style="color: #a3a3a3; font-size: 0.95rem;">{{ __('messages.log.upload_subtitle') }}</p>

                    <form action="{{ route('upload.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="file" class="gym-file-input">
                        @error('file')
                            <div class="text-danger mt-1 small"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                        <button type="submit" class="btn btn-primary mt-3 px-5 py-3">
                            <i class="fas fa-upload"></i> {{ __('messages.log.start_upload') }}
                        </button>
                    </form>
                </div>

                <div class="d-flex align-items-center gap-3 mb-4">
                    <i class="fas fa-folder-open text-primary" style="font-size: 1.8rem;"></i>
                    <h4 class="mb-0" style="font-weight: 800; color: #f1f5f9; text-transform: uppercase;">{{ __('messages.log.my_files') }}</h4>
                    <div style="flex-grow: 1; border-bottom: 1px solid var(--border);"></div>
                </div>

                <div class="files-layout">
                    @forelse($files as $file)
                        @php
                            $path = str_replace('uploads/gym/', '', $file);
                            $extension = pathinfo($path, PATHINFO_EXTENSION);
                            $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']);
                        @endphp
                        
                        <div class="gym-file-card">
                            <a href="{{ asset('storage/' . $file) }}" target="_blank" style="text-decoration: none;">
                                <div class="file-icon-wrapper">
                                    @if($isImage)
                                        <img src="{{ asset('storage/' . $file) }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                                    @else
                                        <i class="fas fa-file-lines gym-icon"></i>
                                    @endif
                                </div>
                                <span class="file-name">{{ Str::limit($path, 20) }}</span>
                                <span style="font-size: 0.7rem; color: var(--text-muted); text-transform: uppercase;">{{ $extension }}</span>
                            </a>
                            <div class="file-actions">
                                <a href="{{ asset('storage/' . $file) }}" download class="btn btn-sm" style="background: rgba(57, 255, 20, 0.1); color: var(--primary); padding: 5px 10px; border-radius: 8px;">
                                    <i class="fas fa-download"></i>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div style="grid-column: 1/-1; text-align: center; padding: 80px; background: #141414; border-radius: 24px; border: 1px solid var(--border);">
                            <i class="fas fa-box-open" style="font-size: 4rem; color: var(--text-muted); margin-bottom: 20px;"></i>
                            <h3 style="color: var(--text-muted);">{{ __('messages.log.no_files') }}</h3>
                            <p style="color: #404040;">{{ __('messages.log.no_files_subtitle') }}</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        
        <!-- Status Bar -->
        <div style="background: #0a0a0a; border-top: 1px solid var(--border); padding: 12px 25px; font-size: 0.8rem; color: var(--text-muted); display: flex; justify-content: space-between; align-items: center;">
            <div><i class="fas fa-database"></i> {{ __('messages.log.records_stored', ['count' => count($files)]) }}</div>
            <div class="status-bar-desktop">
                <span style="margin-right: 15px;"><i class="fas fa-circle text-success" style="font-size: 0.5rem;"></i> {{ __('messages.log.system_live') }}</span>
                <i class="fas fa-shield-alt text-primary"></i> {{ __('messages.log.ssl_protected') }}
            </div>
        </div>
    </div>
</div>
@endsection
