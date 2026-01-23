{{-- Services Section - Premium Responsive Design --}}

<section class="py-20 sm:py-28 md:py-36 bg-background-dark relative overflow-hidden" id="services">
    {{-- Background Elements --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-[20%] -left-[10%] w-[600px] h-[600px] bg-primary/5 blur-[150px] rounded-full"></div>
        <div class="absolute bottom-[20%] -right-[10%] w-[500px] h-[500px] bg-blue-500/5 blur-[150px] rounded-full"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        {{-- Header --}}
        <div class="text-center mb-16 sm:mb-20 px-4" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-primary/10 border border-primary/20 rounded-full mb-6">
                <span class="w-1.5 h-1.5 bg-primary rounded-full animate-pulse"></span>
                <span class="text-primary text-[10px] sm:text-xs font-bold uppercase tracking-[0.2em]">Layanan Kami</span>
            </div>
            <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl text-white font-serif mb-6 leading-tight">
                Solusi Interior <span class="text-primary italic">Lengkap</span>
            </h2>
            <p class="text-gray-400 max-w-2xl mx-auto text-sm sm:text-base md:text-lg font-light leading-relaxed">
                Dari konsep hingga realisasi, kami menghadirkan keahlian desain interior premium untuk mewujudkan ruang impian Anda.
            </p>
        </div>

        {{-- Services Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-20">
            @forelse($services as $index => $service)
            <div class="group relative h-full" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                <div class="relative h-full p-6 sm:p-8 bg-white/5 border border-white/10 rounded-2xl overflow-hidden hover:bg-white/8 hover:border-primary/30 transition-all duration-300">

                    {{-- Icon Background --}}
                    <div class="absolute top-0 right-0 w-32 h-32 bg-linear-to-br from-primary/10 to-transparent rounded-bl-[100px] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                    {{-- Icon --}}
                    <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-xl bg-primary/10 flex items-center justify-center mb-6 group-hover:scale-110 group-hover:bg-primary group-hover:text-black transition-all duration-300">
                        <span class="material-symbols-outlined text-primary text-2xl sm:text-3xl group-hover:text-black transition-colors">{{ $service->icon ?? 'design_services' }}</span>
                    </div>

                    {{-- Content --}}
                    <h3 class="text-xl text-white font-bold mb-3 group-hover:text-primary transition-colors">{{ $service->title }}</h3>
                    <p class="text-gray-400 text-sm leading-relaxed mb-6 group-hover:text-gray-300">
                        {{ $service->description }}
                    </p>

                    {{-- Link --}}
                    <div class="mt-auto inline-flex items-center gap-2 text-primary text-xs font-bold uppercase tracking-widest group-hover:gap-3 transition-all">
                        <span>Selengkapnya</span>
                        <span class="material-symbols-outlined text-base">arrow_forward</span>
                    </div>
                </div>
            </div>
            @empty
            {{-- Fallbacks --}}
            @foreach([
            ['title' => 'Residential', 'desc' => 'Desain rumah tinggal yang nyaman dan fungsional.', 'icon' => 'home'],
            ['title' => 'Commercial', 'desc' => 'Ruang usaha yang menarik dan meningkatkan produktivitas.', 'icon' => 'storefront'],
            ['title' => 'Custom Furniture', 'desc' => 'Furniture unik yang disesuaikan dengan kebutuhan ruang.', 'icon' => 'chair'],
            ['title' => 'Consultation', 'desc' => 'Diskusi mendalam untuk menemukan solusi terbaik.', 'icon' => 'chat']
            ] as $idx => $s)
            <div class="group relative h-full" data-aos="fade-up" data-aos-delay="{{ $idx * 100 }}">
                <div class="relative h-full p-6 sm:p-8 bg-white/5 border border-white/10 rounded-2xl overflow-hidden hover:bg-white/8 hover:border-primary/30 transition-all duration-300">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-linear-to-br from-primary/10 to-transparent rounded-bl-[100px] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                    <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-xl bg-primary/10 flex items-center justify-center mb-6 group-hover:scale-110 group-hover:bg-primary group-hover:text-black transition-all duration-300">
                        <span class="material-symbols-outlined text-primary text-2xl sm:text-3xl group-hover:text-black transition-colors">{{ $s['icon'] }}</span>
                    </div>

                    <h3 class="text-xl text-white font-bold mb-3 group-hover:text-primary transition-colors">{{ $s['title'] }}</h3>
                    <p class="text-gray-400 text-sm leading-relaxed mb-6 group-hover:text-gray-300">{{ $s['desc'] }}</p>

                    <div class="mt-auto inline-flex items-center gap-2 text-primary text-xs font-bold uppercase tracking-widest group-hover:gap-3 transition-all">
                        <span>Selengkapnya</span>
                        <span class="material-symbols-outlined text-base">arrow_forward</span>
                    </div>
                </div>
            </div>
            @endforeach
            @endforelse
        </div>

        {{-- Process Steps --}}
        <div class="relative pt-10 border-t border-white/10" data-aos="fade-up">
            <div class="text-center mb-12">
                <span class="text-primary text-xs font-bold uppercase tracking-widest">Workflow</span>
                <h3 class="text-2xl sm:text-3xl text-white font-serif mt-2">Proses Pengerjaan</h3>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 relative">
                {{-- Connector Line (Desktop) --}}
                <div class="hidden lg:block absolute top-8 left-[12%] right-[12%] h-[2px] bg-white/10 z-0"></div>

                @foreach([
                ['num' => '01', 'title' => 'Konsultasi', 'icon' => 'forum'],
                ['num' => '02', 'title' => 'Desain', 'icon' => 'architecture'],
                ['num' => '03', 'title' => 'Produksi', 'icon' => 'construction'],
                ['num' => '04', 'title' => 'Instalasi', 'icon' => 'check_circle']
                ] as $step)
                <div class="relative z-10 flex flex-col items-center text-center group">
                    <div class="w-16 h-16 rounded-full bg-background-dark border-2 border-white/10 flex items-center justify-center mb-4 group-hover:border-primary group-hover:shadow-[0_0_20px_rgba(255,178,4,0.3)] transition-all duration-300">
                        <span class="material-symbols-outlined text-gray-400 group-hover:text-primary transition-colors">{{ $step['icon'] }}</span>
                    </div>
                    <span class="text-primary text-xs font-bold mb-1">{{ $step['num'] }}</span>
                    <h4 class="text-white font-bold">{{ $step['title'] }}</h4>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>