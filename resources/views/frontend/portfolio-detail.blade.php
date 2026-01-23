@extends('frontend.layouts.app')

@section('title', ($portfolio->title ?? 'Project View') . ' - Home Putra Interior')

@section('content')
<main class="bg-[#0f1115] min-h-screen pt-28 pb-20 font-sans selection:bg-primary selection:text-black">

    <div class="max-w-[1200px] mx-auto px-6">

        {{-- 1. HEADER (Minimalist & Technical) --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-8 mb-12 border-b border-white/10 pb-8" data-aos="fade-down">
            <div class="space-y-4">
                <a href="{{ route('home') }}#portfolio" class="inline-flex items-center gap-2 text-gray-400 hover:text-white transition-colors text-xs font-mono tracking-tight group">
                    <span class="text-primary group-hover:-translate-x-1 transition-transform">&larr;</span> BACK_TO_GALLERY
                </a>
                <h1 class="text-4xl md:text-6xl font-bold text-white tracking-tight leading-none">
                    {{ $portfolio->title }}<span class="text-primary">.</span>
                </h1>
            </div>

            <div class="flex items-center gap-6 text-right">
                <div>
                    <span class="block text-[10px] uppercase text-gray-500 font-mono mb-1">CATEGORY</span>
                    <span class="text-sm text-white font-medium">{{ $portfolio->category }}</span>
                </div>
                <div class="w-px h-8 bg-white/10"></div>
                <div>
                    <span class="block text-[10px] uppercase text-gray-500 font-mono mb-1">DATE</span>
                    <span class="text-sm text-white font-medium">2024</span>
                </div>
            </div>
        </div>

        {{-- 2. MAIN BENTO GRID LAYOUT --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

            {{-- Main Visualization (Large Area) --}}
            <div class="lg:col-span-8 rounded-3xl overflow-hidden bg-gray-900 border border-white/5 relative group aspect-video lg:aspect-auto" data-aos="fade-up">
                <img src="{{ $portfolio->image_url }}" alt="{{ $portfolio->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105 opacity-90 group-hover:opacity-100">

                {{-- Overlay Gradient --}}
                <div class="absolute inset-0 bg-linear-to-t from-[#0f1115] via-transparent to-transparent opacity-60"></div>

                <div class="absolute bottom-6 left-6">
                    <span class="px-3 py-1 rounded-full border border-white/20 bg-black/40 backdrop-blur-md text-[10px] text-white font-mono">
                        {{ $portfolio->title }}
                    </span>
                </div>
            </div>

            {{-- Sidebar Info (Technical Details) --}}
            <div class="lg:col-span-4 space-y-6">

                {{-- Description Card --}}
                <div class="bg-[#16181d] rounded-3xl p-8 border border-white/5" data-aos="fade-left" data-aos-delay="100">
                    <h3 class="text-lg text-white font-bold mb-4 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                        Project Brief
                    </h3>
                    <p class="text-gray-400 leading-relaxed text-sm font-light">
                        {{ $portfolio->description ?? 'Desain hunian yang memprioritaskan alur sirkulasi ruang dan pencahayaan alami maksimal, dengan sentuhan material premium untuk kenyamanan jangka panjang.' }}
                    </p>
                </div>

                {{-- Specs / "Code" Card --}}
                <div class="bg-[#16181d] rounded-3xl p-8 border border-white/5" data-aos="fade-left" data-aos-delay="200">
                    <div class="grid grid-cols-2 gap-y-6">
                        <div>
                            <span class="block text-[10px] uppercase text-gray-600 font-mono mb-1">CLIENT_TYPE</span>
                            <span class="text-white text-sm font-medium">Residential</span>
                        </div>
                        <div>
                            <span class="block text-[10px] uppercase text-gray-600 font-mono mb-1">STYLE</span>
                            <span class="text-white text-sm font-medium">Modern Luxury</span>
                        </div>
                        <div>
                            <span class="block text-[10px] uppercase text-gray-600 font-mono mb-1">LOCATION</span>
                            <span class="text-white text-sm font-medium">Jakarta, ID</span>
                        </div>
                        <div>
                            <span class="block text-[10px] uppercase text-gray-600 font-mono mb-1">STATUS</span>
                            <span class="text-green-400 text-sm font-medium flex items-center gap-1">
                                <span class="material-symbols-outlined text-[12px]">check_circle</span> Delivered
                            </span>
                        </div>
                    </div>
                </div>

                {{-- CTA Button (High Contrast) --}}
                <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '6281809939681' }}?text={{ urlencode('I am interested in this project: ' . $portfolio->title) }}"
                    target="_blank"
                    class="flex items-center justify-between p-6 rounded-3xl bg-primary text-black font-bold hover:bg-white transition-colors group cursor-pointer" data-aos="fade-up" data-aos-delay="300">
                    <span class="text-sm uppercase tracking-wider">Start Consultation</span>
                    <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </a>

            </div>
        </div>

        {{-- 3. GALLERY GRID (Clean) --}}
        @if(isset($related) && $related->count() > 0)
        <div class="mt-20 border-t border-white/10 pt-10">
            <h4 class="text-white text-sm font-mono uppercase tracking-widest mb-8 opacity-50">RELATED_PROJECTS_ARRAY []</h4>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($related as $rel)
                <a href="{{ route('portfolio.show', $rel->id) }}" class="group block relative overflow-hidden rounded-2xl aspect-square bg-[#16181d]">
                    <img src="{{ $rel->image_url }}" alt="{{ $rel->title }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                        <span class="text-white text-xs font-bold">{{ $rel->title }}</span>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</main>
@endsection