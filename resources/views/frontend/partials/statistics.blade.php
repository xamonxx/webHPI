{{-- Statistics Section - Premium Responsive Design --}}

<section class="border-y border-white/5 bg-[#0d0f14] py-12 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 md:gap-12">
            @forelse($statistics as $index => $stat)
            <div class="flex flex-col items-center justify-center text-center gap-2 group" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                <div class="flex items-baseline gap-1">
                    <span class="font-serif text-4xl sm:text-5xl md:text-6xl text-white font-medium group-hover:text-primary transition-colors duration-300">
                        <span class="counter" data-target="{{ $stat->stat_number ?? 0 }}">0</span>
                    </span>
                    <span class="text-2xl sm:text-3xl text-primary font-serif italic">{{ $stat->stat_suffix ?? '+' }}</span>
                </div>
                <div class="h-[2px] w-12 bg-white/10 group-hover:bg-primary group-hover:w-20 transition-all duration-300 my-2"></div>
                <span class="text-[10px] sm:text-xs uppercase tracking-[0.2em] font-bold text-gray-400 group-hover:text-gray-200 transition-colors">
                    {{ $stat->stat_label ?? 'Statistic' }}
                </span>
            </div>
            @empty
            {{-- Fallbacks --}}
            @foreach([
            ['num' => 500, 'suffix' => '+', 'label' => 'Proyek Selesai'],
            ['num' => 12, 'suffix' => 'Th', 'label' => 'Pengalaman'],
            ['num' => 98, 'suffix' => '%', 'label' => 'Kepuasan'],
            ['num' => 25, 'suffix' => '+', 'label' => 'Penghargaan']
            ] as $idx => $s)
            <div class="flex flex-col items-center justify-center text-center gap-2 group" data-aos="fade-up" data-aos-delay="{{ $idx * 100 }}">
                <div class="flex items-baseline gap-1">
                    <span class="font-serif text-4xl sm:text-5xl md:text-6xl text-white font-medium group-hover:text-primary transition-colors duration-300">
                        <span class="counter" data-target="{{ $s['num'] }}">0</span>
                    </span>
                    <span class="text-2xl sm:text-3xl text-primary font-serif italic">{{ $s['suffix'] }}</span>
                </div>
                <div class="h-[2px] w-12 bg-white/10 group-hover:bg-primary group-hover:w-20 transition-all duration-300 my-2"></div>
                <span class="text-[10px] sm:text-xs uppercase tracking-[0.2em] font-bold text-gray-400 group-hover:text-gray-200 transition-colors">
                    {{ $s['label'] }}
                </span>
            </div>
            @endforeach
            @endforelse
        </div>
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