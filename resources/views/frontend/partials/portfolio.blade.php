{{--
    GOD-TIER PORTFOLIO - LUXURY TYPOGRAPHY
    Features: Serif Italic Titles (Elegant), Clean Sans Details, High Legibility
--}}

<section class="py-24 bg-background-dark relative overflow-hidden" id="portfolio">
    {{-- Ambient Light --}}
    <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-primary/5 blur-[150px] rounded-full pointer-events-none opacity-50"></div>
    <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-white/5 blur-[100px] rounded-full pointer-events-none opacity-30"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        {{-- Section Header --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-8 mb-16">
            <div data-aos="fade-up">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full border border-white/10 bg-white/5 backdrop-blur-sm mb-4">
                    <span class="w-1.5 h-1.5 rounded-full bg-primary animate-pulse"></span>
                    <span class="text-[10px] uppercase tracking-[0.2em] text-gray-300 font-bold">Masterpieces</span>
                </div>
                <h2 class="text-4xl md:text-6xl text-white font-serif leading-tight">
                    Curated <span class="text-transparent bg-clip-text bg-linear-to-r from-[#FFD700] to-[#B8860B] italic pr-2">Works</span>
                </h2>
            </div>

            <a href="{{ route('portfolio.all') }}" class="group flex items-center gap-3 text-white hover:text-primary transition-colors pb-2" data-aos="fade-left">
                <span class="text-sm font-bold uppercase tracking-widest">Explore All</span>
                <div class="relative w-12 h-12 rounded-full border border-white/20 flex items-center justify-center group-hover:border-primary/50 group-hover:bg-primary/10 transition-all">
                    <span class="material-symbols-outlined text-lg group-hover:-rotate-45 transition-transform duration-300">arrow_forward</span>
                </div>
            </a>
        </div>

        {{-- Aesthetic Masonry Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6 auto-rows-[350px]">
            @php
            $dummy = [
            (object)['title' => 'The Grand Penthouse', 'cat' => 'Luxury Residential', 'img' => 'https://images.unsplash.com/photo-1600210492486-724fe5c67fb0', 'size' => 'md:col-span-8'],
            (object)['title' => 'Zen Office Space', 'cat' => 'Commercial', 'img' => 'https://images.unsplash.com/photo-1497366216548-37526070297c', 'size' => 'md:col-span-4'],
            (object)['title' => 'Nordic Kitchen', 'cat' => 'Custom Furniture', 'img' => 'https://images.unsplash.com/photo-1556911220-e15b29be8c8f', 'size' => 'md:col-span-4'],
            (object)['title' => 'Velvet Lounge', 'cat' => 'Hospitality', 'img' => 'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6', 'size' => 'md:col-span-8'],
            ];
            $data = isset($portfolios) && count($portfolios) > 0 ? $portfolios : $dummy;
            @endphp

            @foreach($data as $key => $item)
            @php
            $colSpan = isset($item->size) ? $item->size : ($key % 3 == 0 || $key % 4 == 3 ? 'md:col-span-8' : 'md:col-span-4');
            $delay = $key * 100;
            @endphp

            <a href="{{ isset($item->id) ? route('portfolio.show', $item->id) : '#' }}" class="{{ $colSpan }} group relative rounded-3xl overflow-hidden cursor-pointer block" data-aos="fade-up" data-aos-delay="{{ $delay }}">

                {{-- Image --}}
                <div class="absolute inset-0 overflow-hidden">
                    <img src="{{ $item->image_url ?? $item->img }}?auto=format&fit=crop&w=1200&q=80"
                        alt="{{ $item->title }}"
                        width="800"
                        height="600"
                        loading="lazy"
                        class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105">
                </div>

                {{-- Overlay --}}
                <div class="absolute inset-0 bg-linear-to-t from-black/95 via-black/40 to-transparent opacity-90 transition-opacity duration-300"></div>

                {{-- Content --}}
                <div class="absolute inset-0 p-8 flex flex-col justify-end z-20">
                    <div class="flex flex-col gap-1 transform transition-transform duration-500 group-hover:-translate-y-1">

                        {{-- Tags (Clean Sans) --}}
                        <div class="flex items-center gap-3 mb-2">
                            <span class="px-2.5 py-1 rounded bg-white/10 backdrop-blur-md border border-white/10 text-primary text-[10px] font-bold uppercase tracking-widest">
                                {{ $item->category ?? $item->cat ?? 'Interior' }}
                            </span>
                        </div>

                        {{-- Title (Elegant Serif Italic) --}}
                        <h3 class="text-3xl md:text-4xl font-serif italic text-white leading-tight group-hover:text-primary transition-colors duration-300">
                            {{ $item->title }}
                        </h3>

                        {{-- CTA (Clean Sans) --}}
                        <div class="pt-3 flex items-center gap-2 text-gray-300 text-xs font-bold uppercase tracking-widest opacity-80 group-hover:opacity-100 transition-opacity">
                            View Project <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </div>
                    </div>
                </div>

                {{-- Border Glow --}}
                <div class="absolute inset-0 border border-white/10 rounded-3xl group-hover:border-primary/30 transition-colors pointer-events-none z-30"></div>
            </a>
            @endforeach
        </div>
    </div>
</section>