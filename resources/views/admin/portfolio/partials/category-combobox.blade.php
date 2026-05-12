@php
    $fallbackCategories = [
        'Kitchen Set',
        'Lemari & Wardrobe',
        'Backdrop TV',
        'Wallpanel',
        'Interior Design',
        'Furniture Custom',
        'Renovation',
        'Komersial',
        'Residensial',
    ];

    $selectedCategory = old('category', $selectedCategory ?? null);
    $categoryOptions = collect($categories ?? $fallbackCategories)
        ->when($selectedCategory, fn ($items) => $items->push($selectedCategory))
        ->filter(fn ($category) => is_string($category) && trim($category) !== '')
        ->map(fn ($category) => trim($category))
        ->unique()
        ->values();
@endphp

<div data-category-combobox class="relative">
    <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Kategori Utama</label>
    <input type="hidden" name="category" value="{{ $selectedCategory }}" data-category-hidden>

    <div class="relative">
        <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-lg text-gray-500">sell</span>
        <input
            type="text"
            value="{{ $selectedCategory }}"
            data-category-input
            class="w-full rounded-xl border border-white/10 bg-black/30 py-3 pl-11 pr-12 font-medium text-white placeholder-gray-600 transition-all focus:border-primary/60 focus:bg-black/50 focus:outline-none focus:ring-2 focus:ring-primary/20"
            placeholder="Ketik atau pilih kategori"
            autocomplete="off"
            role="combobox"
            aria-autocomplete="list"
            aria-expanded="false"
        >
        <button type="button" data-category-toggle class="absolute right-2 top-1/2 inline-flex h-9 w-9 -translate-y-1/2 items-center justify-center rounded-lg text-gray-400 transition hover:bg-white/10 hover:text-white" aria-label="Buka pilihan kategori">
            <span class="material-symbols-outlined text-xl">expand_more</span>
        </button>
    </div>

    <div data-category-panel class="absolute left-0 right-0 z-50 mt-2 hidden overflow-hidden rounded-xl border border-white/10 bg-[#111318] shadow-2xl shadow-black/40 ring-1 ring-primary/10">
        <div data-category-new-row class="hidden border-b border-white/10 p-2">
            <button type="button" data-category-new class="flex w-full items-center gap-3 rounded-lg px-3 py-2.5 text-left text-sm font-semibold text-primary transition hover:bg-primary/10">
                <span class="material-symbols-outlined text-lg">add_circle</span>
                <span>Gunakan "<span data-category-new-label></span>"</span>
            </button>
        </div>

        <div data-category-options class="max-h-64 overflow-y-auto p-2">
            <button type="button" data-category-option data-category-value="" class="flex w-full items-center justify-between gap-3 rounded-lg px-3 py-2.5 text-left text-sm font-semibold text-gray-300 transition hover:bg-white/10 hover:text-white focus:bg-white/10 focus:text-white focus:outline-none">
                <span>Pilih Kategori</span>
                <span class="material-symbols-outlined hidden text-lg text-primary" data-category-check>check</span>
            </button>

            @foreach($categoryOptions as $category)
                <button type="button" data-category-option data-category-value="{{ $category }}" class="flex w-full items-center justify-between gap-3 rounded-lg px-3 py-2.5 text-left text-sm font-semibold text-gray-300 transition hover:bg-white/10 hover:text-white focus:bg-white/10 focus:text-white focus:outline-none">
                    <span>{{ $category }}</span>
                    <span class="material-symbols-outlined hidden text-lg text-primary" data-category-check>check</span>
                </button>
            @endforeach
        </div>

        <div data-category-empty class="hidden px-4 py-3 text-sm font-medium text-gray-500">Kategori tidak ditemukan</div>
    </div>

    @error('category') <p class="text-red-400 text-xs mt-2">{{ $message }}</p> @enderror
</div>
