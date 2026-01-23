<!DOCTYPE html>
<html class="dark" lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    {{-- Primary SEO Meta Tags --}}
    <title>@yield('title', 'Jasa Desain Interior Premium') | Home Putra Interior - Bandung & Jawa Barat</title>
    <meta name="title" content="@yield('meta_title', 'Home Putra Interior - Jasa Desain Interior & Furniture Custom Premium di Bandung')">
    <meta name="description" content="@yield('meta_description', $settings['site_description'] ?? 'Home Putra Interior - Studio desain interior premium #1 di Bandung & Jawa Barat. Spesialis kitchen set, lemari custom, backdrop TV, wallpanel. Garansi 2 tahun, gratis konsultasi & survey.')">
    <meta name="keywords" content="@yield('meta_keywords', 'jasa desain interior bandung, interior design jawa barat, kitchen set custom bandung, lemari pakaian custom, backdrop tv minimalis, furniture custom bandung, interior rumah minimalis, renovasi interior rumah, jasa interior murah bandung, desain interior modern, home putra interior, interior apartemen, interior kantor')">
    <meta name="author" content="Home Putra Interior">
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
    <meta property="og:title" content="@yield('og_title', 'Home Putra Interior - Jasa Desain Interior & Furniture Custom Premium')">
    <meta property="og:description" content="@yield('og_description', $settings['site_description'] ?? 'Studio desain interior premium #1 di Bandung. Spesialis kitchen set, lemari custom, backdrop TV. Garansi 2 tahun!')">
    <meta property="og:image" content="@yield('og_image', asset('assets/images/og-image.jpg'))">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="Home Putra Interior - Desain Interior Premium">
    <meta property="og:locale" content="id_ID">
    <meta property="og:site_name" content="Home Putra Interior">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="@yield('twitter_title', 'Home Putra Interior - Jasa Desain Interior Premium Bandung')">
    <meta name="twitter:description" content="@yield('twitter_description', 'Studio desain interior premium #1 di Bandung & Jawa Barat. Spesialis kitchen set, lemari custom, backdrop TV.')">
    <meta name="twitter:image" content="@yield('twitter_image', asset('assets/images/og-image.jpg'))">

    {{-- Favicon & Icons --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon-16x16.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/apple-touch-icon.png') }}">
    <meta name="theme-color" content="#ffb204">
    <meta name="msapplication-TileColor" content="#0a0c10">

    {{-- Structured Data / JSON-LD Schema --}}
    <script type="application/ld+json">
        {
            "@@context": "https://schema.org",
            "@@type": "LocalBusiness",
            "@@id": "{{ url('/') }}#organization",
            "name": "Home Putra Interior",
            "alternateName": "Home Putra Interior Design",
            "description": "{{ $settings['site_description'] ?? 'Studio desain interior premium di Bandung, Jawa Barat. Spesialis kitchen set custom, lemari pakaian, backdrop TV, dan wallpanel dengan garansi 2 tahun.' }}",
            "url": "{{ url('/') }}",
            "logo": "{{ asset('assets/images/logo.png') }}",
            "image": "{{ asset('assets/images/og-image.jpg') }}",
            "telephone": "{{ $settings['whatsapp_number'] ?? '+6281809939681' }}",
            "email": "{{ $settings['email'] ?? 'info@homeputrainterior.com' }}",
            "address": {
                "@@type": "PostalAddress",
                "streetAddress": "{{ $settings['address'] ?? 'Bandung' }}",
                "addressLocality": "Bandung",
                "addressRegion": "Jawa Barat",
                "postalCode": "40291",
                "addressCountry": "ID"
            },
            "geo": {
                "@@type": "GeoCoordinates",
                "latitude": -6.9175,
                "longitude": 107.6191
            },
            "areaServed": [{
                    "@@type": "City",
                    "name": "Bandung"
                },
                {
                    "@@type": "State",
                    "name": "Jawa Barat"
                },
                {
                    "@@type": "Country",
                    "name": "Indonesia"
                }
            ],
            "priceRange": "Rp 2.000.000 - Rp 50.000.000",
            "currenciesAccepted": "IDR",
            "paymentAccepted": "Cash, Bank Transfer",
            "openingHoursSpecification": [{
                    "@@type": "OpeningHoursSpecification",
                    "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
                    "opens": "08:00",
                    "closes": "17:00"
                },
                {
                    "@@type": "OpeningHoursSpecification",
                    "dayOfWeek": "Saturday",
                    "opens": "08:00",
                    "closes": "15:00"
                }
            ],
            "sameAs": [
                "{{ $settings['instagram_url'] ?? 'https://instagram.com/homeputrainterior' }}",
                "{{ $settings['facebook_url'] ?? 'https://facebook.com/homeputrainterior' }}"
            ],
            "hasOfferCatalog": {
                "@@type": "OfferCatalog",
                "name": "Layanan Desain Interior",
                "itemListElement": [{
                        "@@type": "Offer",
                        "itemOffered": {
                            "@@type": "Service",
                            "name": "Kitchen Set Custom",
                            "description": "Jasa pembuatan kitchen set custom dengan berbagai material premium"
                        }
                    },
                    {
                        "@@type": "Offer",
                        "itemOffered": {
                            "@@type": "Service",
                            "name": "Lemari & Wardrobe Custom",
                            "description": "Pembuatan lemari pakaian dan wardrobe custom sesuai kebutuhan"
                        }
                    },
                    {
                        "@@type": "Offer",
                        "itemOffered": {
                            "@@type": "Service",
                            "name": "Backdrop TV",
                            "description": "Desain dan pembuatan backdrop TV minimalis modern"
                        }
                    },
                    {
                        "@@type": "Offer",
                        "itemOffered": {
                            "@@type": "Service",
                            "name": "Wallpanel",
                            "description": "Pemasangan wallpanel estetik untuk interior rumah dan kantor"
                        }
                    }
                ]
            },
            "aggregateRating": {
                "@@type": "AggregateRating",
                "ratingValue": "4.9",
                "reviewCount": "500",
                "bestRating": "5",
                "worstRating": "1"
            }
        }
    </script>

    {{-- BreadcrumbList Schema (Dynamic) --}}
    @hasSection('breadcrumb_schema')
    @yield('breadcrumb_schema')
    @endif

    {{-- Tailwind CSS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Fonts (Preconnect for Performance) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,500;1,600&family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/css/fonts.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/material-symbols.css') }}" rel="stylesheet" media="print" onload="this.onload=null;this.media='all'" />
    <noscript><link rel="stylesheet" href="{{ asset('assets/css/material-symbols.css') }}"></noscript>
    <link href="{{ asset('assets/css/aos.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" />

    @stack('styles')
</head>

<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-white antialiased overflow-x-hidden transition-colors duration-300">

    {{-- Preloader --}}
    <div id="preloader" class="fixed inset-0 z-100 bg-background-dark flex items-center justify-center transition-opacity duration-500">
        <div class="text-center">
            <div class="relative w-24 h-24 mx-auto mb-6">
                <div class="absolute inset-0 border-4 border-primary/20 rounded-full"></div>
                <div class="absolute inset-0 border-4 border-transparent border-t-primary rounded-full animate-spin"></div>
                <svg class="w-10 h-10 text-primary absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 3L4 9v12h5v-7h6v7h5V9l-8-6z"></path>
                </svg>
            </div>
            <p class="text-gray-400 text-sm uppercase tracking-widest">Memuat...</p>
        </div>
    </div>

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

    <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '6281809939681' }}?text={{ urlencode('Halo Home Putra Interior, saya tertarik dengan layanan desain interior Anda.') }}"
        target="_blank"
        rel="noopener noreferrer"
        class="fixed bottom-6 right-6 z-50 group"
        aria-label="Chat via WhatsApp">
        <div class="relative flex items-center justify-center">
            {{-- Animasi Denyut (Pulse) --}}
            <div class="absolute inset-0 bg-green-500 rounded-full animate-ping opacity-30"></div>

            {{-- Tombol Utama --}}
            <div class="relative w-14 h-14 bg-[#25D366] hover:bg-[#20BD5A] rounded-full flex items-center justify-center shadow-lg shadow-green-500/40 hover:scale-110 transition-all duration-300">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                </svg>
            </div>

            {{-- Tooltip --}}
            <span class="absolute right-full mr-4 bg-white text-gray-800 text-xs font-bold px-3 py-2 rounded-lg shadow-xl opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none">
                Hubungi Kami di WhatsApp
            </span>
        </div>
    </a>

    {{-- Scripts --}}
    <script defer src="{{ asset('assets/js/aos.min.js') }}"></script>
    <script defer src="{{ asset('assets/js/main.js') }}"></script>
    <script>
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

        // Preloader Optimization (LCP Fix)
        document.addEventListener('DOMContentLoaded', () => {
             const preloader = document.getElementById('preloader');
             // Small delay to ensure CSS critical path is painted
             setTimeout(() => {
                 preloader.style.opacity = '0';
                 preloader.style.pointerEvents = 'none'; // Immediately unblock interaction
                 setTimeout(() => {
                     preloader.style.display = 'none';
                 }, 500);
             }, 100); 
        });
    </script>

    @stack('scripts')
</body>

</html>