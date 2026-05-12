<!DOCTYPE html>
<html lang="id" style="background:oklch(98.8% 0.003 106.5)">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <script>
        (() => {
            const storageKey = 'homePutra.theme';
            const savedTheme = localStorage.getItem(storageKey);
            const theme = savedTheme === 'dark' || savedTheme === 'light' ? savedTheme : 'light';

            document.documentElement.classList.toggle('dark', theme === 'dark');
            document.documentElement.style.colorScheme = theme;
            document.documentElement.style.background = theme === 'dark' ? '#0a0c10' : 'oklch(98.8% 0.003 106.5)';
        })();
    </script>

    @php
        $siteName = $settings['site_name'] ?? config('app.name', 'Home Putra Interior');
        $seoTitle = $settings['seo_meta_title'] ?? $siteName;
        $metaTitle = trim($__env->yieldContent('meta_title', $seoTitle));
        $documentTitle = trim($__env->yieldContent('title', $metaTitle));
        $metaDescription = $settings['seo_meta_description'] ?? ($settings['site_description'] ?? '');
        $metaKeywords = $settings['seo_keywords'] ?? '';
        $googleAnalyticsId = trim($settings['google_analytics_id'] ?? '');
        $hasGoogleAnalytics = preg_match('/^G-[A-Z0-9-]+$/i', $googleAnalyticsId);
        $showBrandIntro = false;
        $heroPreloadImage = request()->routeIs('home') && isset($hero)
            ? ($hero?->background_url ?: asset('assets/images/hero-interior-local.avif'))
            : null;
    @endphp

    {{-- Primary SEO Meta Tags --}}
    <title>{{ $documentTitle }}</title>
    <meta name="title" content="{{ $metaTitle }}">
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
    <meta property="og:title" content="@yield('og_title', $metaTitle)">
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
    <meta name="twitter:title" content="@yield('twitter_title', $metaTitle)">
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
            'description' => $metaDescription,
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

    @if($hasGoogleAnalytics)
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $googleAnalyticsId }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ $googleAnalyticsId }}');
    </script>
    @endif

    {{-- BreadcrumbList Schema (Dynamic) --}}
    @hasSection('breadcrumb_schema')
    @yield('breadcrumb_schema')
    @endif

    {{-- Tailwind CSS --}}
    @vite(['resources/css/app.css'])

    @if($heroPreloadImage)
    <link rel="preload" as="image" href="{{ $heroPreloadImage }}" fetchpriority="high">
    @endif

    {{-- Local fonts and icons --}}
    <link rel="preload" href="{{ asset('assets/fonts/montserrat-600.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset('assets/fonts/cormorant-600.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link href="{{ asset('assets/css/fonts.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/material-symbols.css') }}" rel="stylesheet" media="print" onload="this.onload=null;this.media='all'" />
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" />

    @stack('styles')
</head>

<body class="{{ $showBrandIntro ? 'brand-intro-lock ' : '' }}frontend-theme bg-background-dark text-white antialiased overflow-x-hidden">
    <noscript>
        <div class="theme-keep-dark fixed inset-x-0 top-0 z-[100000] bg-primary px-4 py-3 text-center text-sm font-bold text-black">
            JavaScript sedang nonaktif. Beberapa fitur interaktif seperti menu, tema, dan formulir konsultasi mungkin tidak berjalan.
        </div>
    </noscript>

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
    <div id="mobile-menu-overlay" class="theme-keep-dark fixed inset-0 bg-black/50 z-[99980] hidden opacity-0 transition-opacity duration-300"></div>

    {{-- Main Content --}}
    <main id="main-content">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('frontend.partials.footer')

    @include('frontend.partials.whatsapp-widget')

    {{-- Scripts --}}
    @if(request()->routeIs('portfolio.show'))
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.9/dist/cdn.min.js"></script>
    @endif
    <script defer src="{{ asset('assets/js/main.js') }}"></script>
    <script>
        (() => {
            const storageKey = 'homePutra.theme';
            const root = document.documentElement;
            const toggles = () => document.querySelectorAll('[data-theme-toggle]');

            function setTheme(theme) {
                const normalized = theme === 'dark' ? 'dark' : 'light';

                root.classList.toggle('dark', normalized === 'dark');
                root.style.colorScheme = normalized;
                root.style.background = normalized === 'dark' ? '#0a0c10' : 'oklch(98.8% 0.003 106.5)';
                localStorage.setItem(storageKey, normalized);

                toggles().forEach((toggle) => {
                    const icon = toggle.querySelector('[data-theme-icon]');
                    const label = toggle.querySelector('[data-theme-label]');
                    const isDark = normalized === 'dark';

                    toggle.setAttribute('aria-label', isDark ? 'Aktifkan light mode' : 'Aktifkan dark mode');
                    toggle.setAttribute('aria-pressed', isDark ? 'true' : 'false');
                    if (icon) icon.textContent = isDark ? 'light_mode' : 'dark_mode';
                    if (label) label.textContent = isDark ? 'Light' : 'Dark';
                });
            }

            document.addEventListener('DOMContentLoaded', () => {
                const currentTheme = root.classList.contains('dark') ? 'dark' : 'light';
                setTheme(currentTheme);

                toggles().forEach((toggle) => {
                    toggle.addEventListener('click', () => {
                        setTheme(root.classList.contains('dark') ? 'light' : 'dark');
                    });
                });
            });
        })();

    </script>

    @stack('scripts')
</body>

</html>
