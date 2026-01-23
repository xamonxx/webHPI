@extends('admin.layouts.app')

@section('title', 'Hero Section')

@section('content')
<div class="space-y-8">
    {{-- Page Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-white tracking-tight">Hero Section</h1>
            <p class="text-gray-400 mt-1">Kelola tampilan hero di halaman utama website</p>
        </div>
        <a href="{{ route('home') }}" target="_blank"
            class="inline-flex items-center gap-2 px-4 py-2 bg-white/5 border border-white/10 rounded-xl text-gray-300 hover:text-white hover:border-primary/50 transition-all">
            <span class="material-symbols-outlined text-lg">visibility</span>
            <span>Lihat di Website</span>
        </a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
    <div class="bg-green-500/10 border border-green-500/30 rounded-xl p-4 flex items-center gap-3">
        <span class="material-symbols-outlined text-green-500">check_circle</span>
        <span class="text-green-400">{{ session('success') }}</span>
    </div>
    @endif

    {{-- Hero Preview Card --}}
    <div class="bg-[#12141A] border border-white/5 rounded-2xl overflow-hidden">
        <div class="relative h-64 bg-cover bg-center"
            style="background-image: url('{{ $hero->background_url }}');">
            <div class="absolute inset-0 bg-linear-to-r from-black/90 via-black/50 to-transparent"></div>
            <div class="absolute inset-0 bg-linear-to-t from-background-dark via-transparent to-black/40"></div>
            <div class="relative z-10 p-8 flex flex-col justify-center h-full max-w-xl">
                <span class="text-primary text-xs font-bold uppercase tracking-widest mb-4">#1 Jasa Interior Design</span>
                <h2 class="text-2xl md:text-3xl font-bold text-white mb-3">
                    {{ $hero->title }}
                    @if($hero->title_highlight)
                    <span class="text-gold-gradient italic font-serif">{{ $hero->title_highlight }}</span>
                    @endif
                </h2>
                <p class="text-gray-300 text-sm line-clamp-2">{{ $hero->subtitle }}</p>
            </div>
            <div class="absolute top-4 right-4 z-20">
                <span class="px-3 py-1 rounded-full text-xs font-bold {{ $hero->is_active ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }}">
                    {{ $hero->is_active ? 'Aktif' : 'Tidak Aktif' }}
                </span>
            </div>
        </div>
    </div>

    {{-- Edit Form --}}
    <form action="{{ route('admin.hero.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            {{-- Left Column: Text Content --}}
            <div class="bg-[#12141A] border border-white/5 rounded-2xl p-6 space-y-6">
                <h3 class="text-lg font-bold text-white flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">edit_note</span>
                    Konten Hero
                </h3>

                {{-- Title --}}
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Judul Utama (Putih)</label>
                    <input type="text" name="title" value="{{ old('title', $hero->title) }}"
                        class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:border-primary/50 focus:ring-1 focus:ring-primary/50 transition-all"
                        placeholder="Mendefinisikan Ruang,">
                    @error('title')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Title Highlight --}}
                <div>
                    <label class="block text-xs font-bold text-primary uppercase tracking-wider mb-2">Judul Highlight (Gold/Italic)</label>
                    <input type="text" name="title_highlight" value="{{ old('title_highlight', $hero->title_highlight) }}"
                        class="w-full px-4 py-3 bg-white/5 border border-primary/30 rounded-xl text-primary font-serif italic placeholder-gray-500 focus:outline-none focus:border-primary/50 focus:ring-1 focus:ring-primary/50 transition-all"
                        placeholder="Meningkatkan Gaya Hidup">
                    <p class="text-gray-500 text-xs mt-1">Teks ini akan muncul berwarna emas dan italic setelah judul utama.</p>
                </div>

                {{-- Subtitle --}}
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Deskripsi / Subtitle</label>
                    <textarea name="subtitle" rows="4"
                        class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:border-primary/50 focus:ring-1 focus:ring-primary/50 transition-all resize-none"
                        placeholder="Deskripsi singkat yang menarik...">{{ old('subtitle', $hero->subtitle) }}</textarea>
                    @error('subtitle')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-xs mt-1">Teks ini akan muncul di bawah judul hero</p>
                </div>

                {{-- Status Toggle --}}
                <div class="flex items-center justify-between p-4 bg-white/5 rounded-xl">
                    <div>
                        <p class="text-white font-medium">Status Hero</p>
                        <p class="text-gray-500 text-xs">Aktifkan untuk menampilkan hero di website</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ $hero->is_active ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-gray-700 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-primary/50 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                    </label>
                </div>
            </div>

            {{-- Right Column: Buttons & Image --}}
            <div class="space-y-6">
                {{-- Buttons Section --}}
                <div class="bg-[#12141A] border border-white/5 rounded-2xl p-6 space-y-6">
                    <h3 class="text-lg font-bold text-white flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">smart_button</span>
                        Tombol CTA
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        {{-- Button 1 --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Teks Tombol 1</label>
                            <input type="text" name="button1_text" value="{{ old('button1_text', $hero->button1_text) }}"
                                class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:border-primary/50 transition-all"
                                placeholder="Lihat Portfolio">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Link Tombol 1</label>
                            <input type="text" name="button1_link" value="{{ old('button1_link', $hero->button1_link) }}"
                                class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:border-primary/50 transition-all"
                                placeholder="#portfolio">
                        </div>

                        {{-- Button 2 --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Teks Tombol 2</label>
                            <input type="text" name="button2_text" value="{{ old('button2_text', $hero->button2_text) }}"
                                class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:border-primary/50 transition-all"
                                placeholder="Konsultasi Gratis">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Link Tombol 2</label>
                            <input type="text" name="button2_link" value="{{ old('button2_link', $hero->button2_link) }}"
                                class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:border-primary/50 transition-all"
                                placeholder="https://wa.me/...">
                        </div>
                    </div>
                </div>

                {{-- Background Image Section --}}
                <div class="bg-[#12141A] border border-white/5 rounded-2xl p-6 space-y-6">
                    <h3 class="text-lg font-bold text-white flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">image</span>
                        Gambar Background
                    </h3>

                    {{-- Current Image Preview --}}
                    <div class="relative aspect-video rounded-xl overflow-hidden bg-black/50">
                        <img src="{{ $hero->background_url }}" alt="Hero Background" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/30"></div>
                    </div>

                    {{-- Upload New Image --}}
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Upload Gambar Baru</label>
                        <input type="file" name="background_image" accept="image/*"
                            class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-primary file:text-black file:font-bold file:cursor-pointer hover:file:bg-primary/80 transition-all">
                        <p class="text-gray-500 text-xs mt-1">Format: JPEG, PNG, WebP. Maksimal 5MB. Rekomendasi: 1920x1080px</p>
                    </div>

                    {{-- Or Use URL --}}
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-white/10"></div>
                        </div>
                        <div class="relative flex justify-center">
                            <span class="px-3 bg-[#12141A] text-gray-500 text-xs">atau gunakan URL</span>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">URL Gambar</label>
                        <input type="url" name="background_url" value="{{ filter_var($hero->background_image, FILTER_VALIDATE_URL) ? $hero->background_image : '' }}"
                            class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:border-primary/50 transition-all"
                            placeholder="https://images.unsplash.com/...">
                        <p class="text-gray-500 text-xs mt-1">Gunakan URL gambar dari Unsplash, Pexels, atau sumber lain</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Save Button --}}
        <div class="flex justify-end">
            <button type="submit"
                class="inline-flex items-center gap-2 px-8 py-4 bg-primary hover:bg-primary/90 text-black font-bold rounded-xl shadow-lg shadow-primary/20 hover:shadow-primary/40 transition-all duration-300">
                <span class="material-symbols-outlined">save</span>
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection