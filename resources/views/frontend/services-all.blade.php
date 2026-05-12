@extends('frontend.layouts.app')

@php
    $siteName = $settings['site_name'] ?? 'Home Putra Interior';
    $pageTitle = "Layanan Desain Interior & Furniture Custom - {$siteName}";
    $pageDescription = "Layanan desain interior, furniture custom, kitchen set, wardrobe, backdrop TV, dan renovasi dari {$siteName} untuk rumah dan bisnis.";
@endphp

@section('title', $pageTitle)
@section('meta_title', $pageTitle)
@section('meta_description', $pageDescription)
@section('og_title', $pageTitle)
@section('og_description', $pageDescription)
@section('twitter_title', $pageTitle)
@section('twitter_description', $pageDescription)

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
            <div id="service-{{ $service->id }}" class="group" data-aos="fade-up" data-aos-delay="{{ $delay }}">
                <div class="relative h-full p-6 sm:p-8 bg-white/5 border border-white/10 rounded-2xl hover:border-primary/30 hover:bg-white/8 transition-all duration-300">

                    {{-- Icon --}}
                    <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-xl {{ $color[0] }} flex items-center justify-center mb-4 sm:mb-6 group-hover:scale-110 transition-transform duration-300">
                        <span class="material-symbols-outlined {{ $color[1] }} text-2xl sm:text-3xl">{{ $service->icon ?: $icons[$index % count($icons)] }}</span>
                    </div>

                    {{-- Number --}}
                    <span class="text-white/10 text-5xl sm:text-6xl font-bold absolute top-4 right-4 group-hover:text-primary/10 transition-colors">0{{ $index + 1 }}</span>

                    {{-- Content --}}
                    <h3 class="text-lg sm:text-xl text-white font-semibold mb-2 sm:mb-3 group-hover:text-primary transition-colors">{{ $service->title }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-4 sm:mb-6 group-hover:text-gray-400 transition-colors">
                        {{ $service->description }}
                    </p>

                    {{-- CTA --}}
                    <a href="{{ route('services.show', $service) }}" class="inline-flex items-center gap-2 text-primary text-sm font-medium group-hover:gap-3 transition-all focus:outline-none focus-visible:ring-2 focus-visible:ring-primary/60 focus-visible:ring-offset-4 focus-visible:ring-offset-background-dark rounded-full">
                        <span>Selengkapnya</span>
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M5 12h14m-6-6 6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12 text-gray-500">
                Belum ada layanan yang ditampilkan.
            </div>
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
                        <span class="text-primary text-xs font-bold uppercase tracking-wider">Konsultasi Gratis</span>
                    </div>

                    <h2 class="text-2xl sm:text-3xl md:text-4xl text-white font-serif mb-4">
                        Siap Wujudkan Interior <span class="text-primary">Impian Anda?</span>
                    </h2>
                    <p class="text-gray-400 text-sm sm:text-base mb-6 sm:mb-8">
                        Konsultasi gratis dengan tim desainer profesional kami. Dapatkan arahan proyek yang jelas dalam 24 jam.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center">
                        <a href="{{ route('home') }}#contact" class="inline-flex items-center justify-center gap-2 px-6 sm:px-8 py-3 sm:py-4 bg-primary hover:bg-primary-hover text-black font-bold rounded-xl transition-all">
                            <span class="material-symbols-outlined">chat</span>
                            <span>Konsultasi Gratis</span>
                        </a>
                        <a href="{{ route('portfolio.all') }}" class="inline-flex items-center justify-center gap-2 px-6 sm:px-8 py-3 sm:py-4 bg-white/5 border border-white/20 text-white font-bold rounded-xl hover:bg-white/10 transition-all">
                            <span class="material-symbols-outlined">photo_library</span>
                            <span>Lihat Portofolio</span>
                        </a>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection
