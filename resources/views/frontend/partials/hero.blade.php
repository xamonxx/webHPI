{{--
    GOD-TIER HERO - RESPONSIF & ELEGAN
    Features: Rounded Pill Buttons, Smooth Gradients, Premium Typography
--}}

<header class="theme-keep-dark relative min-h-[100svh] flex items-center pt-20 pb-10 overflow-hidden" id="hero">
    {{-- Dynamic Background --}}
    <div class="absolute inset-0 z-0">
        @php
        $heroBg = $hero?->background_url;
        @endphp

        @if($heroBg)
        {{-- Optimized Hero Image (LCP) --}}
        <img src="{{ $heroBg }}"
             alt="{{ $hero->title ?? 'Home Putra Interior' }}"
             class="absolute inset-0 w-full h-full object-cover"
             fetchpriority="high"
             loading="eager"
             decoding="async"
             width="1920"
             height="1080">
        @else
        <div class="absolute inset-0 bg-linear-to-br from-[#111827] via-background-dark to-black"></div>
        @endif

        {{-- Gradient Overlay (Simplified) --}}
        <div class="absolute inset-0 bg-black/60 z-10"></div>
        <div class="absolute inset-0 bg-linear-to-t from-background-dark via-transparent to-black/20 z-10"></div>
    </div>

    {{-- Content --}}
    <div class="relative z-20 max-w-[1536px] mx-auto px-6 sm:px-8 lg:px-12 xl:px-[72px] w-full h-full flex flex-col justify-center">
        <div class="hero-copy flex flex-col items-start text-left gap-6 max-w-[920px]">

            {{-- Top Tagline --}}
            @if(!empty($settings['site_tagline']))
            <div class="flex items-center gap-3">
                <div class="h-px w-12 bg-primary/50 hidden md:block"></div>
                <span class="text-primary text-xs md:text-sm font-bold uppercase tracking-[0.3em] drop-shadow-lg">{{ $settings['site_tagline'] }}</span>
            </div>
            @endif

            {{-- Main Title (Customer-Centric Copy) --}}
            <h1 class="hero-title font-bold text-white drop-shadow-xl">
                {{ $hero?->title ?? $settings['site_name'] ?? 'Home Putra Interior' }}
                @if($hero?->title_highlight)
                <span class="hero-highlight">{{ $hero->title_highlight }}</span>
                @endif
            </h1>

            {{-- Description --}}
            @if(!empty($hero?->subtitle) || !empty($settings['site_description']))
            <p class="hero-subtitle text-gray-200 font-light leading-relaxed max-w-[760px] drop-shadow-md">
                {{ $hero?->subtitle ?? $settings['site_description'] }}
            </p>
            @endif

            {{-- Action Buttons (Rounded & Elegant) --}}
            <div class="hero-actions flex flex-col sm:flex-row gap-5 w-full sm:w-auto mt-6">
                @if(!empty($hero?->button1_text))
                <a href="/portfolio" class="hero-button hero-button-primary group relative bg-primary text-black text-sm font-bold uppercase tracking-wider rounded-full overflow-hidden shadow-[0_0_20px_rgba(255,178,4,0.3)] hover:shadow-[0_0_30px_rgba(255,178,4,0.6)] transition-all duration-300 w-full sm:w-auto flex items-center justify-center gap-3">
                    <span class="relative z-10">{{ $hero?->button1_text }}</span>
                    <svg class="w-5 h-5 relative z-10 group-hover:translate-x-1 transition-transform" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M5 12h14m-6-6 6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    {{-- Shine Effect --}}
                    <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
                </a>
                @endif

                @if(!empty($hero?->button2_text))
                <a href="{{ $hero?->button2_link ?: route('home').'#contact' }}" class="hero-button group bg-white/5 backdrop-blur-md border border-white/20 text-white text-sm font-medium uppercase tracking-wider rounded-full hover:bg-white hover:text-black hover:border-white transition-all duration-300 w-full sm:w-auto flex items-center justify-center gap-2">
                    {{ $hero?->button2_text }}
                </a>
                @endif
            </div>

        </div>
    </div>

    {{-- Vertical Scroll Indicator --}}
    <div class="hidden md:flex absolute right-12 bottom-12 flex-col items-center gap-4 z-20">
        <span class="text-[9px] uppercase tracking-[0.3em] text-white/50 rotate-90 origin-right translate-x-3">Gulir ke Bawah</span>
        <div class="w-px h-24 bg-linear-to-b from-white/50 to-transparent"></div>
    </div>
</header>

<style>
    .hero-copy {
        transform: translateY(1.25rem);
    }

    .hero-title {
        max-width: 1000px;
        font-size: clamp(2.5rem, 4vw, 4.25rem);
        line-height: 1.15;
        letter-spacing: -0.01em;
    }

    .hero-highlight {
        color: #ffb204;
        font-family: 'Cormorant Garamond', serif;
        font-style: italic;
        font-weight: 600;
        font-size: 1em;
        line-height: 1.1;
    }

    .hero-subtitle {
        font-size: clamp(1rem, 1.2vw, 1.25rem);
    }

    .hero-button {
        min-width: 250px;
        min-height: 60px;
        padding: 1rem 2rem;
    }

    .hero-button-primary {
        min-width: 260px;
    }

    @media (max-width: 1023px) {
        .hero-copy {
            align-items: center;
            text-align: center;
            max-width: 48rem;
            margin-inline: auto;
            transform: translateY(0);
        }

        .hero-title {
            font-size: clamp(2rem, 5vw, 3rem);
        }
    }

    @media (max-width: 639px) {
        .hero-copy {
            gap: 1.25rem;
            max-width: 100%;
            padding-inline: 0.5rem;
        }

        .hero-title {
            font-size: clamp(1.75rem, 6vw, 2.25rem);
            line-height: 1.2;
        }

        .hero-subtitle {
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .hero-actions {
            gap: 1rem;
            width: 100%;
        }

        .hero-button,
        .hero-button-primary {
            min-width: 0;
            width: 100%;
            min-height: 52px;
            padding: 0.85rem 1.25rem;
        }
    }

</style>
