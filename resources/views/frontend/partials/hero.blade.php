{{--
    GOD-TIER HERO - RESPONSIF & ELEGAN
    Features: Rounded Pill Buttons, Smooth Gradients, Premium Typography
--}}

<header class="relative min-h-screen flex items-center pt-20 pb-12 overflow-hidden" id="hero">
    {{-- Dynamic Background --}}
    <div class="absolute inset-0 z-0">
        @php
        $defaultHeroBg = 'https://images.unsplash.com/photo-1600607686527-6fb886090705?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80';
        $heroBg = $hero?->background_url ?? $defaultHeroBg;
        @endphp
        
        {{-- Optimized Hero Image (LCP) --}}
        <picture>
            <source media="(max-width: 639px)" srcset="{{ $heroBg }}&w=640&q=75&fm=webp">
            <source media="(min-width: 640px) and (max-width: 1023px)" srcset="{{ $heroBg }}&w=1024&q=80&fm=webp">
            <source media="(min-width: 1024px)" srcset="{{ $heroBg }}&w=1920&q=85&fm=webp">
            <img src="{{ $heroBg }}" 
                 alt="{{ $hero->title ?? 'Home Putra Interior Hero Image' }}" 
                 class="absolute inset-0 w-full h-full object-cover md:animate-ken-burns"
                 style="will-change: transform;"
                 fetchpriority="high"
                 decoding="async"
                 width="1920"
                 height="1080">
        </picture>

        {{-- Gradient Overlay (Simplified) --}}
        <div class="absolute inset-0 bg-black/60 z-10"></div>
        <div class="absolute inset-0 bg-linear-to-t from-background-dark via-transparent to-black/20 z-10"></div>
    </div>

    {{-- Content --}}
    <div class="relative z-20 max-w-7xl mx-auto px-6 w-full h-full flex flex-col justify-center">
        <div class="flex flex-col items-center md:items-start text-center md:text-left gap-8 max-w-3xl">

            {{-- Top Tagline --}}
            <div data-aos="fade-down" class="flex items-center gap-3">
                <div class="h-px w-12 bg-primary/50 hidden md:block"></div>
                <span class="text-primary text-xs md:text-sm font-bold uppercase tracking-[0.3em] drop-shadow-lg">#1 Jasa Interior Design</span>
            </div>

            {{-- Main Title (Customer-Centric Copy) --}}
            <h1 class="flex flex-col gap-2" data-aos="fade-up" data-aos-delay="100">
                <span class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold text-white leading-[1.1] drop-shadow-xl py-2">
                    {{ $hero->title }}
                    @if($hero->title_highlight)
                    <span class="text-gold-gradient italic font-serif">{{ $hero->title_highlight }}</span>
                    @endif
                </span>
            </h1>

            {{-- Description --}}
            <p class="text-sm sm:text-base md:text-lg text-gray-200 font-light leading-relaxed max-w-xl drop-shadow-md" data-aos="fade-up" data-aos-delay="200">
                {{ $hero?->subtitle ?? 'Kami mengubah ruangan biasa menjadi mahakarya visual yang mewah, nyaman, dan mencerminkan karakter sukses kamu.' }}
            </p>

            {{-- Action Buttons (Rounded & Elegant) --}}
            <div class="flex flex-col sm:flex-row gap-5 w-full sm:w-auto mt-6">
                @if(!empty($hero->button1_text))
                <a href="{{ $hero->button1_link ?? '#' }}" class="group relative px-8 py-4 bg-primary text-black text-sm font-bold uppercase tracking-widest rounded-full overflow-hidden shadow-[0_0_20px_rgba(255,178,4,0.3)] hover:shadow-[0_0_30px_rgba(255,178,4,0.6)] transition-all duration-300 w-full sm:w-auto flex items-center justify-center gap-3">
                    <span class="relative z-10">{{ $hero->button1_text }}</span>
                    <span class="material-symbols-outlined text-lg relative z-10 group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    {{-- Shine Effect --}}
                    <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
                </a>
                @endif

                @if(!empty($hero->button2_text))
                <a href="{{ $hero->button2_link ?? '#' }}" class="group px-8 py-4 bg-white/5 backdrop-blur-md border border-white/20 text-white text-sm font-bold uppercase tracking-widest rounded-full hover:bg-white hover:text-black hover:border-white transition-all duration-300 w-full sm:w-auto flex items-center justify-center gap-2">
                    {{ $hero->button2_text }}
                </a>
                @endif
            </div>

        </div>
    </div>

    {{-- Vertical Scroll Indicator --}}
    <div class="hidden md:flex absolute right-12 bottom-12 flex-col items-center gap-4 z-20">
        <span class="text-[9px] uppercase tracking-[0.3em] text-white/50 rotate-90 origin-right translate-x-3">Scroll Down</span>
        <div class="w-px h-24 bg-linear-to-b from-white/50 to-transparent"></div>
    </div>
</header>

<style>
    @keyframes ken-burns {
        0% {
            transform: scale(1);
        }

        100% {
            transform: scale(1.15);
        }
    }

    .animate-ken-burns {
        animation: ken-burns 25s ease-out infinite alternate;
    }
</style>