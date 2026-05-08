{{-- Statistics Section - Premium Responsive Design --}}

<section class="border-y border-white/5 bg-[#0d0f14] py-8 sm:py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(isset($statistics) && $statistics->count() > 0)
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8">
            @foreach($statistics as $index => $stat)
            <div class="flex flex-col items-center justify-center text-center gap-1.5 group" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                <div class="flex items-baseline gap-1">
                    <span class="font-serif text-3xl sm:text-4xl md:text-5xl text-white font-medium group-hover:text-primary transition-colors duration-300">
                        <span class="counter" data-target="{{ $stat->stat_number ?? 0 }}">0</span>
                    </span>
                    <span class="text-xl sm:text-2xl text-primary font-serif italic">{{ $stat->stat_suffix ?? '+' }}</span>
                </div>
                <div class="h-[2px] w-8 bg-white/10 group-hover:bg-primary group-hover:w-12 transition-all duration-300 my-1.5"></div>
                <span class="text-[9px] sm:text-[10px] uppercase tracking-[0.2em] font-bold text-gray-400 group-hover:text-gray-200 transition-colors">
                    {{ $stat->stat_label ?? 'Statistik' }}
                </span>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Simple intersection observer for counters
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counters = entry.target.querySelectorAll('.counter');
                    counters.forEach(counter => {
                        const target = parseInt(counter.getAttribute('data-target'));
                        const duration = 2000; // 2 seconds
                        const start = 0;
                        const startTime = performance.now();

                        function update(currentTime) {
                            const elapsed = currentTime - startTime;
                            const progress = Math.min(elapsed / duration, 1);

                            // Ease out quart
                            const ease = 1 - Math.pow(1 - progress, 4);

                            counter.textContent = Math.floor(start + (target - start) * ease);

                            if (progress < 1) {
                                requestAnimationFrame(update);
                            } else {
                                counter.textContent = target;
                            }
                        }
                        requestAnimationFrame(update);
                    });
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.5
        });

        const statsSection = document.querySelector('section.border-y');
        if (statsSection) observer.observe(statsSection);
    });
</script>
