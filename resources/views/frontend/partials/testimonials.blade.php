{{--
    TESTIMONIALS SECTION - CAROUSEL WITH NAVIGATION
    Features: Responsive Slider, Snap Scroll, Glassmorphic Navigation
--}}

<section class="py-20 md:py-32 bg-background-dark relative overflow-x-clip" id="testimonials">
    {{-- Background Atmosphere --}}
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,var(--tw-gradient-stops))] from-primary/5 via-background-dark to-background-dark pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-primary/5 blur-[120px] rounded-full pointer-events-none opacity-50"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 relative z-10">
        {{-- Header Section --}}
        <div class="flex flex-col md:flex-row items-center md:items-end justify-between gap-6 md:gap-8 mb-10 md:mb-16 px-2 text-center md:text-left">
            <div data-aos="fade-right">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full border border-white/10 bg-white/5 backdrop-blur-sm mb-4">
                    <span class="w-1.5 h-1.5 rounded-full bg-primary animate-pulse"></span>
                    <span class="text-[10px] uppercase tracking-[0.2em] text-gray-300 font-bold">Suara Klien</span>
                </div>
                <h2 class="text-3xl md:text-5xl lg:text-5xl text-white font-serif leading-tight">
                    Kepercayaan <span class="text-transparent bg-clip-text bg-linear-to-r from-[#FFD700] to-[#B8860B] italic">Anda</span>
                </h2>
            </div>

            {{-- Navigation Buttons --}}
            <div class="flex gap-3" data-aos="fade-left">
                <button type="button" onclick="scrollTestimonials('left')" class="testimonial-nav-button w-12 h-12 rounded-full border border-white/10 bg-white/5 hover:bg-white/10 flex items-center justify-center text-white transition-all hover:scale-110 active:scale-95 group" aria-label="Previous">
                    <span class="material-symbols-outlined group-hover:-translate-x-0.5 transition-transform">arrow_back</span>
                </button>
                <button type="button" onclick="scrollTestimonials('right')" class="testimonial-nav-button w-12 h-12 rounded-full border border-white/10 bg-primary/10 hover:bg-primary flex items-center justify-center text-primary hover:text-black transition-all hover:scale-110 active:scale-95 group" aria-label="Next">
                    <svg class="w-5 h-5 group-hover:translate-x-0.5 transition-transform" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M5 12h14m-6-6 6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
        </div>

        @if(isset($testimonials) && $testimonials->count() > 0)
        {{-- Carousel Container --}}
        <div class="relative -mx-6 px-6 sm:-mx-8 sm:px-8 lg:-mx-10 lg:px-10 overflow-visible">
            <div class="testimonial-track flex overflow-x-auto overflow-y-visible snap-x snap-mandatory gap-6 md:gap-7 py-10 px-6 sm:py-12 sm:px-8 lg:px-10 scrollbar-hide" id="testimonials-container">
                @foreach($testimonials as $key => $t)
                <div class="snap-center shrink-0 w-[min(82vw,300px)] sm:w-[350px] md:w-[400px] h-full group py-1" data-testimonial-card data-aos="fade-up" data-aos-delay="{{ $key * 50 }}">
                    <div class="testimonial-card h-full bg-white/[0.02] backdrop-blur-xl border border-white/10 p-7 sm:p-10 rounded-3xl relative transition-[transform,box-shadow,background-color,border-color] duration-500 ease-out hover:-translate-y-2 hover:bg-white/[0.04] flex flex-col min-h-[280px] sm:min-h-[320px] shadow-[0_18px_56px_rgba(0,0,0,0.18)] hover:shadow-[0_28px_72px_rgba(0,0,0,0.24)]">

                        {{-- Large watermark quote --}}
                        <span class="material-symbols-outlined absolute -top-4 -right-2 text-[120px] text-white/5 pointer-events-none group-hover:text-primary/10 transition-colors duration-500">format_quote</span>

                        {{-- Glowing subtle orb in bg --}}
                        <div class="absolute top-0 right-0 w-32 h-32 bg-primary/20 blur-[60px] rounded-full pointer-events-none opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                        {{-- Stars --}}
                        <div class="flex gap-1 mb-6 relative z-10">
                            @php($rating = max(0, min(5, (int) ($t->rating ?? 5))))
                            @for($i = 0; $i < 5; $i++)
                                <span class="material-symbols-outlined text-base text-primary fill-current drop-shadow-[0_0_8px_rgba(255,178,4,0.3)] {{ $i < $rating ? '' : 'opacity-30' }}">star</span>
                            @endfor
                        </div>

                        {{-- Testimonial Text --}}
                        <p class="text-gray-300 font-light leading-relaxed mb-8 grow text-sm sm:text-base relative z-10">
                            "{{ $t->testimonial_text ?? '' }}"
                        </p>

                        {{-- Client Info --}}
                        <div class="flex items-center gap-4 pt-4 mt-auto relative z-10">
                            {{-- Avatar --}}
                            <div class="relative">
                                <div class="absolute inset-0 bg-primary/30 blur-md rounded-full opacity-50 group-hover:opacity-100 transition-opacity duration-500"></div>
                                <div class="relative w-12 h-12 rounded-full bg-[#1A1D24] border border-white/10 flex items-center justify-center text-white font-bold font-serif text-lg shrink-0">
                                    {{ substr($t->client_name ?? 'A', 0, 1) }}
                                </div>
                            </div>
                            <div class="min-w-0">
                                <h3 class="text-white font-bold text-sm sm:text-base group-hover:text-primary transition-colors truncate">{{ $t->client_name ?? 'Anonim' }}</h3>
                                <div class="flex items-center gap-1.5 mt-0.5">
                                    <span class="material-symbols-outlined text-[13px] text-primary">verified</span>
                                    <p class="text-[10px] uppercase tracking-widest text-gray-400 truncate">{{ $t->client_location ?? 'Indonesia' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Metrics --}}
        <div class="mt-12 md:mt-24 border-t border-white/5 pt-10 md:pt-16">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-y-10 gap-x-4 text-center">
                <div class="flex flex-col items-center gap-2 group cursor-default" data-aos="fade-up">
                    <span class="text-2xl md:text-4xl text-white font-bold">4.9/5</span>
                    <span class="text-[9px] sm:text-[10px] font-bold text-gray-400 uppercase tracking-widest">Ulasan Google</span>
                </div>
                <div class="flex flex-col items-center gap-2 group cursor-default" data-aos="fade-up" data-aos-delay="50">
                    <span class="text-2xl md:text-4xl text-white font-bold">100%</span>
                    <span class="text-[9px] sm:text-[10px] font-bold text-gray-400 uppercase tracking-widest">Penyelesaian</span>
                </div>
                <div class="flex flex-col items-center gap-2 group cursor-default" data-aos="fade-up" data-aos-delay="100">
                    <span class="text-2xl md:text-4xl text-white font-bold">500+</span>
                    <span class="text-[9px] sm:text-[10px] font-bold text-gray-400 uppercase tracking-widest">Klien Puas</span>
                </div>
                <div class="flex flex-col items-center gap-2 group cursor-default" data-aos="fade-up" data-aos-delay="150">
                    <span class="text-2xl md:text-4xl text-white font-bold">Top 10</span>
                    <span class="text-[9px] sm:text-[10px] font-bold text-gray-400 uppercase tracking-widest">Biro Interior</span>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    (() => {
        const state = window.testimonialCarouselState || {
            raf: null,
            isDragging: false,
            startX: 0,
            startLeft: 0,
        };

        window.testimonialCarouselState = state;

        const easeInOutCubic = (progress) => {
            return progress < 0.5
                ? 4 * progress * progress * progress
                : 1 - Math.pow(-2 * progress + 2, 3) / 2;
        };

        const clamp = (value, min, max) => Math.max(min, Math.min(value, max));

        const getReducedMotion = () => window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        const getCarouselData = () => {
            const container = document.getElementById('testimonials-container');
            if (!container) return null;

            const cards = Array.from(container.querySelectorAll('[data-testimonial-card]'));
            if (!cards.length) return null;

            const maxLeft = Math.max(0, container.scrollWidth - container.clientWidth);
            const containerRect = container.getBoundingClientRect();
            const positions = cards.map((card) => {
                const rect = card.getBoundingClientRect();
                const centeredLeft = container.scrollLeft + (rect.left - containerRect.left) - ((container.clientWidth - rect.width) / 2);

                return clamp(centeredLeft, 0, maxLeft);
            });

            return {
                container,
                cards,
                positions,
                maxLeft,
            };
        };

        const getActiveIndex = (positions, currentLeft) => {
            return positions.reduce((nearestIndex, position, index) => {
                const nearestDistance = Math.abs(positions[nearestIndex] - currentLeft);
                const currentDistance = Math.abs(position - currentLeft);

                return currentDistance < nearestDistance ? index : nearestIndex;
            }, 0);
        };

        const animateScrollTo = (container, targetLeft) => {
            if (state.raf) {
                cancelAnimationFrame(state.raf);
                document.querySelectorAll('.testimonial-track.is-animating').forEach((track) => {
                    track.classList.remove('is-animating');
                });
            }

            const startLeft = container.scrollLeft;
            const distance = targetLeft - startLeft;

            if (getReducedMotion() || Math.abs(distance) < 1) {
                container.scrollLeft = targetLeft;
                state.raf = null;
                return;
            }

            const duration = clamp(Math.abs(distance) * 1.15, 460, 760);
            const startTime = performance.now();

            container.classList.add('is-animating');

            const step = (now) => {
                const progress = clamp((now - startTime) / duration, 0, 1);
                container.scrollLeft = startLeft + distance * easeInOutCubic(progress);

                if (progress < 1) {
                    state.raf = requestAnimationFrame(step);
                    return;
                }

                container.scrollLeft = targetLeft;
                container.classList.remove('is-animating');
                state.raf = null;
            };

            state.raf = requestAnimationFrame(step);
        };

        const scrollToNearestCard = () => {
            const data = getCarouselData();
            if (!data) return;

            const activeIndex = getActiveIndex(data.positions, data.container.scrollLeft);
            animateScrollTo(data.container, data.positions[activeIndex]);
        };

        window.scrollTestimonials = (direction) => {
            const data = getCarouselData();
            if (!data) return;

            const activeIndex = getActiveIndex(data.positions, data.container.scrollLeft);
            const nextIndex = direction === 'left'
                ? clamp(activeIndex - 1, 0, data.cards.length - 1)
                : clamp(activeIndex + 1, 0, data.cards.length - 1);

            animateScrollTo(data.container, data.positions[nextIndex]);
        };

        const initTestimonialDrag = () => {
            const data = getCarouselData();
            if (!data || data.container.dataset.dragReady === 'true') return;

            const { container } = data;
            let hasMoved = false;

            container.dataset.dragReady = 'true';

            container.addEventListener('pointerdown', (event) => {
                if (event.button !== undefined && event.button !== 0) return;

                if (state.raf) {
                    cancelAnimationFrame(state.raf);
                    state.raf = null;
                    container.classList.remove('is-animating');
                }

                state.isDragging = true;
                state.startX = event.clientX;
                state.startLeft = container.scrollLeft;
                hasMoved = false;

                container.classList.add('is-dragging');
                if (event.pointerId !== undefined) {
                    container.setPointerCapture?.(event.pointerId);
                }
            });

            container.addEventListener('pointermove', (event) => {
                if (!state.isDragging) return;

                const delta = event.clientX - state.startX;
                if (Math.abs(delta) > 4) {
                    hasMoved = true;
                }

                container.scrollLeft = state.startLeft - delta;
            });

            const endDrag = (event) => {
                if (!state.isDragging) return;

                state.isDragging = false;
                container.classList.remove('is-dragging');
                if (event.pointerId !== undefined) {
                    container.releasePointerCapture?.(event.pointerId);
                }

                if (hasMoved) {
                    scrollToNearestCard();
                }
            };

            container.addEventListener('pointerup', endDrag);
            container.addEventListener('pointercancel', endDrag);
            container.addEventListener('mouseleave', endDrag);
        };

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initTestimonialDrag, { once: true });
        } else {
            initTestimonialDrag();
        }
    })();
</script>

<style>
    .testimonial-track {
        scroll-behavior: smooth;
        scroll-padding-inline: 1.5rem;
        overscroll-behavior-x: contain;
        touch-action: pan-y;
        cursor: grab;
        user-select: none;
        -webkit-overflow-scrolling: touch;
    }

    .testimonial-card,
    .testimonial-nav-button {
        will-change: transform;
    }

    .testimonial-track.is-dragging,
    .testimonial-track.is-animating {
        cursor: grabbing;
        scroll-behavior: auto;
        scroll-snap-type: none;
    }

    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }

    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    @media (prefers-reduced-motion: reduce) {
        .testimonial-track {
            scroll-behavior: auto;
        }

        .testimonial-card,
        .testimonial-nav-button {
            transition: none !important;
        }
    }
</style>
