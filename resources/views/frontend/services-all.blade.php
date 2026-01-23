@extends('frontend.layouts.app')

@section('title', 'Layanan Desain Interior - Home Putra Interior')

@section('content')
<div class="pt-24 sm:pt-32 pb-16 sm:pb-24 bg-background-dark min-h-screen relative overflow-hidden">

    {{-- Background Effects --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-0 left-0 w-96 h-96 bg-primary/10 blur-[150px] rounded-full -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-80 h-80 bg-primary/5 blur-[120px] rounded-full translate-x-1/4 translate-y-1/4"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        {{-- Header Section --}}
        <div class="text-center mb-12 sm:mb-16" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-primary/10 border border-primary/20 rounded-full mb-4 sm:mb-6">
                <span class="w-1.5 h-1.5 bg-primary rounded-full animate-pulse"></span>
                <span class="text-primary text-xs font-bold uppercase tracking-widest">Layanan Profesional</span>
            </div>
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl text-white font-serif mb-4 sm:mb-6">
                Layanan <span class="text-primary">Desain Interior</span>
            </h1>
            <p class="text-gray-400 max-w-2xl mx-auto text-sm sm:text-base leading-relaxed px-4">
                Solusi desain interior lengkap dari konsep hingga realisasi. Kami menghadirkan keahlian premium untuk mewujudkan ruang impian Anda.
            </p>
        </div>

        {{-- Services Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mb-12 sm:mb-16">
            @forelse($services as $index => $service)
            @php
            $icons = ['home', 'storefront', 'chair', 'chat', 'apartment', 'design_services'];
            $colors = [
            ['bg-primary/20', 'text-primary'],
            ['bg-blue-500/20', 'text-blue-400'],
            ['bg-purple-500/20', 'text-purple-400'],
            ['bg-emerald-500/20', 'text-emerald-400'],
            ['bg-rose-500/20', 'text-rose-400'],
            ['bg-amber-500/20', 'text-amber-400'],
            ];
            $color = $colors[$index % count($colors)];
            $delay = ($index % 3) * 100;
            @endphp
            <div class="group" data-aos="fade-up" data-aos-delay="{{ $delay }}">
                <div class="h-full p-6 sm:p-8 bg-white/5 border border-white/10 rounded-2xl hover:border-primary/30 hover:bg-white/8 transition-all duration-300">

                    {{-- Icon --}}
                    <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-xl {{ $color[0] }} flex items-center justify-center mb-4 sm:mb-6 group-hover:scale-110 transition-transform duration-300">
                        <span class="material-symbols-outlined {{ $color[1] }} text-2xl sm:text-3xl">{{ $service->icon ?? $icons[$index % count($icons)] }}</span>
                    </div>

                    {{-- Number --}}
                    <span class="text-white/10 text-5xl sm:text-6xl font-bold absolute top-4 right-4 group-hover:text-primary/10 transition-colors">0{{ $index + 1 }}</span>

                    {{-- Content --}}
                    <h3 class="text-lg sm:text-xl text-white font-semibold mb-2 sm:mb-3 group-hover:text-primary transition-colors">{{ $service->title }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-4 sm:mb-6 group-hover:text-gray-400 transition-colors">
                        {{ $service->description }}
                    </p>

                    {{-- CTA --}}
                    <a href="{{ route('home') }}#contact" class="inline-flex items-center gap-2 text-primary text-sm font-medium group-hover:gap-3 transition-all">
                        <span>Konsultasi</span>
                        <span class="material-symbols-outlined text-base">arrow_forward</span>
                    </a>
                </div>
            </div>
            @empty
            {{-- Fallback Services --}}
            @foreach([
            ['title' => 'Desain Residensial', 'description' => 'Renovasi skala penuh dan desain bangunan baru untuk rumah mewah, fokus pada aliran ruang, pencahayaan, dan materialitas.', 'icon' => 'home'],
            ['title' => 'Ruang Komersial', 'description' => 'Menciptakan pengalaman brand yang berdampak melalui desain tata ruang cerdas untuk ritel, perhotelan, dan kantor.', 'icon' => 'storefront'],
            ['title' => 'Furniture Custom', 'description' => 'Desain dan koordinasi fabrikasi furniture eksklusif untuk memastikan setiap produk cocok sempurna dengan ruang Anda.', 'icon' => 'chair'],
            ['title' => 'Konsultasi Desain', 'description' => 'Konsultasi profesional untuk membantu Anda merencanakan proyek interior dengan budget dan timeline yang tepat.', 'icon' => 'chat'],
            ['title' => 'Interior Apartemen', 'description' => 'Maksimalkan ruang apartemen Anda dengan desain fungsional yang tetap estetis dan nyaman untuk hunian modern.', 'icon' => 'apartment'],
            ['title' => 'Renovasi Total', 'description' => 'Layanan renovasi menyeluruh dari struktur hingga finishing, mengubah ruang lama menjadi hunian impian baru.', 'icon' => 'design_services'],
            ] as $index => $service)
            @php
            $colors = [
            ['bg-primary/20', 'text-primary'],
            ['bg-blue-500/20', 'text-blue-400'],
            ['bg-purple-500/20', 'text-purple-400'],
            ['bg-emerald-500/20', 'text-emerald-400'],
            ['bg-rose-500/20', 'text-rose-400'],
            ['bg-amber-500/20', 'text-amber-400'],
            ];
            $color = $colors[$index % count($colors)];
            $delay = ($index % 3) * 100;
            @endphp
            <div class="group relative" data-aos="fade-up" data-aos-delay="{{ $delay }}">
                <div class="h-full p-6 sm:p-8 bg-white/5 border border-white/10 rounded-2xl hover:border-primary/30 hover:bg-white/8 transition-all duration-300">

                    <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-xl {{ $color[0] }} flex items-center justify-center mb-4 sm:mb-6 group-hover:scale-110 transition-transform duration-300">
                        <span class="material-symbols-outlined {{ $color[1] }} text-2xl sm:text-3xl">{{ $service['icon'] }}</span>
                    </div>

                    <span class="text-white/10 text-5xl sm:text-6xl font-bold absolute top-4 right-4 group-hover:text-primary/10 transition-colors">0{{ $index + 1 }}</span>

                    <h3 class="text-lg sm:text-xl text-white font-semibold mb-2 sm:mb-3 group-hover:text-primary transition-colors">{{ $service['title'] }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-4 sm:mb-6 group-hover:text-gray-400 transition-colors">
                        {{ $service['description'] }}
                    </p>

                    <a href="{{ route('home') }}#contact" class="inline-flex items-center gap-2 text-primary text-sm font-medium group-hover:gap-3 transition-all">
                        <span>Konsultasi</span>
                        <span class="material-symbols-outlined text-base">arrow_forward</span>
                    </a>
                </div>
            </div>
            @endforeach
            @endforelse
        </div>

        {{-- Process Section --}}
        <div class="mb-12 sm:mb-16" data-aos="fade-up">
            <div class="text-center mb-8 sm:mb-12">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-primary/10 border border-primary/20 rounded-full mb-4">
                    <span class="text-primary text-xs font-bold uppercase tracking-widest">Proses Kerja</span>
                </div>
                <h2 class="text-2xl sm:text-3xl md:text-4xl text-white font-serif">4 Langkah Menuju Interior Impian</h2>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                @foreach([
                ['num' => '01', 'title' => 'Konsultasi', 'desc' => 'Diskusi kebutuhan dan budget', 'icon' => 'chat'],
                ['num' => '02', 'title' => 'Desain', 'desc' => 'Konsep dan visualisasi 3D', 'icon' => 'draw'],
                ['num' => '03', 'title' => 'Produksi', 'desc' => 'Fabrikasi material berkualitas', 'icon' => 'construction'],
                ['num' => '04', 'title' => 'Instalasi', 'desc' => 'Pemasangan rapi bergaransi', 'icon' => 'done_all'],
                ] as $step)
                <div class="text-center group" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="relative inline-flex items-center justify-center w-16 h-16 sm:w-20 sm:h-20 rounded-full bg-white/5 border border-white/10 mb-3 sm:mb-4 group-hover:border-primary/30 group-hover:bg-primary/10 transition-all duration-300">
                        <span class="material-symbols-outlined text-primary text-2xl sm:text-3xl">{{ $step['icon'] }}</span>
                        <span class="absolute -bottom-1 -right-1 w-6 h-6 sm:w-7 sm:h-7 bg-primary rounded-full flex items-center justify-center text-black text-xs font-bold">{{ $step['num'] }}</span>
                    </div>
                    <h4 class="text-white font-semibold text-sm sm:text-base mb-1 group-hover:text-primary transition-colors">{{ $step['title'] }}</h4>
                    <p class="text-gray-500 text-xs sm:text-sm">{{ $step['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>

        {{-- CTA Section --}}
        <div data-aos="fade-up">
            <div class="relative p-6 sm:p-10 lg:p-12 rounded-2xl bg-white/5 border border-white/10 overflow-hidden">
                {{-- Background glow --}}
                <div class="absolute top-0 right-0 w-64 h-64 bg-primary/10 blur-[100px] rounded-full"></div>

                <div class="relative z-10 text-center max-w-2xl mx-auto">
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-primary/20 border border-primary/30 rounded-full mb-4 sm:mb-6">
                        <span class="w-2 h-2 bg-primary rounded-full animate-pulse"></span>
                        <span class="text-primary text-xs font-bold uppercase tracking-wider">Free Consultation</span>
                    </div>

                    <h2 class="text-2xl sm:text-3xl md:text-4xl text-white font-serif mb-4">
                        Siap Wujudkan Interior <span class="text-primary">Impian Anda?</span>
                    </h2>
                    <p class="text-gray-400 text-sm sm:text-base mb-6 sm:mb-8">
                        Konsultasi gratis dengan tim desainer profesional kami. Dapatkan estimasi biaya dalam 24 jam.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center">
                        <a href="{{ route('home') }}#contact" class="inline-flex items-center justify-center gap-2 px-6 sm:px-8 py-3 sm:py-4 bg-primary hover:bg-primary-hover text-black font-bold rounded-xl transition-all">
                            <span class="material-symbols-outlined">chat</span>
                            <span>Konsultasi Gratis</span>
                        </a>
                        <a href="{{ route('home') }}#calculator" class="inline-flex items-center justify-center gap-2 px-6 sm:px-8 py-3 sm:py-4 bg-white/5 border border-white/20 text-white font-bold rounded-xl hover:bg-white/10 transition-all">
                            <span class="material-symbols-outlined">calculate</span>
                            <span>Hitung Estimasi</span>
                        </a>
                    </div>

                    {{-- Trust badges --}}
                    <div class="flex flex-wrap items-center justify-center gap-4 sm:gap-6 mt-8 pt-6 border-t border-white/10">
                        <div class="flex items-center gap-2 text-gray-400 text-xs sm:text-sm">
                            <span class="material-symbols-outlined text-primary text-base sm:text-lg">verified</span>
                            <span>12+ Tahun</span>
                        </div>
                        <div class="flex items-center gap-2 text-gray-400 text-xs sm:text-sm">
                            <span class="material-symbols-outlined text-primary text-base sm:text-lg">workspace_premium</span>
                            <span>Garansi 2 Tahun</span>
                        </div>
                        <div class="flex items-center gap-2 text-gray-400 text-xs sm:text-sm">
                            <span class="material-symbols-outlined text-primary text-base sm:text-lg">thumb_up</span>
                            <span>500+ Proyek</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection