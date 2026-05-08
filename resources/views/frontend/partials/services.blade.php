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

        @if(isset($services) && $services->count() > 0)
        {{-- Services Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-20">
            @foreach($services as $index => $service)
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
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M5 12h14m-6-6 6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        {{-- Process Steps --}}
        <div class="relative pt-20 mt-20 border-t border-white/5" data-aos="fade-up">
            <div class="text-center mb-16">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full border border-white/10 bg-white/5 mb-4">
                    <span class="w-1.5 h-1.5 rounded-full bg-primary animate-pulse"></span>
                    <span class="text-[10px] uppercase tracking-[0.2em] text-gray-300 font-bold">Alur Kerja</span>
                </div>
                <h3 class="text-3xl sm:text-5xl text-white font-serif mt-2">Proses <span class="text-primary italic">Pengerjaan</span></h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8 relative">
                {{-- Connector Line (Desktop) --}}
                <div class="hidden lg:block absolute top-[4.5rem] left-[15%] right-[15%] h-[1px] bg-linear-to-r from-transparent via-white/20 to-transparent z-0"></div>

                @foreach([
                ['num' => '01', 'title' => 'Konsultasi', 'desc' => 'Diskusi mendalam untuk memahami visi, kebutuhan, dan anggaran Anda secara detail.', 'icon' => 'support_agent'],
                ['num' => '02', 'title' => 'Desain 3D', 'desc' => 'Pembuatan layout dan visualisasi 3D fotorealistik untuk persetujuan visual Anda.', 'icon' => 'design_services'],
                ['num' => '03', 'title' => 'Produksi', 'desc' => 'Pengerjaan di workshop kami menggunakan material premium dan tingkat presisi tinggi.', 'icon' => 'precision_manufacturing'],
                ['num' => '04', 'title' => 'Instalasi', 'desc' => 'Pemasangan rapi, bersih, dan tepat waktu oleh tim ahli di lokasi Anda.', 'icon' => 'verified']
                ] as $index => $step)
                <div class="relative z-10 group" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    <div class="flex flex-col items-center text-center h-full">
                        {{-- Icon Container --}}
                        <div class="relative w-24 h-24 mb-6 flex items-center justify-center shrink-0">
                            {{-- Glow --}}
                            <div class="absolute inset-0 bg-primary/20 blur-xl rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            
                            {{-- Base Background --}}
                            <div class="absolute inset-2 bg-[#1A1D24] border border-white/10 rounded-full group-hover:border-primary/50 group-hover:scale-105 transition-all duration-500 shadow-xl shadow-black/50"></div>
                            
                            {{-- Inner Dashed Ring --}}
                            <div class="absolute inset-4 bg-transparent rounded-full border border-dashed border-white/20 group-hover:border-primary/50 group-hover:rotate-180 transition-all duration-700"></div>
                            
                            {{-- Icon --}}
                            <span class="material-symbols-outlined relative z-10 text-3xl text-gray-400 group-hover:text-primary transition-colors duration-500 group-hover:scale-110">{{ $step['icon'] }}</span>
                            
                            {{-- Step Number Badge --}}
                            <div class="absolute -top-1 -right-1 w-8 h-8 rounded-full bg-primary text-black font-bold text-xs flex items-center justify-center z-20 border-4 border-background-dark shadow-lg scale-90 group-hover:scale-110 transition-transform duration-500">
                                {{ $step['num'] }}
                            </div>
                        </div>

                        {{-- Content Card --}}
                        <div class="bg-white/[0.02] border border-white/5 backdrop-blur-sm p-6 rounded-2xl w-full h-full flex flex-col group-hover:bg-white/[0.04] group-hover:border-white/10 transition-all duration-500 group-hover:-translate-y-2 shadow-lg shadow-black/20">
                            <h4 class="text-lg sm:text-xl text-white font-bold mb-3 font-serif group-hover:text-primary transition-colors">{{ $step['title'] }}</h4>
                            <p class="text-gray-400 text-sm leading-relaxed">{{ $step['desc'] }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
