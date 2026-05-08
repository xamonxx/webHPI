@extends('frontend.layouts.app')

@section('title', 'Proyek Portofolio - Home Putra Interior')

@section('content')
<div class="pt-32 pb-20 sm:pt-40 sm:pb-32 bg-background-dark min-h-screen">
    <div class="max-w-[1400px] mx-auto px-6">

        <!-- Header Section -->
        <div class="text-center mb-16 sm:mb-24" data-aos="fade-up">
            <span class="text-primary uppercase tracking-[0.4em] text-[10px] font-bold block mb-4">Karya Terbaik</span>
            <h1 class="text-4xl md:text-6xl lg:text-7xl text-white font-serif mb-6">Proyek <span class="text-primary italic">Portofolio</span></h1>
            <p class="text-gray-400 max-w-2xl mx-auto font-light leading-relaxed text-sm sm:text-base">
                Menampilkan koleksi lengkap karya desain interior kami yang menggabungkan estetika, fungsi, dan gaya hidup premium.
            </p>
        </div>

        <!-- Filter Buttons (Optional) -->
        @if($categories->count() > 0)
        <div class="flex flex-wrap justify-center gap-4 mb-12" data-aos="fade-up" data-aos-delay="100">
            <a href="{{ route('portfolio.all') }}" class="px-6 py-2 rounded-full border border-white/10 text-xs uppercase tracking-widest font-bold transition-all {{ !$category ? 'bg-primary text-black border-primary' : 'text-gray-400 hover:text-white hover:border-white' }}">
                Semua
            </a>
            @foreach($categories as $cat)
            <a href="{{ route('portfolio.all', ['category' => $cat]) }}" class="px-6 py-2 rounded-full border border-white/10 text-xs uppercase tracking-widest font-bold transition-all {{ $category == $cat ? 'bg-primary text-black border-primary' : 'text-gray-400 hover:text-white hover:border-white' }}">
                {{ $cat }}
            </a>
            @endforeach
        </div>
        @endif

        <!-- Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8 mb-16">
            @forelse($portfolios as $index => $portfolio)
            @php
            $imageSrc = $portfolio->image_url;
            $delay = ($index % 3) * 100;
            $photoCount = count($portfolio->all_images);
            @endphp
            <a href="{{ route('portfolio.show', $portfolio->id) }}" class="group relative overflow-hidden rounded-xl break-inside-avoid cursor-pointer card-hover" data-aos="fade-up" data-aos-delay="{{ $delay }}">
                <!-- Image -->
                <div class="aspect-4/5 overflow-hidden bg-white/5 flex items-center justify-center">
                    @if($imageSrc)
                    <img alt="{{ $portfolio->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" src="{{ $imageSrc }}" loading="lazy" />
                    @else
                    <span class="material-symbols-outlined text-primary/60 text-6xl">image</span>
                    @endif
                    @if($photoCount > 1)
                    <span class="absolute top-3 right-3 rounded-full border border-white/10 bg-black/60 px-3 py-1 text-[11px] font-bold text-white backdrop-blur-md">
                        {{ $photoCount }} Foto
                    </span>
                    @endif
                </div>

                <!-- Overlay -->
                <div class="absolute inset-0 bg-linear-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex flex-col justify-end p-8">
                    @if($portfolio->category)
                    <span class="text-primary text-[10px] uppercase tracking-[0.2em] font-bold mb-2 translate-y-4 group-hover:translate-y-0 transition-transform duration-500 delay-100">{{ $portfolio->category }}</span>
                    @endif
                    <h3 class="text-2xl text-white font-serif italic translate-y-4 group-hover:translate-y-0 transition-transform duration-500 delay-200">{{ $portfolio->title }}</h3>
                </div>
            </a>
            @empty
            <div class="col-span-full text-center py-20">
                <p class="text-gray-500 italic">Belum ada portfolio ditampilkan.</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="flex justify-center" data-aos="fade-up">
            {{ $portfolios->links('pagination::tailwind') }}
        </div>

    </div>
</div>
@endsection
