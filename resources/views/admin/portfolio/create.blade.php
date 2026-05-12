@extends('admin.layouts.app')

@section('title', 'Tambah Portfolio Baru')
@section('page-title', 'Portfolio / Tambah Baru')

@section('content')
<form action="{{ route('admin.portfolio.store') }}" method="POST" enctype="multipart/form-data" data-portfolio-form>
    @csrf

    <div class="grid grid-cols-1 xl:grid-cols-[minmax(0,1fr)_420px] gap-6">
        <div class="space-y-6">
            <section class="glass-card relative z-20 p-5 sm:p-6 rounded-2xl border border-white/5">
                <h3 class="text-lg font-bold text-white mb-6 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">edit_document</span>
                    Informasi Project
                </h3>

                <div class="space-y-5">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Nama Project / Judul</label>
                        <input type="text" name="title" value="{{ old('title') }}" class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-primary/50 focus:bg-black/40 transition-all font-medium" placeholder="Judul proyek" required>
                        @error('title') <p class="text-red-400 text-xs mt-2">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Deskripsi Project</label>
                        <textarea name="description" rows="6" class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-primary/50 focus:bg-black/40 transition-all" placeholder="Jelaskan detail project, tantangan, dan solusi yang diberikan...">{{ old('description') }}</textarea>
                        @error('description') <p class="text-red-400 text-xs mt-2">{{ $message }}</p> @enderror
                    </div>
                </div>
            </section>

            <section class="glass-card p-5 sm:p-6 rounded-2xl border border-white/5">
                <h3 class="text-lg font-bold text-white mb-6 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">category</span>
                    Kategori & Status
                </h3>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    @include('admin.portfolio.partials.category-combobox', ['selectedCategory' => null])

                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Status Publikasi</label>
                        <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="is_active" value="1" class="sr-only peer" checked>
                                <div class="w-11 h-6 bg-gray-700 peer-focus:ring-2 peer-focus:ring-primary rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-500"></div>
                                <span class="ml-3 text-sm font-medium text-gray-300">Aktif / Terbit</span>
                            </label>

                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="is_featured" value="1" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-700 peer-focus:ring-2 peer-focus:ring-primary rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                                <span class="ml-3 text-sm font-medium text-gray-300">Featured</span>
                            </label>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <aside class="space-y-6">
            <section class="glass-card relative z-0 p-5 sm:p-6 rounded-2xl border border-white/5">
                <div class="flex items-start justify-between gap-4 mb-5">
                    <div>
                        <h3 class="text-lg font-bold text-white flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">photo_library</span>
                            Foto Portfolio
                        </h3>
                        <p class="mt-2 text-xs text-gray-500 leading-relaxed">Upload 1 sampai 5 foto. Setiap foto maksimal 10 MB.</p>
                    </div>
                    <span id="photo-count" class="rounded-full border border-white/10 bg-black/30 px-3 py-1 text-xs font-bold text-gray-300">0 / 5</span>
                </div>

                <label id="photo-upload-zone" for="photos-input" class="group flex min-h-[220px] cursor-pointer flex-col items-center justify-center rounded-2xl border-2 border-dashed border-white/10 bg-black/20 p-6 text-center transition hover:border-primary/60 hover:bg-primary/5">
                    <span class="material-symbols-outlined mb-3 text-5xl text-primary transition group-hover:scale-105">add_photo_alternate</span>
                    <span class="text-sm font-bold text-white">Pilih Foto Project</span>
                    <span class="mt-1 text-xs text-gray-500">JPG, PNG, WEBP - maksimal 10 MB per foto</span>
                    <input id="photos-input" name="photos[]" type="file" accept="image/jpeg,image/png,image/webp" multiple class="sr-only">
                </label>
                <p id="photo-upload-error" class="hidden mt-3 text-xs text-red-400"></p>
                @error('photos') <p class="mt-3 text-xs text-red-400">{{ $message }}</p> @enderror
                @error('photos.*') <p class="mt-3 text-xs text-red-400">{{ $message }}</p> @enderror

                <div id="photo-preview-grid" class="mt-4 grid grid-cols-2 gap-3"></div>
                <div id="existing-photo-inputs"></div>
                <div id="removed-photo-inputs"></div>

                <div class="mt-5 rounded-xl border border-blue-500/20 bg-blue-500/10 p-3 text-xs leading-relaxed text-blue-300/80">
                    Foto pertama otomatis menjadi cover portfolio. Urutan foto mengikuti urutan upload.
                </div>

                <div class="mt-6 border-t border-white/10 pt-5">
                    <div class="relative z-10 flex flex-col sm:flex-row xl:flex-col gap-3">
                        <a href="{{ route('admin.portfolio.index') }}" class="inline-flex min-h-[48px] items-center justify-center rounded-xl border border-white/10 bg-white/5 px-5 font-bold text-gray-300 transition hover:bg-white/10">Batal</a>
                        <button type="submit" data-submit-button class="inline-flex min-h-[52px] items-center justify-center gap-2 rounded-xl bg-linear-to-r from-primary to-yellow-600 px-5 font-bold uppercase tracking-wider text-black transition hover:shadow-lg hover:shadow-primary/20">
                            <span class="material-symbols-outlined">save</span>
                            <span data-submit-label>Simpan Project</span>
                        </button>
                    </div>
                </div>
            </section>
        </aside>
    </div>
</form>
@endsection

@push('scripts')
<script>
    window.portfolioInitialPhotos = [];
</script>
<script src="{{ asset('assets/js/admin-portfolio-category.js') }}"></script>
<script src="{{ asset('assets/js/admin-portfolio-upload.js') }}"></script>
@endpush
