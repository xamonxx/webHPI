{{--
    GOD-TIER NAVBAR - BULLETPROOF EDITION
    Version: 6.0 (Fix: Always Visible Mobile Items)
--}}

<style>
    /* Prevent FOUC & Ensure Visibility */
    .god-nav {
        opacity: 1 !important;
        visibility: visible !important;
    }

    /* Desktop Scrolled State */
    .god-nav.scrolled {
        background-color: rgba(10, 12, 16, 0.98);
        /* Lebih solid */
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
    }

    /* Dropdown CSS - Simple & Reliable */
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
        .group:hover .god-dropdown {
            display: block;
        }
    }

    /* Mobile Drawer - Transform Only (No Opacity Tricks) */
    #mobile-drawer {
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        transform: translateX(100%);
        visibility: hidden;
        /* Hide when closed */
    }

    #mobile-drawer.active {
        transform: translateX(0);
        visibility: visible;
        /* Show when open */
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
<nav id="main-nav" class="god-nav fixed top-0 w-full z-99999 transition-all duration-300 bg-transparent h-20 flex items-center">
    <div class="max-w-7xl w-full mx-auto px-6 lg:px-8 flex items-center justify-between">

        {{-- LOGO --}}
        <a href="{{ route('home') }}" class="flex items-center gap-3 relative z-100000">
            <div class="w-10 h-10 rounded-xl bg-white/9 flex items-center justify-center border border-white/10 backdrop-blur-sm">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Home Putra Logo" class="w-[120px] h-auto object-contain" width="120" height="120">
            </div>
            <span class="text-white font-bold text-xl tracking-tight">Home Putra <span class="text-primary italic">Interior</span></span>
        </a>

        {{-- DESKTOP MENU --}}
        <div class="hidden lg:flex items-center gap-1 z-100000">

            {{-- Service Dropdown --}}
            <div class="relative group h-20 flex items-center px-2">
                <a href="{{ route('services.all') }}" class="group/link relative flex items-center gap-1 px-2 py-2 text-gray-300 hover:text-white font-medium transition-colors">
                    <span>Layanan</span>
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary transition-all duration-300 group-hover/link:w-full"></span>
                    <span class="material-symbols-outlined text-[18px] opacity-70 group-hover/link:rotate-180 transition-transform duration-300">expand_more</span>
                </a>

                {{-- Dropdown Body --}}
                <div class="god-dropdown absolute top-[70px] left-1/2 -translate-x-1/2 w-[600px] bg-[#0A0C10] border border-white/5 rounded-xl p-6 shadow-2xl backdrop-blur-xl">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="space-y-1">
                            <h4 class="text-[10px] font-bold text-gray-500 uppercase tracking-[0.2em] px-3 mb-3">Kategori</h4>
                            <a href="{{ route('home') }}#services" class="flex items-center gap-4 p-3 rounded-lg hover:bg-white/5 transition-all group/item border border-transparent hover:border-white/5">
                                <span class="material-symbols-outlined text-gray-500 group-hover/item:text-primary transition-colors">home</span>
                                <div>
                                    <div class="text-white font-bold text-sm group-hover/item:translate-x-1 transition-transform">Residensial</div>
                                    <div class="text-[10px] text-gray-500">Interior Rumah</div>
                                </div>
                            </a>
                            <a href="{{ route('home') }}#services" class="flex items-center gap-4 p-3 rounded-lg hover:bg-white/5 transition-all group/item border border-transparent hover:border-white/5">
                                <span class="material-symbols-outlined text-gray-500 group-hover/item:text-primary transition-colors">storefront</span>
                                <div>
                                    <div class="text-white font-bold text-sm group-hover/item:translate-x-1 transition-transform">Komersial</div>
                                    <div class="text-[10px] text-gray-500">Kantor & Usaha</div>
                                </div>
                            </a>
                        </div>
                        <div class="relative overflow-hidden rounded-xl border border-white/5 group/card">
                            <img src="{{ asset('assets/images/materials/multipleks-hpl.png') }}" class="absolute inset-0 w-full h-full object-cover opacity-30 transition-transform duration-700 group-hover/card:scale-110" onerror="this.style.display='none'">
                            <div class="absolute inset-0 bg-linear-to-t from-black via-black/50 to-transparent"></div>
                            <div class="relative p-5 h-full flex flex-col justify-end">
                                <span class="bg-primary text-black text-[9px] font-bold px-2 py-1 rounded w-fit uppercase mb-2">Featured</span>
                                <h3 class="text-white font-serif text-lg mb-1 italic">Luxury Wood</h3>
                                <a href="{{ route('portfolio.all') }}" class="text-white text-xs font-bold uppercase hover:text-primary transition-colors flex items-center gap-2 mt-2">
                                    Explore <span class="material-symbols-outlined text-sm">arrow_forward</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Portfolio Dropdown --}}
            <div class="relative group h-20 flex items-center px-2">
                <a href="{{ route('portfolio.all') }}" class="group/link relative flex items-center gap-1 px-2 py-2 text-gray-300 hover:text-white font-medium transition-colors">
                    <span>Portfolio</span>
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary transition-all duration-300 group-hover/link:w-full"></span>
                    <span class="material-symbols-outlined text-[18px] opacity-70 group-hover/link:rotate-180 transition-transform duration-300">expand_more</span>
                </a>
                <div class="god-dropdown absolute top-[70px] left-1/2 -translate-x-1/2 w-[240px] bg-[#0A0C10] border border-white/5 rounded-xl p-2 shadow-2xl backdrop-blur-xl">
                    <a href="{{ route('portfolio.all') }}" class="block p-3 rounded-lg hover:bg-white/5 text-gray-400 hover:text-white text-sm transition-all hover:pl-4">Semua Proyek</a>
                    <a href="{{ route('home') }}#portfolio" class="block p-3 rounded-lg hover:bg-white/5 text-gray-400 hover:text-white text-sm transition-all hover:pl-4">Living Room</a>
                    <a href="{{ route('home') }}#portfolio" class="block p-3 rounded-lg hover:bg-white/5 text-gray-400 hover:text-white text-sm transition-all hover:pl-4">Kitchen Set</a>
                </div>
            </div>

            <a href="{{ route('home') }}#calculator" class="group/link relative px-2 py-2 text-gray-300 hover:text-white font-medium transition-colors">
                <span>Kalkulator</span>
                <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary transition-all duration-300 group-hover/link:w-full"></span>
            </a>
            <a href="{{ route('home') }}#testimonials" class="group/link relative px-2 py-2 text-gray-300 hover:text-white font-medium transition-colors">
                <span>Testimoni</span>
                <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary transition-all duration-300 group-hover/link:w-full"></span>
            </a>
        </div>

        {{-- CTA & Toggle --}}
        <div class="flex items-center gap-4 relative z-100000">
            <a href="{{ route('home') }}#contact" class="hidden lg:flex px-6 py-2.5 bg-white text-black rounded-full font-bold text-sm hover:bg-primary transition-colors shadow-lg shadow-white/10">
                Konsultasi
            </a>

            <button id="mobile-toggle" aria-label="Buka Menu Navigasi" class="lg:hidden w-12 h-12 flex flex-col justify-center items-end gap-1.5 p-2 group bg-black/20 rounded-lg backdrop-blur-sm border border-white/10">
                <span class="w-6 h-0.5 bg-white transition-all duration-300 block"></span>
                <span class="w-4 h-0.5 bg-white transition-all duration-300 block group-hover:w-6 uppercase"></span>
                <span class="w-6 h-0.5 bg-white transition-all duration-300 block"></span>
            </button>
        </div>
    </div>
</nav>

{{-- MOBILE DRAWER --}}
<div id="mobile-drawer" class="fixed inset-0 z-99990 bg-[#050505] pt-24 px-6 flex flex-col overflow-y-auto">
    {{-- Decorative BG --}}
    <div class="absolute top-0 right-0 w-[80%] h-[50%] bg-primary/5 blur-[80px] rounded-full pointer-events-none"></div>

    <div class="flex flex-col gap-0 relative z-10 w-full">
        <a href="{{ route('home') }}" class="block w-full py-4 text-2xl font-bold text-white border-b border-white/5 hover:text-primary transition-colors">
            Beranda
        </a>

        {{-- Accordion Group --}}
        <div class="border-b border-white/5">
            <button class="submenu-trigger w-full flex items-center justify-between py-4 text-2xl font-bold text-white hover:text-primary transition-colors">
                Layanan
                <span class="mic-icon material-symbols-outlined text-white/30 transition-transform duration-300">expand_more</span>
            </button>
            <div class="submenu-content pl-4 pb-4">
                <div class="flex flex-col gap-3 pl-4 border-l border-white/10">
                    <a href="{{ route('services.all') }}" class="text-lg text-gray-400 hover:text-white">Semua Layanan</a>
                    <a href="{{ route('home') }}#services" class="text-lg text-gray-400 hover:text-white">Residensial</a>
                    <a href="{{ route('home') }}#services" class="text-lg text-gray-400 hover:text-white">Komersial</a>
                </div>
            </div>
        </div>

        <a href="{{ route('portfolio.all') }}" class="block w-full py-4 text-2xl font-bold text-white border-b border-white/5 hover:text-primary transition-colors">
            Portfolio
        </a>
        <a href="{{ route('home') }}#calculator" class="block w-full py-4 text-2xl font-bold text-white border-b border-white/5 hover:text-primary transition-colors">
            Kalkulator
        </a>
        <a href="{{ route('home') }}#contact" class="block w-full py-4 text-2xl font-bold text-white border-b border-white/5 hover:text-primary transition-colors">
            Kontak
        </a>
    </div>

    {{-- Footer --}}
    <div class="mt-8 mb-12">
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
        const drawer = document.getElementById('mobile-drawer');
        const spans = toggle.querySelectorAll('span');
        const nav = document.getElementById('main-nav');
        let isOpen = false;

        // Toggle Drawer
        toggle.addEventListener('click', () => {
            isOpen = !isOpen;
            if (isOpen) {
                drawer.classList.add('active');
                document.body.style.overflow = 'hidden';

                // Burger Animation X
                spans[0].style.transform = 'rotate(45deg) translate(6px, 6px)';
                spans[1].style.opacity = '0';
                spans[2].style.transform = 'rotate(-45deg) translate(5px, -5px)';
                spans[1].style.width = '0px';
            } else {
                drawer.classList.remove('active');
                document.body.style.overflow = '';

                // Reset Burger
                spans[0].style.transform = 'none';
                spans[1].style.opacity = '1';
                spans[1].style.width = '16px';
                spans[2].style.transform = 'none';
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
                    icon.style.transform = 'rotate(180deg)';
                    icon.style.color = '#ffb204';
                } else {
                    icon.style.transform = 'rotate(0deg)';
                    icon.style.color = '';
                }
            });
        });

        // Close on Link Click
        drawer.querySelectorAll('a:not(.submenu-trigger)').forEach(link => {
            link.addEventListener('click', () => {
                if (isOpen) toggle.click();
            });
        });

        // Scroll Effect
        window.addEventListener('scroll', () => {
            if (window.scrollY > 10) nav.classList.add('scrolled');
            else nav.classList.remove('scrolled');
        }, {
            passive: true
        });
    });
</script>