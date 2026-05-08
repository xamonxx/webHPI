<!DOCTYPE html>
<html class="dark" lang="id" style="background:#0a0c10">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    @php
        $siteName = $settings['site_name'] ?? config('app.name', 'Home Putra Interior');
        $metaDescription = $settings['site_description'] ?? '';
        $metaKeywords = $settings['seo_keywords'] ?? '';
        $showBrandIntro = request()->routeIs('home');
    @endphp

    {{-- Primary SEO Meta Tags --}}
    <title>@hasSection('title')@yield('title') | {{ $siteName }}@else{{ $siteName }}@endif</title>
    <meta name="title" content="@yield('meta_title', $siteName)">
    <meta name="description" content="@yield('meta_description', $metaDescription)">
    <meta name="keywords" content="@yield('meta_keywords', $metaKeywords)">
    <meta name="author" content="{{ $siteName }}">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="googlebot" content="index, follow">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Canonical URL --}}
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Geo Tags (Local SEO) --}}
    <meta name="geo.region" content="ID-JB">
    <meta name="geo.placename" content="Bandung, Jawa Barat, Indonesia">
    <meta name="geo.position" content="-6.9175;107.6191">
    <meta name="ICBM" content="-6.9175, 107.6191">

    {{-- Open Graph / Facebook --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('og_title', $siteName)">
    <meta property="og:description" content="@yield('og_description', $metaDescription)">
    <meta property="og:image" content="@yield('og_image', asset('assets/images/logo.png'))">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="Home Putra Interior - Desain Interior Premium">
    <meta property="og:locale" content="id_ID">
    <meta property="og:site_name" content="{{ $siteName }}">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="@yield('twitter_title', $siteName)">
    <meta name="twitter:description" content="@yield('twitter_description', $metaDescription)">
    <meta name="twitter:image" content="@yield('twitter_image', asset('assets/images/logo.png'))">

    {{-- Favicon & Icons --}}
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/logo.png') }}">
    <meta name="theme-color" content="#ffb204">
    <meta name="msapplication-TileColor" content="#0a0c10">

    @if($showBrandIntro)
    <script>
        (() => {
            try {
                const introStorageKey = 'homePutra.brandIntroPlayed';
                const lastPathKey = 'homePutra.lastPath';
                const currentPath = window.location.pathname + window.location.search;
                const previousPath = sessionStorage.getItem(lastPathKey);
                const navigation = performance.getEntriesByType('navigation')[0];
                const isReload = navigation?.type === 'reload' || performance.navigation?.type === 1;
                const isSamePathReload = previousPath === currentPath;

                if (!isReload && !isSamePathReload && sessionStorage.getItem(introStorageKey) === '1') {
                    document.documentElement.classList.add('brand-intro-skip');
                } else {
                    document.documentElement.classList.remove('brand-intro-skip');
                }

                sessionStorage.setItem(lastPathKey, currentPath);
            } catch (error) {
                document.documentElement.classList.add('brand-intro-skip');
            }
        })();
    </script>
    @endif

    {{-- Structured Data / JSON-LD Schema --}}
    @php
        $sameAs = array_values(array_filter([
            $settings['instagram_url'] ?? null,
            $settings['facebook_url'] ?? null,
            $settings['youtube_url'] ?? null,
        ]));
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'LocalBusiness',
            '@id' => url('/') . '#organization',
            'name' => $siteName,
            'description' => $settings['site_description'] ?? '',
            'url' => url('/'),
            'logo' => asset('assets/images/logo.png'),
            'image' => asset('assets/images/logo.png'),
            'address' => [
                '@type' => 'PostalAddress',
                'addressCountry' => 'ID',
            ],
            'areaServed' => [
                ['@type' => 'Country', 'name' => 'Indonesia'],
            ],
        ];

        if (!empty($settings['whatsapp_number'])) {
            $schema['telephone'] = $settings['whatsapp_number'];
        }

        if (!empty($settings['contact_phone'])) {
            $schema['telephone'] = $settings['contact_phone'];
        }

        if (!empty($settings['contact_email'])) {
            $schema['email'] = $settings['contact_email'];
        }

        if (!empty($settings['contact_address'])) {
            $schema['address']['streetAddress'] = $settings['contact_address'];
        }

        if (!empty($sameAs)) {
            $schema['sameAs'] = $sameAs;
        }
    @endphp
    <script type="application/ld+json">
        @json($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
    </script>

    {{-- BreadcrumbList Schema (Dynamic) --}}
    @hasSection('breadcrumb_schema')
    @yield('breadcrumb_schema')
    @endif

    {{-- Tailwind CSS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Local fonts and icons --}}
    <link rel="preload" href="{{ asset('assets/fonts/montserrat-400.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset('assets/fonts/montserrat-500.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset('assets/fonts/montserrat-600.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset('assets/fonts/cormorant-400.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset('assets/fonts/cormorant-600.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link href="{{ asset('assets/css/fonts.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/material-symbols.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/aos.min.css') }}" rel="stylesheet" media="print" onload="this.onload=null;this.media='all'" />
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" />

    @stack('styles')
</head>

<body class="{{ $showBrandIntro ? 'brand-intro-lock ' : '' }}bg-background-dark text-white antialiased overflow-x-hidden" style="background:#0a0c10">

    @if($showBrandIntro)
    {{-- Brand Intro --}}
    <div id="brand-intro" class="brand-intro" role="status" aria-label="Intro {{ $siteName }}">
        <div class="brand-intro__background" data-brand-intro-bg></div>
        <div class="brand-intro__content">
            <img
                src="{{ asset('assets/images/logo.png') }}"
                alt="{{ $siteName }}"
                class="brand-intro__logo animate__animated animate__fadeIn"
                width="180"
                height="180"
                decoding="async">
            <p class="brand-intro__name animate__animated animate__fadeIn">
                <span class="brand-intro__name-main">Home Putra</span>
                <span class="brand-intro__name-accent">Interior</span>
            </p>
        </div>
    </div>
    @endif

    {{-- Skip to Main Content (Accessibility) --}}
    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 bg-primary text-black px-4 py-2 rounded-lg z-200">
        Langsung ke Konten Utama
    </a>

    {{-- Navigation --}}
    @include('frontend.partials.navbar')

    {{-- Mobile Menu Overlay --}}
    <div id="mobile-menu-overlay" class="fixed inset-0 bg-black/50 z-55 hidden opacity-0 transition-opacity duration-300"></div>

    {{-- Main Content --}}
    <main id="main-content">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('frontend.partials.footer')

    @if(!empty($settings['whatsapp_number']))
    <div x-data="{
            waOpen: false,
            waMessage: '',
            waNumber: '{{ preg_replace('/[^0-9]/', '', $settings['whatsapp_number']) }}',
            sendWa() {
                let msg = this.waMessage.trim();
                if(msg === '') {
                    msg = 'Halo Home Putra Interior, saya tertarik dengan layanan desain interior Anda.';
                } else {
                    msg = 'hallo saya dari client dari website Home Putra Interior mau konsultasi :\n\n' + msg;
                }
                window.open('https://wa.me/' + this.waNumber + '?text=' + encodeURIComponent(msg), '_blank');
                this.waMessage = '';
                this.waOpen = false;
            }
        }"
        class="fixed bottom-6 right-6 z-[1000] font-sans flex flex-col items-end">
        
        {{-- Chat Box Modal --}}
        <div x-show="waOpen" 
             x-transition:enter="transition ease-out duration-300 transform origin-bottom-right"
             x-transition:enter-start="opacity-0 scale-50 translate-y-10"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200 transform origin-bottom-right"
             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
             x-transition:leave-end="opacity-0 scale-50 translate-y-10"
             x-cloak
             class="mb-4 w-[340px] bg-[#efeae2] rounded-[16px] shadow-2xl overflow-hidden flex flex-col border border-black/5"
             @click.away="waOpen = false">
             
            {{-- Header --}}
            <div class="bg-[#008069] text-white px-4 py-3 flex items-center justify-between shadow-sm z-10">
                <div class="flex items-center gap-3">
                    <div class="relative flex items-center justify-center w-9 h-9 rounded-full bg-white/10">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                        </svg>
                        <div class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-[#25D366] border-2 border-[#008069] rounded-full"></div>
                    </div>
                    <div>
                        <h4 class="font-semibold text-[15px] leading-tight">Customer Service</h4>
                        <p class="text-[11px] text-white/80 mt-0.5">Membalas dalam beberapa menit</p>
                    </div>
                </div>
                <button @click="waOpen = false" aria-label="Close Chat" class="hover:bg-black/10 p-1.5 rounded-full transition-colors text-white/90">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none"><path d="M6 18L18 6M6 6l12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
            </div>
            
            {{-- Body --}}
            <div class="p-4 bg-[#efeae2] relative z-0 flex-1" style="min-height: 240px;">
                <div class="absolute inset-0 z-0 opacity-[0.4] bg-[url('https://web.whatsapp.com/img/bg-chat-tile-light_04fcacde539c58cca6745483d4858c52.png')] bg-repeat" style="background-size: 300px;"></div>
                
                {{-- Chat Bubble --}}
                <div class="relative z-10 bg-white text-[#111b21] p-2.5 pr-14 rounded-lg rounded-tl-none text-[14px] shadow-sm max-w-[85%] float-left mt-2">
                    <p class="leading-relaxed">Halo, ada yang bisa kami bantu? :)</p>
                    <div class="text-[10px] text-[#667781] absolute bottom-1 right-2" x-text="new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})"></div>
                    {{-- Triangle --}}
                    <div class="absolute top-0 -left-2 w-0 h-0 border-[6px] border-transparent border-t-white border-r-white"></div>
                </div>
                <div class="clear-both"></div>
            </div>
            
            {{-- Input Area --}}
            <div class="bg-[#f0f2f5] p-3 flex items-end gap-2 relative z-10">
                <div class="bg-white flex-1 rounded-[24px] px-4 py-2 flex items-center shadow-[0_1px_1px_rgba(0,0,0,0.05)] min-h-[44px]">
                    <input type="text" x-model="waMessage" @keydown.enter="sendWa()" placeholder="Ketik pesan" 
                           class="w-full border-none p-0 text-[15px] text-[#111b21] bg-transparent placeholder:text-[#667781] !outline-none !ring-0 !shadow-none !border-transparent focus:!outline-none focus:!ring-0 focus:!border-transparent focus:!shadow-none active:!outline-none active:!ring-0">
                </div>
                <button @click="sendWa()" aria-label="Kirim Pesan" class="w-[44px] h-[44px] rounded-full bg-[#00a884] hover:bg-[#008f6f] text-white flex items-center justify-center transition-colors shrink-0 shadow-md">
                    <svg class="w-5 h-5 translate-x-[-1px] translate-y-[1px]" viewBox="0 0 24 24" fill="currentColor"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>
                </button>
            </div>
        </div>

        {{-- Floating Toggle Button --}}
        <button @click="waOpen = !waOpen" class="group relative flex items-center justify-center" aria-label="Toggle WhatsApp Chat">
            {{-- Animasi Denyut (Pulse) --}}
            <div class="absolute inset-0 bg-green-500 rounded-full animate-ping opacity-30" x-show="!waOpen"></div>

            {{-- Tombol Utama --}}
            <div class="relative w-[60px] h-[60px] rounded-full flex items-center justify-center shadow-lg transition-all duration-300"
                 :class="waOpen ? 'bg-[#ff4d4d] hover:bg-[#e60000] rotate-180 scale-90' : 'bg-[#25D366] hover:bg-[#20BD5A] shadow-green-500/40 hover:scale-110'">
                {{-- WA Icon --}}
                <svg x-show="!waOpen" class="w-9 h-9 text-white transition-opacity" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                </svg>
                {{-- Close Icon --}}
                <svg x-show="waOpen" class="w-8 h-8 text-white transition-opacity" x-cloak fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
        </button>
    </div>
    @endif

    {{-- Scripts --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script defer src="{{ asset('assets/js/aos.min.js') }}"></script>
    <script defer src="{{ asset('assets/js/main.js') }}"></script>
    <script>
        (() => {
            window.addEventListener('beforeunload', () => {
                sessionStorage.setItem('homePutra.lastPath', window.location.pathname + window.location.search);
            });
        })();

        (() => {
            const introStorageKey = 'homePutra.brandIntroPlayed';
            const lastPathKey = 'homePutra.lastPath';
            const intro = document.getElementById('brand-intro');
            const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            const currentPath = window.location.pathname + window.location.search;
            const previousPath = sessionStorage.getItem(lastPathKey);
            const navigation = performance.getEntriesByType('navigation')[0];
            const isReload = navigation?.type === 'reload' || performance.navigation?.type === 1;
            const isSamePathReload = previousPath === currentPath;
            const alreadyPlayed = !isReload && !isSamePathReload && sessionStorage.getItem(introStorageKey) === '1';

            sessionStorage.setItem(lastPathKey, currentPath);

            if (!intro || reduceMotion || alreadyPlayed) {
                document.body.classList.remove('brand-intro-lock');
                intro?.remove();
                return;
            }

            document.documentElement.classList.remove('brand-intro-skip');

            const introStartedAt = performance.now();
            const minVisibleMs = 1100;
            const maxWaitMs = 2800;
            const textExitDelayMs = 620;
            const logoExitDelayMs = 1080;
            const introRemoveDelayMs = 2050;
            let hasPlayed = false;

            const playIntroExit = () => {
                if (hasPlayed) return;
                hasPlayed = true;
                sessionStorage.setItem(introStorageKey, '1');

                const remainingVisibleTime = Math.max(0, minVisibleMs - (performance.now() - introStartedAt));

                window.setTimeout(() => {
                    const background = intro.querySelector('[data-brand-intro-bg]');
                    const content = intro.querySelector('.brand-intro__content');
                    const logo = intro.querySelector('.brand-intro__logo');
                    const text = intro.querySelector('.brand-intro__name');
                    const fadeOutItem = (item) => {
                        if (!item) return;

                        item.classList.remove('animate__fadeIn');
                        item.classList.add('animate__fadeOut');
                    };

                    background?.classList.add('brand-intro__background--leaving');
                    content?.classList.add('brand-intro__content--leaving');

                    window.setTimeout(() => {
                        fadeOutItem(text);
                    }, textExitDelayMs);

                    window.setTimeout(() => {
                        fadeOutItem(logo);
                    }, logoExitDelayMs);

                    window.setTimeout(() => {
                        intro.classList.add('brand-intro--hidden');
                        document.body.classList.remove('brand-intro-lock');

                        window.setTimeout(() => {
                            intro.remove();
                        }, 260);
                    }, introRemoveDelayMs);
                }, remainingVisibleTime);
            };

            window.addEventListener('load', playIntroExit, { once: true });
            window.setTimeout(playIntroExit, maxWaitMs);
        })();

        // Initialize AOS - Disable on mobile/tablet for immediate visibility
        document.addEventListener('DOMContentLoaded', () => {
            const isMobileOrTablet = window.innerWidth < 1024;
            // Check if AOS is defined to avoid errors
            if (typeof AOS !== 'undefined') {
                AOS.init({
                    duration: 800,
                    once: true,
                    offset: 50,
                    disable: isMobileOrTablet // Disable AOS on mobile/tablet
                });
            }
        });

        // CSRF Token for AJAX
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Preloader Optimization (Removed)
        // document.addEventListener('DOMContentLoaded', () => { ... });
    </script>

    @stack('scripts')
</body>

</html>
