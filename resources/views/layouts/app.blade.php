<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'GymHub — ' . __('messages.welcome.tagline'))</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #39FF14;
            --primary-glow: rgba(57, 255, 20, 0.4);
            --bg-deep: #050505;
            --bg-surface: #0f0f0f;
            --bg-card: #161616;
            --border: #222222;
            --text-main: #ffffff;
            --text-dim: #a0a0a0;
            --sidebar-width: 280px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        html {
            font-size: 16px; /* Base size for rem */
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--bg-deep);
            color: var(--text-main);
            overflow-x: hidden;
            display: flex;
            min-height: 100vh;
        }

        img {
            max-width: 100%;
            height: auto;
            display: block;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            width: var(--sidebar-width);
            background: var(--bg-surface);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            z-index: 1000;
            transition: var(--transition);
        }

        .sidebar-logo {
            padding: 40px 30px;
            display: flex;
            align-items: center;
            gap: 15px;
            text-decoration: none;
        }

        .sidebar-logo i {
            font-size: 2rem;
            color: var(--primary);
            filter: drop-shadow(0 0 10px var(--primary-glow));
        }

        .sidebar-logo span {
            font-size: 1.6rem;
            font-weight: 900;
            color: white;
            letter-spacing: -1px;
            text-transform: uppercase;
        }

        .sidebar-nav {
            flex: 1;
            padding: 0 15px;
            list-style: none;
        }

        .nav-item {
            margin-bottom: 8px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 14px 20px;
            color: var(--text-dim);
            text-decoration: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: var(--transition);
        }

        .nav-link i {
            font-size: 1.2rem;
            width: 24px;
            text-align: center;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--primary);
            background: rgba(57, 255, 20, 0.05);
        }

        .nav-link.active {
            background: rgba(57, 255, 20, 0.1);
            box-shadow: inset 4px 0 0 var(--primary);
        }

        .sidebar-footer {
            padding: 30px;
            border-top: 1px solid var(--border);
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            background: var(--bg-card);
            padding: 12px;
            border-radius: 15px;
            border: 1px solid var(--border);
        }

        .avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary), #2ee60f);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: black;
            font-weight: 800;
        }

        .user-info {
            flex: 1;
            overflow: hidden;
        }

        .user-name {
            font-size: 0.85rem;
            font-weight: 700;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-role {
            font-size: 0.7rem;
            color: var(--primary);
            text-transform: uppercase;
            font-weight: 800;
        }

        /* ===== MAIN AREA ===== */
        .main-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
            width: 100%; /* Explicitly fluid width */
            margin-left: 0; /* Default for guests */
        }

        body.is-auth .main-wrapper {
            margin-left: var(--sidebar-width);
        }
        
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            z-index: 950;
            
            opacity: 0;
            pointer-events: none;
            
            transition: var(--transition);
        }
        .sidebar-overlay.active {
            opacity: 1;
            pointer-events: all;
        }

        .menu-toggle {
            display: none;
            background: var(--bg-card);
            border: 1px solid var(--border);
            color: white;
            width: 45px;
            height: 45px;
            border-radius: 12px;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 1.2rem;
            transition: var(--transition);
        }

        .menu-toggle:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        .top-bar {
            height: 90px;
            padding: 0 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(5, 5, 5, 0.8);
            backdrop-filter: blur(20px);
            position: sticky;
            top: 0;
            z-index: 900;
        }

        .page-title {
            font-size: 3vw; /* Viewport Width (vw) based sizing for demonstration */
            font-weight: 800;
            letter-spacing: -0.5px;
        }

        @media (min-width: 1200px) {
            .page-title { font-size: 1.5rem; } /* Cap size on very large screens */
        }

        .content-area {
                max-width: 1400px;
                margin: 0 auto;
                width: 100%;
                padding: 5%;
                animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ===== PREMIUM COMPONENTS ===== */
        .card-premium {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 30px;
            transition: var(--transition);
        }

        .card-premium:hover {
            border-color: var(--primary);
            box-shadow: 0 20px 40px rgba(0,0,0,0.4);
        }

        .stat-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }

        .stat-box {
            background: linear-gradient(145deg, #161616, #0f0f0f);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 25px;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .stat-icon-wrap {
            width: 60px;
            height: 60px;
            border-radius: 18px;
            background: rgba(57, 255, 20, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 1.5rem;
        }

        .stat-info h4 {
            font-size: 0.85rem;
            color: var(--text-dim);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }

        .stat-info .value {
            font-size: 1.8rem;
            font-weight: 800;
        }

        /* ===== GRID SYSTEM ===== */
        .grid-3 {
            display: grid;
            grid-template-columns: 33.33% 33.33% 33.33%;
            gap: 25px;
        }

        .grid-2 {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
        }

        @media (max-width: 1024px) {
            .grid-3 { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 768px) {
            .grid-3, .grid-2 { grid-template-columns: 1fr; }
        }

        .btn-premium {
            padding: 12px 25px;
            border-radius: 15px;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: var(--transition);
            cursor: pointer;
            border: none;
        }

        .btn-neon {
            background: var(--primary);
            color: black;
            box-shadow: 0 10px 20px var(--primary-glow);
        }

        .btn-neon:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px var(--primary-glow);
        }

        .btn-outline {
            background: transparent;
            border: 1px solid var(--border);
            color: white;
        }

        .btn-outline:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        /* ===== FORM STYLES ===== */
        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
        }

        .form-input {
            width: 100%;
            background: var(--bg-surface);
            border: 1px solid var(--border);
            padding: 16px 20px;
            border-radius: 15px;
            color: white;
            font-family: inherit;
            font-size: 1rem;
            transition: var(--transition);
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            background: var(--bg-card);
            box-shadow: 0 0 0 4px var(--primary-glow);
        }

        .form-error {
            color: #ef4444;
            font-size: 0.8rem;
            margin-top: 8px;
            font-weight: 600;
        }

        /* ===== CUSTOM SCROLLBAR ===== */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: var(--bg-deep); }
        ::-webkit-scrollbar-thumb { background: var(--border); border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--primary); }

        /* ===== LANGUAGE SWITCHER ===== */
        .lang-switcher {
            display: flex;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 4px;
            gap: 4px;
        }

        .lang-link {
            padding: 8px 12px;
            border-radius: 8px;
            text-decoration: none;
            color: var(--text-dim);
            font-size: 0.8rem;
            font-weight: 700;
            transition: var(--transition);
            text-transform: uppercase;
        }

        .lang-link:hover {
            color: white;
            background: rgba(255, 255, 255, 0.05);
        }

        .lang-link.active {
            background: var(--primary);
            color: black;
            box-shadow: 0 4px 10px var(--primary-glow);
        }

        /* ===== RESPONSIVE BREAKPOINTS ===== */

        /* Desktop (≥1025px) - Default styles already handle this */

        /* Tablet (769px–1024px) */
        @media (max-width: 1024px) {
            :root {
                --sidebar-width: 260px;
            }
            
            .sidebar { 
                max-width: 100%;
                transform: translateX(-100%); 
            }
            
            .sidebar.active {
                transform: translateX(0);
            }

            .main-wrapper { 
                margin-left: 0 !important; 
            }

            .menu-toggle {
                display: flex;
            }

            .top-bar {
                padding: 0 20px;
                height: 70px;
            }

            .content-area {
                padding: 20px;
            }

            .page-title {
                font-size: 1.2rem;
            }
        }

        /* Mobile (≤768px) */
        @media (max-width: 768px) {
            html {
                font-size: 14px;
            }

            .top-bar {
                padding: 0 15px;
            }

            .lang-switcher {
                display: none; /* Hide in top bar, maybe move to sidebar */
            }

            .stat-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .stat-box {
                padding: 20px;
            }

            .btn-premium {
                width: 100%;
                justify-content: center;
            }

            .card-premium {
                padding: 20px;
                border-radius: 20px;
            }
        }

        /* Extra Small (≤480px) */
        @media {
            .top-bar {
                gap: 10px;
            }
        }

    </style>
</head>
<body class="@auth is-auth @endauth">

    @auth
    <!-- SIDEBAR OVERLAY -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- SIDEBAR -->
    <div class="sidebar" id="sidebar">
        <a href="{{ route('dashboard') }}" class="sidebar-logo">
            <i class="fas fa-bolt"></i>
            <span>GymHub</span>
        </a>

        <ul class="sidebar-nav">
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-grid-2"></i> {{ __('messages.nav.dashboard') }}
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('workouts.index') }}" class="nav-link {{ request()->routeIs('workouts.*') ? 'active' : '' }}">
                    <i class="fas fa-person-running"></i> {{ __('messages.nav.workouts') }}
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('gym-news.index') }}" class="nav-link {{ request()->routeIs('gym-news.*') ? 'active' : '' }}">
                    <i class="fas fa-calendar-day"></i> {{ __('messages.nav.events') }}
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('upload.index') }}" class="nav-link {{ request()->routeIs('upload.index') ? 'active' : '' }}">
                    <i class="fas fa-cloud-arrow-up"></i> {{ __('messages.nav.log') }}
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('blog.index') }}" class="nav-link {{ request()->is('blog*') ? 'active' : '' }}">
                    <i class="fas fa-newspaper"></i> {{ __('messages.nav.blog') }}
                </a>
            </li>

            @hasanyrole('admin|super-admin')
            <li class="nav-item">
                <a href="{{ route('admin.panel') }}" class="nav-link {{ request()->routeIs('admin.*') ? 'active' : '' }}">
                    <i class="fas fa-shield-halved"></i> {{ __('messages.nav.admin') }}
                </a>
            </li>
            @endhasanyrole
            
            <!-- Mobile Language Switcher -->
            <li class="nav-item" style="margin-top: 20px; display: none;" id="mobileLangSwitcher">
                <div class="lang-switcher" style="display: flex; justify-content: center; width: 100%;">
                    <a href="{{ route('locale.set', 'kk') }}" class="lang-link {{ App::getLocale() == 'kk' ? 'active' : '' }}">KZ</a>
                    <a href="{{ route('locale.set', 'ru') }}" class="lang-link {{ App::getLocale() == 'ru' ? 'active' : '' }}">RU</a>
                    <a href="{{ route('locale.set', 'en') }}" class="lang-link {{ App::getLocale() == 'en' ? 'active' : '' }}">EN</a>
                    <a href="{{ route('locale.set', 'ko') }}" class="lang-link {{ App::getLocale() == 'ko' ? 'active' : '' }}">KR</a>
                </div>
            </li>
        </ul>

        <div class="sidebar-footer">
            <div class="user-profile">
                <div class="avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
                <div class="user-info">
                    <div class="user-name">{{ Auth::user()->name }}</div>
                    <div class="user-role">{{ __('messages.roles.' . (Auth::user()->getRoleNames()->first() ?? 'user')) }}</div>
                </div>
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" style="background:none; border:none; color:var(--text-dim); cursor:pointer; font-size:1.1rem;">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <style>
        @media (max-width: 768px) {
            #mobileLangSwitcher { display: block !important; }
        }
    </style>
    @endauth

    <!-- MAIN CONTENT -->
    <div class="main-wrapper">
        <div class="top-bar">
            <div style="display: flex; align-items: center; gap: 15px;">
                @auth
                <button class="menu-toggle" id="menuToggle">
                    <i class="fas fa-bars"></i>
                </button>
                @endauth
                <h2 class="page-title">@yield('title')</h2>
            </div>
            
            <div style="display: flex; gap: 20px; align-items: center;">
                <div class="lang-switcher">
                    <a href="{{ route('locale.set', 'kk') }}" class="lang-link {{ App::getLocale() == 'kk' ? 'active' : '' }}">KZ</a>
                    <a href="{{ route('locale.set', 'ru') }}" class="lang-link {{ App::getLocale() == 'ru' ? 'active' : '' }}">RU</a>
                    <a href="{{ route('locale.set', 'en') }}" class="lang-link {{ App::getLocale() == 'en' ? 'active' : '' }}">EN</a>
                    <a href="{{ route('locale.set', 'ko') }}" class="lang-link {{ App::getLocale() == 'ko' ? 'active' : '' }}">KR</a>
                </div>
                @auth
                <div style="width: 45px; height: 45px; border-radius: 12px; background: var(--bg-card); border: 1px solid var(--border); display: flex; align-items: center; justify-content: center; cursor: pointer; color: var(--text-dim);">
                    <i class="fas fa-bell"></i>
                </div>
                <div class="search-btn-desktop" style="width: 45px; height: 45px; border-radius: 12px; background: var(--bg-card); border: 1px solid var(--border); display: flex; align-items: center; justify-content: center; cursor: pointer; color: var(--text-dim);">
                    <i class="fas fa-magnifying-glass"></i>
                </div>
                @else
                <div style="display: flex; gap: 10px;">
                    <a href="{{ route('blog.index') }}" class="btn-premium btn-outline" style="padding: 8px 15px; font-size: 0.8rem;">{{ __('messages.nav.blog') }}</a>
                    <a href="{{ route('login') }}" class="btn-premium btn-outline" style="padding: 8px 15px; font-size: 0.8rem;">{{ __('messages.auth.login') }}</a>
                    <a href="{{ route('register') }}" class="btn-premium btn-neon" style="padding: 8px 15px; font-size: 0.8rem;">{{ __('messages.auth.register') }}</a>
                </div>
                @endauth

            </div>
        </div>

        <style>
            @media (max-width: 480px) {
                .search-btn-desktop { display: none; }
            }
        </style>

        <div class="content-area">
            @if(session('success'))
                <div style="background: rgba(57, 255, 20, 0.1); border-left: 4px solid var(--primary); padding: 20px; border-radius: 12px; margin-bottom: 30px; display: flex; align-items: center; gap: 15px;">
                    <i class="fas fa-check-circle" style="color: var(--primary); font-size: 1.2rem;"></i>
                    <span style="font-weight: 600;">{{ session('success') }}</span>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menuToggle');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');

            if (menuToggle && sidebar && overlay) {
                menuToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('active');
                    overlay.classList.toggle('active');
                    document.body.style.overflow = sidebar.classList.contains('active') ? 'hidden' : '';
                });

                overlay.addEventListener('click', function() {
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                    document.body.style.overflow = '';
                });
            }
        });
    </script>

</body>
</html>
