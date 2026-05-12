{{--
    NAVBAR - Premium Edition
    Version: 7.0 (Hero-Aware Light/Dark Mode)
--}}

<style>
    /* Base navbar */
    .god-nav {
        opacity: 1 !important;
        visibility: visible !important;
    }

    /* ═══════════════════════════════════════
       HERO-AWARE MODE (Dark text on hero)
       When navbar is on top of the dark hero,
       force light text regardless of theme
       ═══════════════════════════════════════ */
    .god-nav.nav-on-hero:not(.scrolled) {
        background-color: transparent !important;
        border-bottom-color: transparent !important;
        box-shadow: none !important;
    }

    .god-nav.nav-on-hero:not(.scrolled) .nav-link,
    .god-nav.nav-on-hero:not(.scrolled) .nav-logo-text {
        color: rgba(255, 255, 255, 0.85) !important;
    }

    .god-nav.nav-on-hero:not(.scrolled) .nav-link:hover,
    .god-nav.nav-on-hero:not(.scrolled) .nav-logo-text:hover {
        color: #ffffff !important;
    }

    .god-nav.nav-on-hero:not(.scrolled) .nav-logo-accent {
        color: #ffb204 !important;
    }

    .god-nav.nav-on-hero:not(.scrolled) .nav-cta {
        background: #ffffff;
        color: #000000;
    }

    .god-nav.nav-on-hero:not(.scrolled) .nav-cta:hover {
        background: #ffb204;
    }

    .god-nav.nav-on-hero:not(.scrolled) .theme-toggle {
        background-color: rgba(28, 22, 14, 0.45) !important;
        border-color: rgba(255, 255, 255, 0.25) !important;
        color: #ffffff !important;
    }

    .god-nav.nav-on-hero:not(.scrolled) .theme-toggle:hover {
        background-color: rgba(255, 255, 255, 0.15) !important;
    }

    .god-nav.nav-on-hero:not(.scrolled) .mobile-toggle-btn {
        background-color: rgba(0, 0, 0, 0.2) !important;
        border-color: rgba(255, 255, 255, 0.12) !important;
    }

    .god-nav.nav-on-hero:not(.scrolled) .mobile-toggle-btn span {
        background-color: #ffffff !important;
    }

    .god-nav.nav-on-hero:not(.scrolled) .nav-logo-box {
        background-color: rgba(255, 255, 255, 0.09) !important;
        border-color: rgba(255, 255, 255, 0.1) !important;
    }

    /* ═══════════════════════════════════════
       DARK MODE - Scrolled State
       ═══════════════════════════════════════ */
    html.dark .god-nav.scrolled {
        background-color: rgba(10, 12, 16, 0.98);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
    }

    html.dark .god-nav .nav-link {
        color: rgba(209, 213, 219, 1);
    }

    html.dark .god-nav .nav-link:hover {
        color: #ffffff;
    }

    html.dark .god-nav .nav-logo-text {
        color: #ffffff;
    }

    html.dark .god-nav .nav-cta {
        background: #ffffff;
        color: #000000;
    }

    html.dark .god-nav .nav-cta:hover {
        background: #ffb204;
        transform: scale(1.05);
    }

    html.dark .god-nav .nav-logo-box {
        background-color: rgba(255, 255, 255, 0.06);
        border-color: rgba(255, 255, 255, 0.1);
    }

    /* ═══════════════════════════════════════
       LIGHT MODE - Normal State
       ═══════════════════════════════════════ */
    html:not(.dark) .god-nav .nav-link {
        color: #465568;
    }

    html:not(.dark) .god-nav .nav-link:hover {
        color: #151a20;
    }

    html:not(.dark) .god-nav .nav-logo-text {
        color: #151a20;
    }

    html:not(.dark) .god-nav .nav-cta {
        background: #151a20;
        color: #ffffff;
    }

    html:not(.dark) .god-nav .nav-cta:hover {
        background: #ffb204;
        color: #000000;
        transform: scale(1.05);
    }

    html:not(.dark) .god-nav .theme-toggle {
        background-color: rgba(255, 255, 255, 0.82);
        border-color: rgba(90, 74, 48, 0.14);
        color: #151a20;
    }

    html:not(.dark) .god-nav .theme-toggle:hover {
        background-color: #ffffff;
        border-color: rgba(255, 178, 4, 0.55);
    }

    html:not(.dark) .god-nav .mobile-toggle-btn {
        background-color: rgba(21, 26, 32, 0.06);
        border-color: rgba(90, 74, 48, 0.14);
    }

    html:not(.dark) .god-nav .mobile-toggle-btn span {
        background-color: #151a20;
    }

    html:not(.dark) .god-nav .nav-logo-box {
        background-color: rgba(21, 26, 32, 0.06);
        border-color: rgba(90, 74, 48, 0.14);
    }

    html:not(.dark) .god-nav .nav-dropdown-chevron {
        color: #657084;
    }

    html:not(.dark) .god-nav:not(.nav-on-hero),
    html:not(.dark) .god-nav.scrolled {
        background-color: oklch(98.8% 0.003 106.5 / 0.94) !important;
        border-bottom: 1px solid rgba(90, 74, 48, 0.14) !important;
        backdrop-filter: blur(18px);
        -webkit-backdrop-filter: blur(18px);
        box-shadow: 0 16px 48px rgba(84, 64, 32, 0.12);
    }

    html:not(.dark) .god-nav:not(.nav-on-hero) .nav-link,
    html:not(.dark) .god-nav.scrolled .nav-link {
        color: #465568 !important;
    }

    html:not(.dark) .god-nav:not(.nav-on-hero) .nav-link:hover,
    html:not(.dark) .god-nav.scrolled .nav-link:hover {
        color: #151a20 !important;
    }

    html:not(.dark) .god-nav:not(.nav-on-hero) .nav-logo-text,
    html:not(.dark) .god-nav.scrolled .nav-logo-text {
        color: #151a20 !important;
    }

    html:not(.dark) .god-nav:not(.nav-on-hero) .nav-cta,
    html:not(.dark) .god-nav.scrolled .nav-cta {
        background: #151a20 !important;
        color: #ffffff !important;
    }

    /* Hide navbar on scroll down */
    .god-nav.nav-hidden {
        transform: translateY(-100%);
    }

    /* ═══════════════════════════════════════
       DROPDOWN
       ═══════════════════════════════════════ */
    .god-dropdown {
        display: none;
        transform-origin: top center;
        animation: simpleFadeIn 0.2s ease forwards;
    }

    @keyframes simpleFadeIn {
        from {
            opacity: 0;
            transform: translate(-50%, 10px);
        }

        to {
            opacity: 1;
            transform: translate(-50%, 0);
        }
    }

    @media (min-width: 1024px) {
        .group:hover .god-dropdown,
        .group:focus-within .god-dropdown,
        .group.dropdown-open .god-dropdown {
            display: block;
        }
    }

    /* Dark mode dropdown */
    html.dark .god-dropdown {
        background-color: #0A0C10;
        border-color: rgba(255, 255, 255, 0.05);
    }

    /* Light mode dropdown */
    html:not(.dark) .god-dropdown {
        background-color: rgba(255, 255, 252, 0.96) !important;
        border-color: rgba(90, 74, 48, 0.14) !important;
        box-shadow: 0 20px 60px rgba(84, 64, 32, 0.12);
    }

    html:not(.dark) .god-dropdown .dd-category-label {
        color: #7d8797;
    }

    html:not(.dark) .god-dropdown .dd-item-title {
        color: #151a20;
    }

    html:not(.dark) .god-dropdown .dd-item-desc {
        color: #7d8797;
    }

    html:not(.dark) .god-dropdown .dd-item:hover {
        background-color: rgba(21, 26, 32, 0.04);
        border-color: rgba(90, 74, 48, 0.1);
    }

    html:not(.dark) .god-dropdown .dd-icon {
        color: #7d8797;
    }

    html:not(.dark) .god-dropdown .dd-item:hover .dd-icon {
        color: #ffb204;
    }

    /* ═══════════════════════════════════════
       MOBILE DRAWER
       ═══════════════════════════════════════ */
    #mobile-drawer {
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        transform: translateX(100%);
        visibility: hidden;
    }

    #mobile-drawer.active {
        transform: translateX(0);
        visibility: visible;
    }

    .mobile-close-btn {
        color: #ffffff;
        background-color: rgba(255, 255, 255, 0.06);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .mobile-close-btn:hover {
        background-color: rgba(255, 255, 255, 0.12);
        color: #ffb204;
    }

    /* Accordion */
    .submenu-content {
        display: none;
    }

    .submenu-content.open {
        display: block;
        animation: slideDown 0.3s ease;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

{{-- NAVBAR WRAPPER --}}
<nav id="main-nav" class="god-nav fixed top-0 w-full z-[1000] transition-all duration-300 bg-transparent h-[76px] flex items-center">
    <div class="max-w-7xl w-full mx-auto px-6 lg:px-8 flex items-center justify-between">

        {{-- LOGO --}}
        <a href="{{ route('home') }}" class="flex items-center gap-3 relative z-[91]">
            <div class="nav-logo-box w-10 h-10 rounded-xl flex items-center justify-center border backdrop-blur-sm transition-all duration-300">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Home Putra Logo" class="w-[120px] h-auto object-contain" width="120" height="120">
            </div>
            <span class="nav-logo-text font-bold text-xl tracking-tight transition-colors duration-300">Home Putra <span class="nav-logo-accent text-primary italic">Interior</span></span>
        </a>

        {{-- DESKTOP MENU --}}
        <div class="hidden lg:flex items-center gap-1 z-[91]">
            <a href="{{ route('home') }}" class="group/link relative px-2 py-2 nav-link font-medium transition-colors duration-300">
                <span>Beranda</span>
                <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary transition-all duration-300 group-hover/link:w-full"></span>
            </a>

            {{-- Service Dropdown --}}
            <div class="relative group h-20 flex items-center px-2" data-services-dropdown>
                <a href="{{ route('services.all') }}" id="services-dropdown-trigger" class="group/link relative flex items-center gap-1 px-2 py-2 nav-link font-medium transition-colors duration-300" aria-haspopup="true" aria-expanded="false" aria-controls="services-dropdown">
                    <span>Layanan</span>
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary transition-all duration-300 group-hover/link:w-full"></span>
                    <svg class="nav-dropdown-chevron w-4 h-4 opacity-70 group-hover/link:rotate-180 transition-transform duration-300" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="m6 9 6 6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>

                {{-- Dropdown Body --}}
                <div id="services-dropdown" class="god-dropdown absolute top-[70px] left-1/2 -translate-x-1/2 w-[600px] border rounded-xl p-6 shadow-2xl backdrop-blur-xl bg-[#0A0C10] border-white/5">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="space-y-1">
                            <h4 class="dd-category-label text-[10px] font-bold text-gray-500 uppercase tracking-[0.2em] px-3 mb-3">Kategori</h4>
                            <a href="{{ route('home') }}#services" class="dd-item flex items-center gap-4 p-3 rounded-lg hover:bg-white/5 transition-all group/item border border-transparent hover:border-white/5">
                                <span class="dd-icon material-symbols-outlined text-gray-500 group-hover/item:text-primary transition-colors">home</span>
                                <div>
                                    <div class="dd-item-title text-white font-bold text-sm group-hover/item:translate-x-1 transition-transform">Residensial</div>
                                    <div class="dd-item-desc text-[10px] text-gray-500">Interior Rumah</div>
                                </div>
                            </a>
                            <a href="{{ route('home') }}#services" class="dd-item flex items-center gap-4 p-3 rounded-lg hover:bg-white/5 transition-all group/item border border-transparent hover:border-white/5">
                                <span class="dd-icon material-symbols-outlined text-gray-500 group-hover/item:text-primary transition-colors">storefront</span>
                                <div>
                                    <div class="dd-item-title text-white font-bold text-sm group-hover/item:translate-x-1 transition-transform">Komersial</div>
                                    <div class="dd-item-desc text-[10px] text-gray-500">Kantor & Usaha</div>
                                </div>
                            </a>
                        </div>
                        <div class="theme-keep-dark relative overflow-hidden rounded-xl border border-white/5 group/card">
                            <img src="{{ asset('assets/images/materials/multipleks-hpl.png') }}" class="absolute inset-0 w-full h-full object-cover opacity-30 transition-transform duration-700 group-hover/card:scale-110" loading="lazy" decoding="async" onerror="this.style.display='none'">
                            <div class="absolute inset-0 bg-linear-to-t from-black via-black/50 to-transparent"></div>
                            <div class="relative p-5 h-full flex flex-col justify-end">
                                <span class="bg-primary text-black text-[9px] font-bold px-2 py-1 rounded w-fit uppercase mb-2">Unggulan</span>
                                <h3 class="text-white font-serif text-lg mb-1 italic">Luxury Wood</h3>
                                <a href="{{ route('portfolio.all') }}" class="text-white text-xs font-bold uppercase hover:text-primary transition-colors flex items-center gap-2 mt-2">
                                    Jelajahi
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path d="M5 12h14m-6-6 6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <a href="{{ route('portfolio.all') }}" class="group/link relative px-2 py-2 nav-link font-medium transition-colors duration-300">
                <span>Portofolio</span>
                <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary transition-all duration-300 group-hover/link:w-full"></span>
            </a>

            <a href="{{ route('home') }}#testimonials" class="group/link relative px-2 py-2 nav-link font-medium transition-colors duration-300">
                <span>Testimoni</span>
                <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary transition-all duration-300 group-hover/link:w-full"></span>
            </a>
        </div>

        {{-- CTA & Toggle --}}
        <div class="flex items-center gap-4 relative z-[91]">
            <button type="button" data-theme-toggle class="theme-toggle hidden lg:inline-flex h-10 items-center gap-2 rounded-full border px-3.5 text-sm font-semibold transition-all duration-300" aria-label="Ganti tema" aria-pressed="false">
                <span data-theme-label>Dark</span>
            </button>

            <a href="{{ route('home') }}#contact" class="nav-cta hidden lg:flex min-h-10 items-center px-6 rounded-full font-medium tracking-wide text-sm transition-all duration-300 shadow-lg">
                Konsultasi
            </a>

            <button id="mobile-toggle" aria-label="Buka Menu Navigasi" aria-expanded="false" aria-controls="mobile-drawer" class="mobile-toggle-btn lg:hidden w-12 h-12 flex flex-col justify-center items-end gap-1.5 p-2 group rounded-lg backdrop-blur-sm border transition-all duration-300">
                <span class="w-6 h-0.5 transition-all duration-300 block"></span>
                <span class="w-4 h-0.5 transition-all duration-300 block group-hover:w-6 uppercase"></span>
                <span class="w-6 h-0.5 transition-all duration-300 block"></span>
            </button>
        </div>
    </div>
</nav>

{{-- MOBILE DRAWER (Always dark themed) --}}
<div id="mobile-drawer" class="theme-keep-dark fixed inset-0 z-[99990] bg-[#050505] pt-24 px-6 flex flex-col overflow-y-auto" role="dialog" aria-modal="true" aria-label="Menu navigasi" aria-hidden="true">
    {{-- Decorative BG --}}
    <div class="absolute top-0 right-0 w-[80%] h-[50%] bg-primary/5 blur-[80px] rounded-full pointer-events-none"></div>

    <button type="button" id="mobile-close" class="mobile-close-btn absolute right-5 top-5 z-20 inline-flex h-12 w-12 items-center justify-center rounded-full transition-colors" aria-label="Tutup menu navigasi">
        <span class="material-symbols-outlined text-2xl">close</span>
    </button>

    <div class="flex flex-col gap-0 relative z-10 w-full">
        <a href="{{ route('home') }}" class="block w-full py-4 text-2xl font-bold text-white border-b border-white/5 hover:text-primary transition-colors">
            Beranda
        </a>

        {{-- Accordion Group --}}
        <div class="border-b border-white/5">
            <button type="button" class="submenu-trigger w-full flex items-center justify-between py-4 text-2xl font-bold text-white hover:text-primary transition-colors" aria-expanded="false" aria-controls="mobile-services-submenu">
                Layanan
                <svg class="mic-icon w-6 h-6 text-white/30 transition-transform duration-300" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="m6 9 6 6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
            <div id="mobile-services-submenu" class="submenu-content pl-4 pb-4">
                <div class="flex flex-col gap-3 pl-4 border-l border-white/10">
                    <a href="{{ route('services.all') }}" class="text-lg text-gray-400 hover:text-white">Semua Layanan</a>
                    <a href="{{ route('home') }}#services" class="text-lg text-gray-400 hover:text-white">Residensial</a>
                    <a href="{{ route('home') }}#services" class="text-lg text-gray-400 hover:text-white">Komersial</a>
                </div>
            </div>
        </div>

        <a href="{{ route('portfolio.all') }}" class="block w-full py-4 text-2xl font-bold text-white border-b border-white/5 hover:text-primary transition-colors">
            Portofolio
        </a>
        <a href="{{ route('home') }}#contact" class="block w-full py-4 text-2xl font-bold text-white border-b border-white/5 hover:text-primary transition-colors">
            Kontak
        </a>
    </div>

    {{-- Footer --}}
    <div class="mt-8 mb-12">
        <button type="button" data-theme-toggle class="theme-toggle mb-4 flex w-full items-center justify-center gap-2 rounded-xl border border-white/10 bg-white/5 text-white px-5 py-3 font-bold transition-all" aria-label="Ganti tema" aria-pressed="false">
            <span data-theme-label>Dark</span>
        </button>

        <a href="{{ route('home') }}#contact" class="block w-full py-4 rounded-xl bg-primary text-black font-bold text-center text-lg uppercase tracking-wider mb-8 shadow-lg shadow-primary/20">
            Mulai Konsultasi
        </a>
        <div class="flex justify-center gap-8 text-white/50" aria-hidden="true">
            <span class="material-symbols-outlined text-2xl">mail</span>
            <span class="material-symbols-outlined text-2xl">call</span>
            <span class="material-symbols-outlined text-2xl">chat</span>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const toggle = document.getElementById('mobile-toggle');
        const closeButton = document.getElementById('mobile-close');
        const drawer = document.getElementById('mobile-drawer');
        const overlay = document.getElementById('mobile-menu-overlay');
        const spans = toggle.querySelectorAll('span');
        const nav = document.getElementById('main-nav');
        let isOpen = false;
        let previousFocusedElement = null;

        const focusableSelector = [
            'a[href]',
            'button:not([disabled])',
            'input:not([disabled])',
            'textarea:not([disabled])',
            'select:not([disabled])',
            '[tabindex]:not([tabindex="-1"])'
        ].join(',');

        function getDrawerFocusableElements() {
            return Array.from(drawer.querySelectorAll(focusableSelector))
                .filter((element) => element.offsetParent !== null);
        }

        // ═══════════════════════════════════════
        // Hero-aware detection: check if we're on
        // a page with a dark hero section
        // ═══════════════════════════════════════
        const heroEl = document.getElementById('hero')
            || document.getElementById('portfolio-hero')
            || document.querySelector('[data-nav-hero]');

        function updateHeroAwareness() {
            if (!heroEl) {
                nav.classList.remove('nav-on-hero');
                return;
            }

            const heroRect = heroEl.getBoundingClientRect();
            const navHeight = nav.offsetHeight;

            // If the navbar overlaps the hero, add .nav-on-hero
            if (heroRect.bottom > navHeight * 0.5) {
                nav.classList.add('nav-on-hero');
            } else {
                nav.classList.remove('nav-on-hero');
            }
        }

        // Initial check
        if (window.scrollY > 10) nav.classList.add('scrolled');
        updateHeroAwareness();

        function setDrawer(open) {
            isOpen = open;

            if (isOpen) {
                previousFocusedElement = document.activeElement;
                drawer.classList.add('active');
                drawer.setAttribute('aria-hidden', 'false');
                toggle.setAttribute('aria-expanded', 'true');
                toggle.setAttribute('aria-label', 'Tutup Menu Navigasi');
                document.body.style.overflow = 'hidden';
                overlay?.classList.remove('hidden');
                window.requestAnimationFrame(() => {
                    overlay?.classList.remove('opacity-0');
                    closeButton?.focus();
                });

                // Burger Animation X
                spans[0].style.transform = 'rotate(45deg) translate(6px, 6px)';
                spans[1].style.opacity = '0';
                spans[2].style.transform = 'rotate(-45deg) translate(5px, -5px)';
                spans[1].style.width = '0px';
            } else {
                drawer.classList.remove('active');
                drawer.setAttribute('aria-hidden', 'true');
                toggle.setAttribute('aria-expanded', 'false');
                toggle.setAttribute('aria-label', 'Buka Menu Navigasi');
                document.body.style.overflow = '';
                overlay?.classList.add('opacity-0');
                window.setTimeout(() => {
                    if (!isOpen) overlay?.classList.add('hidden');
                }, 300);

                // Reset Burger
                spans[0].style.transform = 'none';
                spans[1].style.opacity = '1';
                spans[1].style.width = '16px';
                spans[2].style.transform = 'none';

                if (previousFocusedElement instanceof HTMLElement) {
                    previousFocusedElement.focus();
                }
            }
        }

        // Toggle Drawer
        toggle.addEventListener('click', () => {
            setDrawer(!isOpen);
        });

        closeButton?.addEventListener('click', () => {
            setDrawer(false);
        });

        overlay?.addEventListener('click', () => {
            setDrawer(false);
        });

        document.addEventListener('keydown', (event) => {
            if (!isOpen) return;

            if (event.key === 'Escape') {
                event.preventDefault();
                setDrawer(false);
                return;
            }

            if (event.key !== 'Tab') return;

            const focusableElements = getDrawerFocusableElements();
            const firstElement = focusableElements[0];
            const lastElement = focusableElements[focusableElements.length - 1];

            if (!firstElement || !lastElement) {
                event.preventDefault();
                return;
            }

            if (event.shiftKey && document.activeElement === firstElement) {
                event.preventDefault();
                lastElement.focus();
            } else if (!event.shiftKey && document.activeElement === lastElement) {
                event.preventDefault();
                firstElement.focus();
            }
        });

        // Accordion JS
        const triggers = document.querySelectorAll('.submenu-trigger');
        triggers.forEach(btn => {
            btn.addEventListener('click', () => {
                const content = btn.nextElementSibling;
                const icon = btn.querySelector('.mic-icon');

                content.classList.toggle('open');
                if (content.classList.contains('open')) {
                    btn.setAttribute('aria-expanded', 'true');
                    icon.style.transform = 'rotate(180deg)';
                    icon.style.color = '#ffb204';
                } else {
                    btn.setAttribute('aria-expanded', 'false');
                    icon.style.transform = 'rotate(0deg)';
                    icon.style.color = '';
                }
            });
        });

        // Close on Link Click
        drawer.querySelectorAll('a:not(.submenu-trigger)').forEach(link => {
            link.addEventListener('click', () => {
                setDrawer(false);
            });
        });

        document.querySelectorAll('[data-services-dropdown]').forEach((dropdown) => {
            const trigger = dropdown.querySelector('#services-dropdown-trigger');
            const setExpanded = (expanded) => {
                dropdown.classList.toggle('dropdown-open', expanded);
                trigger?.setAttribute('aria-expanded', expanded ? 'true' : 'false');
            };

            dropdown.addEventListener('mouseenter', () => setExpanded(true));
            dropdown.addEventListener('mouseleave', () => setExpanded(false));
            dropdown.addEventListener('focusin', () => setExpanded(true));
            dropdown.addEventListener('focusout', () => {
                window.setTimeout(() => {
                    if (!dropdown.contains(document.activeElement)) {
                        setExpanded(false);
                    }
                }, 0);
            });
            dropdown.addEventListener('keydown', (event) => {
                if (event.key !== 'Escape') return;

                event.preventDefault();
                setExpanded(false);
                trigger?.focus();
            });
        });

        // ═══════════════════════════════════════
        // Scroll Effects
        // ═══════════════════════════════════════
        let lastScrollY = 0;
        let ticking = false;

        window.addEventListener('scroll', () => {
            if (!ticking) {
                window.requestAnimationFrame(() => {
                    const currentY = window.scrollY;

                    // Scrolled background
                    if (currentY > 10) nav.classList.add('scrolled');
                    else nav.classList.remove('scrolled');

                    updateHeroAwareness();

                    // Hide/show on direction (only after 80px, skip if mobile drawer open)
                    if (!isOpen) {
                        if (currentY > 80 && currentY > lastScrollY) {
                            nav.classList.add('nav-hidden');
                        } else {
                            nav.classList.remove('nav-hidden');
                        }
                    }

                    lastScrollY = currentY;
                    ticking = false;
                });
                ticking = true;
            }
        }, { passive: true });

        window.addEventListener('resize', updateHeroAwareness, { passive: true });
    });
</script>
