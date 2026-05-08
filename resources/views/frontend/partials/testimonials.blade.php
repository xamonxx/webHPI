{{--
    TESTIMONIALS SECTION - CAROUSEL WITH NAVIGATION
    Features: Responsive Slider, Snap Scroll, Glassmorphic Navigation
--}}

<section class="py-20 md:py-32 bg-background-dark relative overflow-hidden" id="testimonials">
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
                <button onclick="scrollTestimonials('left')" class="w-12 h-12 rounded-full border border-white/10 bg-white/5 hover:bg-white/10 flex items-center justify-center text-white transition-all hover:scale-110 active:scale-95 group" aria-label="Previous">
                    <span class="material-symbols-outlined group-hover:-translate-x-0.5 transition-transform">arrow_back</span>
                </button>
                <button onclick="scrollTestimonials('right')" class="w-12 h-12 rounded-full border border-white/10 bg-primary/10 hover:bg-primary flex items-center justify-center text-primary hover:text-black transition-all hover:scale-110 active:scale-95 group" aria-label="Next">
                    <svg class="w-5 h-5 group-hover:translate-x-0.5 transition-transform" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M5 12h14m-6-6 6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
        </div>

        @if(isset($testimonials) && $testimonials->count() > 0)
        {{-- Carousel Container --}}
        <div class="relative -mx-4 px-4 sm:mx-0 sm:px-0">
            <div class="flex overflow-x-auto snap-x snap-mandatory gap-5 pb-8 pt-8 scrollbar-hide" id="testimonials-container" style="scroll-behavior: smooth;">
                @foreach($testimonials as $key => $t)
                <div class="snap-center shrink-0 w-[280px] sm:w-[350px] md:w-[400px] h-full group" data-aos="fade-up" data-aos-delay="{{ $key * 50 }}">
                    <div class="h-full bg-white/[0.02] backdrop-blur-xl border border-white/10 p-7 sm:p-10 rounded-3xl relative transition-all duration-500 hover:-translate-y-2 hover:bg-white/[0.04] flex flex-col min-h-[280px] sm:min-h-[320px] shadow-2xl shadow-black/40 overflow-hidden">

                        {{-- Large watermark quote --}}
                        <span class="material-symbols-outlined absolute -top-4 -right-2 text-[120px] text-white/5 pointer-events-none group-hover:text-primary/10 transition-colors duration-500">format_quote</span>

                        {{-- Glowing subtle orb in bg --}}
                        <div class="absolute top-0 right-0 w-32 h-32 bg-primary/20 blur-[60px] rounded-full pointer-events-none opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                        {{-- Stars --}}
                        <div class="flex gap-1 mb-6 relative z-10">
                            @for($i = 0; $i < 5; $i++)
                                <span class="material-symbols-outlined text-base text-primary fill-current drop-shadow-[0_0_8px_rgba(255,178,4,0.3)]">star</span>
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
    function scrollTestimonials(direction) {
        const container = document.getElementById('testimonials-container');
        if (!container) return;

        const cardWidth = container.querySelector('.snap-center')?.offsetWidth || 400;
        const scrollAmount = direction === 'left' ? -cardWidth - 20 : cardWidth + 20;

        container.scrollBy({
            left: scrollAmount,
            behavior: 'smooth'
        });
    }
</script>

<style>
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }

    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>
