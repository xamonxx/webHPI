@extends('frontend.layouts.app')

@php
    $siteName = $settings['site_name'] ?? 'Home Putra Interior';
    $pageTitle = $category
        ? "Portofolio {$category} - {$siteName}"
        : "Portofolio Interior & Furniture Custom - {$siteName}";
    $pageDescription = $category
        ? "Lihat inspirasi portofolio {$category} dari {$siteName}. Temukan referensi desain interior dan furniture custom untuk kebutuhan rumah atau bisnis Anda."
        : "Lihat koleksi portofolio desain interior, kitchen set, wardrobe, backdrop TV, dan furniture custom dari {$siteName}.";
@endphp

@section('title', $pageTitle)
@section('meta_title', $pageTitle)
@section('meta_description', $pageDescription)
@section('og_title', $pageTitle)
@section('og_description', $pageDescription)
@section('twitter_title', $pageTitle)
@section('twitter_description', $pageDescription)

@section('content')
<div class="pt-32 pb-20 sm:pt-40 sm:pb-32 bg-background-dark min-h-screen" data-portfolio-page>
    <div class="max-w-[1400px] mx-auto px-6">

        <!-- Header Section -->
        <div class="text-center mb-16 sm:mb-24" data-aos="fade-up">
            <span class="text-primary uppercase tracking-[0.4em] text-[10px] font-bold block mb-4">Karya Terbaik</span>
            <h1 class="text-4xl md:text-6xl lg:text-7xl text-white font-serif mb-6">Proyek <span class="text-primary italic">Portofolio</span></h1>
            <p class="text-gray-400 max-w-2xl mx-auto font-light leading-relaxed text-sm sm:text-base">
                Menampilkan koleksi lengkap karya desain interior kami yang menggabungkan estetika, fungsi, dan gaya hidup premium.
            </p>
        </div>

        <div data-portfolio-content>
            <!-- Filter Buttons (Optional) -->
            @if($categories->count() > 0)
            <div class="flex flex-wrap justify-center gap-4 mb-12" data-portfolio-filters>
                <a href="{{ route('portfolio.all') }}" data-portfolio-filter class="portfolio-filter-button {{ !$category ? 'is-active' : '' }}">
                    Semua
                </a>
                @foreach($categories as $cat)
                <a href="{{ route('portfolio.all', ['category' => $cat]) }}" data-portfolio-filter class="portfolio-filter-button {{ $category == $cat ? 'is-active' : '' }}">
                    {{ $cat }}
                </a>
                @endforeach
            </div>
            @endif

            <div class="portfolio-grid-shell" data-portfolio-shell>
                <!-- Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8 mb-16" data-portfolio-grid>
                    @forelse($portfolios as $index => $portfolio)
                    @php
                    $imageSrc = $portfolio->image_url;
                    $photoCount = count($portfolio->all_images);
                    @endphp
                    <a href="{{ route('portfolio.show', $portfolio->id) }}" class="portfolio-card theme-keep-dark group relative overflow-hidden rounded-xl break-inside-avoid cursor-pointer card-hover" style="--portfolio-card-delay: {{ min($index, 8) * 28 }}ms;">
                        <!-- Image -->
                        <div class="aspect-4/5 overflow-hidden bg-white/5 flex items-center justify-center">
                            @if($imageSrc)
                            <img alt="{{ $portfolio->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" src="{{ $imageSrc }}" loading="lazy" />
                            @else
                            <span class="material-symbols-outlined text-primary/60 text-6xl">image</span>
                            @endif
                            @if($photoCount > 1)
                            <span class="theme-keep-dark absolute top-3 right-3 rounded-full border border-white/10 bg-black/60 px-3 py-1 text-[11px] font-bold text-white backdrop-blur-md">
                                {{ $photoCount }} Foto
                            </span>
                            @endif
                        </div>

                        <!-- Overlay -->
                        <div class="theme-keep-dark absolute inset-0 bg-linear-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex flex-col justify-end p-8">
                            @if($portfolio->category)
                            <span class="text-primary text-[10px] uppercase tracking-[0.2em] font-bold mb-2 translate-y-4 group-hover:translate-y-0 transition-transform duration-500 delay-100">{{ $portfolio->category }}</span>
                            @endif
                            <h3 class="text-2xl text-white font-serif italic translate-y-4 group-hover:translate-y-0 transition-transform duration-500 delay-200">{{ $portfolio->title }}</h3>
                        </div>
                    </a>
                    @empty
                    <div class="col-span-full text-center py-20">
                        <p class="text-gray-500 italic">Belum ada portfolio ditampilkan.</p>
                    </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="flex justify-center" data-portfolio-pagination>
                    {{ $portfolios->links('pagination::tailwind') }}
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    (() => {
        const page = document.querySelector('[data-portfolio-page]');
        if (!page || page.dataset.portfolioReady === 'true') return;

        page.dataset.portfolioReady = 'true';

        const state = {
            controller: null,
            requestId: 0,
        };

        const setActiveFilter = (url) => {
            const target = new URL(url, window.location.origin).href;

            page.querySelectorAll('[data-portfolio-filter]').forEach((link) => {
                link.classList.toggle('is-active', new URL(link.href, window.location.origin).href === target);
            });
        };

        const setLoading = (loading) => {
            page.querySelector('[data-portfolio-shell]')?.classList.toggle('is-loading', loading);
            page.querySelectorAll('[data-portfolio-filter]').forEach((link) => {
                link.toggleAttribute('aria-disabled', loading);
            });
        };

        const replacePortfolioContent = (html) => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const incoming = doc.querySelector('[data-portfolio-content]');
            const current = page.querySelector('[data-portfolio-content]');

            if (!incoming || !current) return false;

            current.innerHTML = incoming.innerHTML;
            document.title = doc.title;

            const incomingDescription = doc.querySelector('meta[name="description"]');
            const currentDescription = document.querySelector('meta[name="description"]');

            if (incomingDescription && currentDescription) {
                currentDescription.setAttribute('content', incomingDescription.getAttribute('content') || '');
            }

            return true;
        };

        const loadPortfolio = async (url, pushState = true) => {
            if (state.controller) {
                state.controller.abort();
            }

            const requestId = state.requestId + 1;
            state.requestId = requestId;
            state.controller = new AbortController();
            setActiveFilter(url);
            setLoading(true);

            try {
                const response = await fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    signal: state.controller.signal,
                });

                if (!response.ok) {
                    window.location.href = url;
                    return;
                }

                const html = await response.text();
                const replaced = replacePortfolioContent(html);

                if (!replaced) {
                    window.location.href = url;
                    return;
                }

                if (requestId !== state.requestId) return;

                if (pushState) {
                    window.history.pushState({ portfolioUrl: url }, '', url);
                }

                if (typeof AOS !== 'undefined') {
                    window.requestAnimationFrame(() => AOS.refreshHard());
                }
            } catch (error) {
                if (error.name !== 'AbortError') {
                    window.location.href = url;
                }
            } finally {
                if (requestId === state.requestId) {
                    setLoading(false);
                    state.controller = null;
                }
            }
        };

        page.addEventListener('click', (event) => {
            const link = event.target.closest('[data-portfolio-filter], [data-portfolio-pagination] a');
            if (!link || !page.contains(link)) return;
            if (event.metaKey || event.ctrlKey || event.shiftKey || event.altKey || link.target === '_blank') return;

            event.preventDefault();
            loadPortfolio(link.href);
        });

        window.addEventListener('popstate', () => {
            loadPortfolio(window.location.href, false);
        });
    })();
</script>

<style>
    .portfolio-filter-button {
        display: inline-flex;
        min-height: 42px;
        align-items: center;
        justify-content: center;
        border-radius: 999px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        padding: 0.5rem 1.875rem;
        color: rgb(156 163 175);
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.16em;
        line-height: 1;
        text-transform: uppercase;
        transition:
            background-color 160ms ease,
            border-color 160ms ease,
            color 160ms ease,
            box-shadow 180ms ease,
            transform 180ms ease;
    }

    .portfolio-filter-button:hover,
    .portfolio-filter-button:focus-visible {
        border-color: rgba(255, 255, 255, 0.45);
        color: #fff;
        transform: translateY(-1px);
    }

    .portfolio-filter-button.is-active {
        border-color: rgb(255 178 4);
        background: rgb(255 178 4);
        color: #050505;
        box-shadow: 0 12px 28px rgba(255, 178, 4, 0.18);
    }

    html:not(.dark) body.frontend-theme .portfolio-filter-button {
        border-color: rgba(18, 22, 31, 0.1);
        background: rgba(255, 255, 255, 0.52);
        color: #667085;
    }

    html:not(.dark) body.frontend-theme .portfolio-filter-button:hover,
    html:not(.dark) body.frontend-theme .portfolio-filter-button:focus-visible {
        border-color: rgba(18, 22, 31, 0.22);
        color: #111827;
    }

    html:not(.dark) body.frontend-theme .portfolio-filter-button.is-active {
        border-color: rgb(255 178 4);
        background: rgb(255 178 4);
        color: #050505;
    }

    .portfolio-grid-shell {
        transition:
            opacity 180ms ease,
            transform 220ms cubic-bezier(0.22, 1, 0.36, 1),
            filter 220ms ease;
    }

    .portfolio-grid-shell.is-loading {
        opacity: 0.58;
        transform: translateY(8px);
        filter: blur(1.5px);
        pointer-events: none;
    }

    .portfolio-card {
        animation: portfolio-card-in 320ms cubic-bezier(0.22, 1, 0.36, 1) both;
        animation-delay: var(--portfolio-card-delay, 0ms);
        will-change: opacity, transform;
    }

    @keyframes portfolio-card-in {
        from {
            opacity: 0;
            transform: translateY(14px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .portfolio-filter-button,
        .portfolio-grid-shell,
        .portfolio-card {
            animation: none !important;
            transition: none !important;
        }
    }
</style>
@endsection
