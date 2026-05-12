@extends('frontend.layouts.app')

@php
    $siteName = $settings['site_name'] ?? 'Home Putra Interior';
    $projectTitle = $portfolio->title ?? 'Detail Proyek';
    $pageTitle = "{$projectTitle} - {$siteName}";
    $pageDescription = $portfolio->description
        ? \Illuminate\Support\Str::limit(strip_tags($portfolio->description), 155)
        : "Detail proyek {$projectTitle} dari {$siteName}. Lihat inspirasi desain interior dan furniture custom untuk hunian atau bisnis Anda.";
@endphp

@section('title', $pageTitle)
@section('meta_title', $pageTitle)
@section('meta_description', $pageDescription)
@section('og_title', $pageTitle)
@section('og_description', $pageDescription)
@section('twitter_title', $pageTitle)
@section('twitter_description', $pageDescription)
@if($portfolio->image_url)
    @section('og_image', $portfolio->image_url)
    @section('twitter_image', $portfolio->image_url)
@endif

@section('content')
@php
    $imageUrl = $portfolio->image_url;
    $allImages = $portfolio->all_images;
    $whatsappNumber = $settings['whatsapp_number'] ?? '';
@endphp

<main class="bg-background-dark text-white overflow-hidden">
    {{-- Project Hero --}}
    <section id="portfolio-hero" class="theme-keep-dark relative min-h-[100svh] pt-24 pb-14 flex items-end overflow-hidden">
        <div class="absolute inset-0 z-0">
            @if($imageUrl)
            <img src="{{ $imageUrl }}" alt="{{ $portfolio->title }}" class="absolute inset-0 w-full h-full object-cover" fetchpriority="high" decoding="async">
            @else
            <div class="absolute inset-0 bg-linear-to-br from-[#1a1d24] via-background-dark to-black"></div>
            @endif
            <div class="absolute inset-0 bg-black/55"></div>
            <div class="absolute inset-0 bg-linear-to-r from-black via-black/55 to-black/15"></div>
            <div class="absolute inset-0 bg-linear-to-t from-background-dark via-transparent to-black/30"></div>
        </div>

        <div class="relative z-10 max-w-[1536px] mx-auto w-full px-6 sm:px-8 lg:px-12 xl:px-[72px]">
            <div class="max-w-[980px]">
                {{-- Breadcrumb --}}
                <nav aria-label="Breadcrumb" class="mb-10">
                    <ol class="flex items-center gap-2 sm:gap-3 text-[11px] sm:text-xs font-medium uppercase tracking-wider text-gray-400">
                        <li>
                            <a href="{{ route('home') }}" class="hover:text-primary transition-colors flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                </svg>
                                <span class="hidden sm:inline">Beranda</span>
                            </a>
                        </li>
                        <li>
                            <svg class="w-3.5 h-3.5 opacity-30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="m9 18 6-6-6-6"></path>
                            </svg>
                        </li>
                        <li>
                            <a href="{{ route('portfolio.all') }}" class="hover:text-primary transition-colors">Portofolio</a>
                        </li>
                        <li>
                            <svg class="w-3.5 h-3.5 opacity-30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="m9 18 6-6-6-6"></path>
                            </svg>
                        </li>
                        <li class="text-primary truncate max-w-[150px] sm:max-w-[300px]" aria-current="page">
                            {{ $portfolio->title }}
                        </li>
                    </ol>
                </nav>

                @if($portfolio->category)
                <div class="inline-flex items-center gap-3 px-4 py-2 rounded-full border border-white/10 bg-white/5 backdrop-blur-md mb-6">
                    <span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
                    <span class="text-primary text-[10px] uppercase tracking-[0.24em] font-bold">{{ $portfolio->category }}</span>
                </div>
                @endif

                <h1 class="project-detail-title font-bold text-white leading-[1.02] tracking-0 drop-shadow-xl mb-7">
                    {{ $portfolio->title }}<span class="text-primary">.</span>
                </h1>

                @if($portfolio->description)
                <p class="max-w-3xl text-gray-200 text-base sm:text-lg lg:text-xl leading-relaxed font-light mb-10">
                    {{ $portfolio->description }}
                </p>
                @endif

                <div class="flex flex-col sm:flex-row gap-4 sm:gap-5">
                    <a href="#project-overview" class="inline-flex items-center justify-center gap-3 min-h-[58px] px-8 rounded-full bg-primary text-black text-sm font-bold uppercase tracking-wider shadow-[0_0_24px_rgba(255,178,4,0.25)] hover:bg-white transition-colors">
                        Lihat Detail
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M12 5v14m7-7-7 7-7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>

                    @if($whatsappNumber)
                    <a href="https://wa.me/{{ $whatsappNumber }}?text={{ urlencode('Saya tertarik dengan proyek: ' . $portfolio->title) }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="inline-flex items-center justify-center min-h-[58px] px-8 rounded-full bg-white/5 border border-white/20 text-white text-sm font-medium uppercase tracking-wider backdrop-blur-md hover:bg-white hover:text-black transition-colors">
                        Konsultasi Gratis
                    </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="hidden lg:flex absolute right-10 bottom-14 z-10 flex-col items-center gap-4">
            <span class="text-[9px] uppercase tracking-[0.3em] text-white/50 rotate-90 origin-right translate-x-3">Gulir ke Bawah</span>
            <div class="w-px h-24 bg-linear-to-b from-white/50 to-transparent"></div>
        </div>
    </section>

    {{-- Overview with Slider --}}
    <section id="project-overview" class="relative py-12 sm:py-16 lg:py-20" x-data="portfolioSlider()" x-init="init()">
        <div class="absolute top-0 right-0 w-[520px] h-[520px] bg-primary/5 blur-[150px] rounded-full pointer-events-none"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-10 items-start">
                {{-- Left: Image Slider --}}
                <div class="lg:col-span-7 flex flex-col">
                    <div class="theme-keep-dark relative overflow-hidden group w-full slider-frame"
                        @touchstart="touchStart($event)" @touchmove="touchMove($event)" @touchend="touchEnd($event, 'slider')">
                        @if(count($allImages) > 0)
                        <img @click="openFromSlider()"
                            src="{{ $allImages[0] }}" :src="images[current] || '{{ $allImages[0] }}'"
                            :alt="'{{ $portfolio->title }} - Gambar ' + (current + 1)"
                            class="w-full h-full object-contain"
                            :class="[slideClass, isMobile ? '' : 'cursor-zoom-in']"
                            :style="dragStyle"
                            onerror="this.onerror=null; this.src='{{ asset('assets/images/hero-interior-local.jpg') }}';" loading="lazy">
                        @endif
                        @if(count($allImages) > 1)
                        <div class="absolute inset-0 flex items-center justify-between px-4 opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none">
                            <button @click.stop="prev()" class="pointer-events-auto w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-black/50 backdrop-blur-md text-white flex items-center justify-center hover:bg-primary transition-colors shadow-lg">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none"><path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </button>
                            <button @click.stop="next()" class="pointer-events-auto w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-black/50 backdrop-blur-md text-white flex items-center justify-center hover:bg-primary transition-colors shadow-lg">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none"><path d="M9 18l6-6-6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </button>
                        </div>
                        <div class="absolute top-4 right-4 px-3 py-1.5 rounded-full bg-black/50 backdrop-blur-md border border-white/10 text-white text-xs font-mono pointer-events-none" x-text="(current + 1) + ' / ' + images.length"></div>
                        @endif
                    </div>
                    @if(count($allImages) > 1)
                    <div class="flex gap-3 mt-4 overflow-x-auto px-2 py-3 -mx-2 scrollbar-hide">
                        @foreach($allImages as $idx => $img)
                        <button @click="goTo({{ $idx }})" class="shrink-0 w-14 h-14 sm:w-16 sm:h-16 rounded-2xl border-2 bg-white/5 p-0.5 transition-[border-color,box-shadow,opacity] duration-300"
                            :class="current === {{ $idx }} ? 'border-primary shadow-[0_0_18px_rgba(255,178,4,0.35)] opacity-100' : 'border-white/10 opacity-60 hover:opacity-100 hover:border-white/30'">
                            <img src="{{ $img }}" alt="Thumbnail {{ $idx + 1 }}" class="w-full h-full rounded-xl object-cover">
                        </button>
                        @endforeach
                    </div>
                    @endif
                </div>
                {{-- Right: Info --}}
                <aside class="lg:col-span-5 lg:sticky lg:top-24 space-y-5">
                    <div class="rounded-2xl border border-white/10 bg-white/[0.04] backdrop-blur-sm p-6 sm:p-8">
                        <div class="flex items-center gap-3 mb-5">
                            <span class="w-2 h-2 rounded-full bg-primary"></span>
                            <h2 class="text-xl sm:text-2xl font-bold text-white">Ringkasan Proyek</h2>
                        </div>
                        <p class="text-gray-400 text-sm sm:text-base leading-relaxed font-light">{{ $portfolio->description ?: 'Detail proyek sedang disiapkan.' }}</p>
                        <div class="mt-6 pt-6 border-t border-white/10 grid grid-cols-2 gap-4">
                            @if($portfolio->category)
                            <div>
                                <span class="block text-[10px] uppercase tracking-[0.22em] text-gray-500 font-bold mb-1.5">Kategori</span>
                                <span class="text-white text-sm font-semibold">{{ $portfolio->category }}</span>
                            </div>
                            @endif
                            <div>
                                <span class="block text-[10px] uppercase tracking-[0.22em] text-gray-500 font-bold mb-1.5">Proyek</span>
                                <span class="text-white text-sm font-semibold">Interior Custom</span>
                            </div>
                        </div>
                    </div>
                    @if($whatsappNumber)
                    <a href="https://wa.me/{{ $whatsappNumber }}?text={{ urlencode('Saya tertarik dengan proyek: ' . $portfolio->title) }}" target="_blank" rel="noopener noreferrer"
                        class="group inline-flex w-full items-center justify-between min-h-[60px] px-7 rounded-full bg-primary text-black text-sm font-bold uppercase tracking-[0.16em] hover:bg-white transition-colors">
                        <span>Mulai Konsultasi</span>
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" viewBox="0 0 24 24" fill="none"><path d="M5 12h14m-6-6 6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>
                    @endif
                </aside>
            </div>
        </div>

        {{-- Lightbox Modal --}}
        <div x-show="lightboxOpen" x-cloak
            x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            @keydown.escape.window="closeLightbox()"
            class="theme-keep-dark fixed inset-0 z-[100000] flex items-center justify-center">
            <div class="absolute inset-0 bg-black/95" @click="closeLightbox()"></div>
            <button @click="closeLightbox()" class="absolute top-5 right-5 z-20 w-11 h-11 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-colors">
                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none"><path d="M18 6L6 18M6 6l12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
            <div class="absolute top-5 left-1/2 -translate-x-1/2 z-20 px-4 py-2 rounded-full bg-white/10 backdrop-blur-md text-white text-sm font-mono" x-text="(lightboxIdx + 1) + ' / ' + images.length"></div>
            <img :src="images[lightboxIdx]" class="relative z-10 max-w-[92vw] max-h-[90vh] object-contain rounded-lg select-none" @click.stop
                :class="lbSlideClass"
                :style="lbDragStyle"
                @touchstart="touchStart($event)" @touchmove="touchMove($event)" @touchend="touchEnd($event, 'lightbox')" draggable="false">
            @if(count($allImages) > 1)
            <div class="absolute inset-0 z-20 flex items-center justify-between px-4 pointer-events-none">
                <button @click.stop="lightboxIdx = (lightboxIdx - 1 + images.length) % images.length" class="pointer-events-auto w-12 h-12 rounded-full bg-white/10 hover:bg-primary text-white flex items-center justify-center transition-colors">
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none"><path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
                <button @click.stop="lightboxIdx = (lightboxIdx + 1) % images.length" class="pointer-events-auto w-12 h-12 rounded-full bg-white/10 hover:bg-primary text-white flex items-center justify-center transition-colors">
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none"><path d="M9 18l6-6-6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
            </div>
            @endif
        </div>
    </section>

    {{-- Related Projects --}}
    @if(isset($related) && $related->count() > 0)
    <section class="pb-20 sm:pb-28">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-10">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full border border-white/10 bg-white/5 mb-4">
                        <span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
                        <span class="text-[10px] uppercase tracking-[0.2em] text-gray-300 font-bold">Lanjut Jelajahi</span>
                    </div>
                    <h2 class="text-3xl sm:text-5xl text-white font-serif leading-tight">Proyek <span class="text-primary italic">Terkait</span></h2>
                </div>
                <a href="{{ route('portfolio.all') }}" class="font-serif text-xl italic tracking-normal text-gray-300 hover:text-primary transition-colors">Lihat Semua</a>
            </div>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-5">
                @foreach($related as $rel)
                <a href="{{ route('portfolio.show', $rel->id) }}" class="theme-keep-dark group relative overflow-hidden rounded-xl sm:rounded-3xl border border-white/10 bg-white/5 aspect-[3/4] sm:aspect-[4/5]">
                    @if($rel->image_url)
                    <img src="{{ $rel->image_url }}" alt="{{ $rel->title }}" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" loading="lazy">
                    @else
                    <div class="absolute inset-0 bg-linear-to-br from-white/10 via-white/5 to-primary/10"></div>
                    @endif
                    <div class="absolute inset-0 bg-linear-to-t from-black/90 via-black/25 to-transparent"></div>
                    <div class="absolute inset-x-0 bottom-0 p-3 sm:p-6">
                        @if($rel->category)<span class="text-primary text-[8px] sm:text-[10px] uppercase tracking-[0.18em] font-bold">{{ $rel->category }}</span>@endif
                        <h3 class="mt-1 sm:mt-2 text-sm sm:text-2xl text-white font-serif italic leading-tight group-hover:text-primary transition-colors">{{ $rel->title }}</h3>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif
</main>

<style>
    .project-detail-title { font-size: clamp(3rem, 6vw, 6.4rem); }
    @media (max-width: 639px) { .project-detail-title { font-size: clamp(2.4rem, 12vw, 3.5rem); } }
    .scrollbar-hide::-webkit-scrollbar { display: none; }
    .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
    .slider-frame { max-height: calc(100vh - 13rem); background: transparent; display: flex; align-items: center; justify-content: center; }
    .slider-frame img { max-height: calc(100vh - 13rem); width: auto; max-width: 100%; object-fit: contain; border-radius: 0.75rem;
        transition: opacity 0.4s ease, filter 0.4s ease, transform 0.4s ease; }
    [x-cloak] { display: none !important; }

    /* Fade + blur transition */
    .fade-out  { opacity: 0; filter: blur(6px); transform: scale(0.97); }
    .fade-in   { animation: fadeBlurIn 0.4s ease forwards; }
    @keyframes fadeBlurIn {
        from { opacity: 0; filter: blur(6px); transform: scale(1.02); }
        to   { opacity: 1; filter: blur(0);   transform: scale(1); }
     }
 </style>

 <script>
     window.portfolioSlider = function() {
         return {
             images: @json($allImages),
             current: 0,
             transitioning: false,
             lightboxOpen: false,
             lightboxIdx: 0,
             isMobile: window.innerWidth < 1024,
             slideClass: '',
             lbSlideClass: '',
             dragStyle: '',
             lbDragStyle: '',
             _touchStartX: 0,
             _touchStartY: 0,
             _touchTime: 0,
             init() {
                 window.addEventListener('resize', () => { this.isMobile = window.innerWidth < 1024; });
             },
             touchStart(e) {
                 const t = e.touches[0];
                 this._touchStartX = t.clientX;
                 this._touchStartY = t.clientY;
                 this._touchTime = Date.now();
             },
             touchMove(e) {
                 if (this.images.length <= 1) return;
                 const t = e.touches[0];
                 const dx = t.clientX - this._touchStartX;
                 const dy = t.clientY - this._touchStartY;
                 if (Math.abs(dx) > 10 && Math.abs(dx) > Math.abs(dy)) {
                     e.preventDefault();
                     const opacity = 1 - Math.abs(dx) / 400;
                     const blur = Math.min(Math.abs(dx) / 30, 6);
                     const style = `opacity: ${Math.max(0.3, opacity)}; filter: blur(${blur}px); transition: none;`;
                     this.lightboxOpen ? this.lbDragStyle = style : this.dragStyle = style;
                 }
             },
             touchEnd(e, target) {
                 const t = e.changedTouches[0];
                 const dx = t.clientX - this._touchStartX;
                 const dy = t.clientY - this._touchStartY;
                 const elapsed = Date.now() - this._touchTime;
                 this.dragStyle = '';
                 this.lbDragStyle = '';
                 if (Math.abs(dx) > 50 && Math.abs(dx) > Math.abs(dy)) {
                     if (target === 'slider') {
                         this.fadeSwitch(dx < 0 ? 'next' : 'prev');
                     } else {
                         this.lbFadeSwitch(dx < 0 ? 'next' : 'prev');
                     }
                 } else if (target === 'slider' && Math.abs(dx) < 10 && elapsed < 300 && !this.isMobile) {
                     this.openFromSlider();
                 }
             },
             fadeSwitch(dir) {
                 if (this.transitioning) return;
                 this.transitioning = true;
                 const nextIdx = dir === 'next'
                     ? (this.current + 1) % this.images.length
                     : (this.current - 1 + this.images.length) % this.images.length;
                 this.slideClass = 'fade-out';
                 setTimeout(() => {
                     this.current = nextIdx;
                     this.slideClass = 'fade-in';
                     setTimeout(() => { this.slideClass = ''; this.transitioning = false; }, 400);
                 }, 300);
             },
             lbFadeSwitch(dir) {
                 const nextIdx = dir === 'next'
                     ? (this.lightboxIdx + 1) % this.images.length
                     : (this.lightboxIdx - 1 + this.images.length) % this.images.length;
                 this.lbSlideClass = 'fade-out';
                 setTimeout(() => {
                     this.lightboxIdx = nextIdx;
                     this.lbSlideClass = 'fade-in';
                     setTimeout(() => { this.lbSlideClass = ''; }, 400);
                 }, 300);
             },
             openFromSlider() {
                 this.lightboxIdx = this.current;
                 this.lightboxOpen = true;
                 document.body.style.overflow = 'hidden';
             },
             closeLightbox() { this.lightboxOpen = false; document.body.style.overflow = ''; },
             goTo(idx) {
                 if (idx === this.current || this.transitioning) return;
                 this.transitioning = true;
                 this.slideClass = 'fade-out';
                 setTimeout(() => {
                     this.current = idx;
                     this.slideClass = 'fade-in';
                     setTimeout(() => { this.slideClass = ''; this.transitioning = false; }, 400);
                 }, 300);
             },
             next() { this.fadeSwitch('next'); },
             prev() { this.fadeSwitch('prev'); }
         };
     };
 </script>
 @endsection

