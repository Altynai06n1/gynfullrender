@extends('layouts.app')

@section('title', 'GymHub — ' . __('messages.welcome.tagline'))

@section('content')
<!-- HERO SECTION -->
<div class="hero-section" style="min-height: 85vh; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; position: relative; margin-top: -40px;">
    
    <!-- Background Glows -->
    <div style="position: absolute; width: 60vw; height: 60vw; max-width: 600px; max-height: 600px; background: var(--primary); filter: blur(180px); opacity: 0.07; top: 10%; left: 10%; pointer-events: none;"></div>
    <div style="position: absolute; width: 50vw; height: 50vw; max-width: 500px; max-height: 500px; background: #2ee60f; filter: blur(150px); opacity: 0.05; bottom: 10%; right: 10%; pointer-events: none;"></div>

    <div style="z-index: 10; max-width: 1000px; width: 90%; margin: 0 auto;">
        <span style="display: inline-block; padding: 8px 20px; background: rgba(57, 255, 20, 0.1); border: 1px solid rgba(57, 255, 20, 0.2); border-radius: 50px; color: var(--primary); font-weight: 800; font-size: 0.85rem; letter-spacing: 2px; text-transform: uppercase; margin-bottom: 30px; animation: fadeInUp 0.6s ease-out;">
            {{ __('messages.welcome.tagline') }}
        </span>
        
        <h1 style="font-size: clamp(3rem, 8vw, 6rem); font-weight: 900; line-height: 0.95; letter-spacing: -3px; margin-bottom: 30px; animation: fadeInUp 0.8s ease-out;">
            {!! __('messages.welcome.hero_title') !!}
        </h1>
        
        <p style="font-size: 1.3rem; color: var(--text-dim); max-width: 700px; margin: 0 auto 50px; line-height: 1.6; animation: fadeInUp 1s ease-out;">
            {{ __('messages.welcome.hero_subtitle') }}
        </p>

        <div class="hero-btns" style="display: flex; gap: 20px; justify-content: center; animation: fadeInUp 1.2s ease-out;">
            @auth
                <a href="{{ route('dashboard') }}" class="btn-premium btn-neon" style="padding: 20px 50px; font-size: 1.1rem; border-radius: 20px;">
                    <i class="fas fa-grid-2"></i> {{ __('messages.welcome.go_to_dashboard') }}
                </a>
            @else
                <a href="{{ route('register') }}" class="btn-premium btn-neon" style="padding: 20px 50px; font-size: 1.1rem; border-radius: 20px;">
                    <i class="fas fa-bolt"></i> {{ __('messages.welcome.get_started') }}
                </a>
                <a href="{{ route('login') }}" class="btn-premium btn-outline" style="padding: 20px 50px; font-size: 1.1rem; border-radius: 20px;">
                    <i class="fas fa-right-to-bracket"></i> {{ __('messages.auth.login') }}
                </a>
            @endauth
        </div>
    </div>
</div>

<!-- FEATURE HIGHLIGHTS -->
<div class="features-section" style="padding: 8% 0;">
    <div style="text-align: center; margin-bottom: 70px;">
        <h2 style="font-size: 2.5rem; font-weight: 800; letter-spacing: -1px;">{{ __('messages.welcome.why_gymhub') }}</h2>
        <div style="width: 60px; height: 4px; background: var(--primary); margin: 20px auto; border-radius: 2px;"></div>
    </div>

    <div class="stat-grid feature-grid">
        <div class="card-premium feature-card">
            <div style="width: 80px; height: 80px; background: rgba(57, 255, 20, 0.05); border-radius: 24px; display: flex; align-items: center; justify-content: center; margin: 0 auto 30px; color: var(--primary); font-size: 2.5rem;">
                <i class="fas fa-chart-line"></i>
            </div>
            <h3 style="font-size: 1.5rem; font-weight: 800; margin-bottom: 15px;">{{ __('messages.welcome.tracking_title') }}</h3>
            <p style="color: var(--text-dim); line-height: 1.7;">{{ __('messages.welcome.tracking_desc') }}</p>
        </div>

        <div class="card-premium feature-card" style="border-color: var(--primary);">
            <div style="width: 80px; height: 80px; background: var(--primary); border-radius: 24px; display: flex; align-items: center; justify-content: center; margin: 0 auto 30px; color: black; font-size: 2.5rem;">
                <i class="fas fa-dumbbell"></i>
            </div>
            <h3 style="font-size: 1.5rem; font-weight: 800; margin-bottom: 15px;">{{ __('messages.welcome.programs_title') }}</h3>
            <p style="color: var(--text-dim); line-height: 1.7;">{{ __('messages.welcome.programs_desc') }}</p>
        </div>

        <div class="card-premium feature-card">
            <div style="width: 80px; height: 80px; background: rgba(57, 255, 20, 0.05); border-radius: 24px; display: flex; align-items: center; justify-content: center; margin: 0 auto 30px; color: var(--primary); font-size: 2.5rem;">
                <i class="fas fa-users-viewfinder"></i>
            </div>
            <h3 style="font-size: 1.5rem; font-weight: 800; margin-bottom: 15px;">{{ __('messages.welcome.community_title') }}</h3>
            <p style="color: var(--text-dim); line-height: 1.7;">{{ __('messages.welcome.community_desc') }}</p>
        </div>
    </div>
</div>

<!-- CTA SECTION -->
<div class="cta-section card-premium" style="background: linear-gradient(135deg, var(--primary) 0%, #2ee60f 100%); color: black; padding: 5%; text-align: center; border: none; margin-bottom: 100px;">
    <h2 style="font-size: clamp(2rem, 6vw, 3.5rem); font-weight: 900; margin-bottom: 20px;">{{ __('messages.welcome.cta_title') }}</h2>
    <p style="font-size: 1.2rem; font-weight: 600; margin-bottom: 40px; opacity: 0.8;">{{ __('messages.welcome.cta_subtitle') }}</p>
    <a href="{{ route('register') }}" class="btn-premium" style="background: black; color: white; padding: 20px 60px; font-size: 1.2rem; border-radius: 20px;">
        {{ __('messages.welcome.register_free') }}
    </a>
</div>

<style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 768px) {
        .hero-section {
            padding: 60px 20px;
            min-height: auto !important;
        }
        .hero-section p {
            font-size: 1.1rem !important;
        }
        .hero-btns {
            flex-direction: column;
            width: 100%;
        }

        .hero-btns .btn-premium {
            width: 100%;
            padding: 15px 20px !important;
            font-size: 1rem !important;
        }

        .features-section {
            padding: 60px 0 !important;
        }

        .cta-section {
            padding: 40px 20px !important;
            margin-bottom: 60px !important;
        }

        .cta-section h2 {
            font-size: 2rem !important;
        }

        .feature-grid {
            grid-template-columns: 1fr !important;
            gap: 20px !important;
        }

        .feature-card {
            padding: 30px 20px !important;
        }

        .feature-card div[style*="width: 80px"] {
            width: 60px !important;
            height: 60px !important;
            font-size: 1.8rem !important;
            margin-bottom: 20px !important;
        }

        .feature-card h3 {
            font-size: 1.3rem !important;
        }
    }

    .feature-grid {
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    }

    .feature-card {
        text-align: center;
        padding: 50px 30px;
    }

    @media (max-width: 480px) {
        .hero-section h1 {
            font-size: 2.5rem !important;
        }
    }
</style>
@endsection
