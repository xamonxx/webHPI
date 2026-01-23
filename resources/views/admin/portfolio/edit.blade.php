@extends('admin.layouts.app')

@section('title', 'Edit Portfolio')
@section('page-title', 'Portfolio / Edit Data')

@section('content')

<form action="{{ route('admin.portfolio.update', $portfolio->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Left Column: Form Inputs --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- General Info Card --}}
            <div class="glass-card p-6 rounded-2xl border border-white/5">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-bold text-white flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">edit_document</span>
                        Edit Informasi Project
                    </h3>
                    <span class="text-xs text-gray-500 font-mono">ID: #{{ $portfolio->id }}</span>
                </div>

                <div class="space-y-6">
                    {{-- Title --}}
                    <div class="group">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Nama Project / Judul</label>
                        <input type="text" name="title" value="{{ old('title', $portfolio->title) }}"
                            class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-primary/50 focus:bg-black/40 transition-all font-medium"
                            placeholder="Contoh: Modern Minimalist Living Room" required>
                        @error('title') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Description --}}
                    <div class="group">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Deskripsi Project</label>
                        <textarea name="description" rows="5"
                            class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-primary/50 focus:bg-black/40 transition-all"
                            placeholder="Jelaskan detail project...">{{ old('description', $portfolio->description) }}</textarea>
                        @error('description') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Location --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Lokasi</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-500">location_on</span>
                                <input type="text" name="location" value="{{ old('location', $portfolio->location) }}"
                                    class="w-full pl-10 bg-black/20 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-primary/50 focus:bg-black/40 transition-all"
                                    placeholder="Jakarta Selatan">
                            </div>
                        </div>

                        {{-- Completion Date --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Tanggal Selesai</label>
                            <input type="date" name="completion_date" value="{{ old('completion_date', $portfolio->completion_date) }}"
                                class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-primary/50 focus:bg-black/40 transition-all scheme-dark">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Categories Card --}}
            <div class="glass-card p-6 rounded-2xl border border-white/5">
                <h3 class="text-lg font-bold text-white mb-6 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">category</span>
                    Kategori & Jenis
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Kategori Utama</label>
                        <select name="category" class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-primary/50 transition-all appearance-none cursor-pointer">
                            <option value="Interior Design" {{ old('category', $portfolio->category) == 'Interior Design' ? 'selected' : '' }}>Interior Design</option>
                            <option value="Architecture" {{ old('category', $portfolio->category) == 'Architecture' ? 'selected' : '' }}>Architecture</option>
                            <option value="Furniture Custom" {{ old('category', $portfolio->category) == 'Furniture Custom' ? 'selected' : '' }}>Furniture Custom</option>
                            <option value="Renovation" {{ old('category', $portfolio->category) == 'Renovation' ? 'selected' : '' }}>Renovation</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Status Publikasi</label>
                        <div class="flex items-center gap-4 mt-2">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="is_featured" value="1" class="sr-only peer" {{ old('is_featured', $portfolio->is_featured ?? false) ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-gray-700 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-primary rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                                <span class="ml-3 text-sm font-medium text-gray-300">Set as Featured</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center gap-4 pt-4">
                <a href="{{ route('admin.portfolio.index') }}" class="px-6 py-3 rounded-xl bg-white/5 border border-white/10 text-gray-300 font-bold hover:bg-white/10 transition-colors">
                    Batal
                </a>
                <button type="submit" class="flex-1 px-6 py-3 rounded-xl bg-linear-to-r from-primary to-yellow-600 text-black font-bold uppercase tracking-wider hover:shadow-lg hover:shadow-primary/20 hover:scale-[1.01] transition-all flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined">save</span>
                    Simpan Perubahan
                </button>
            </div>
        </div>

        {{-- Right Column: Image Upload --}}
        <div class="space-y-6">
            <div class="glass-card p-6 rounded-2xl border border-white/5 sticky top-24">
                <h3 class="text-lg font-bold text-white mb-6 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">image</span>
                    Media Gambar
                </h3>

                <div class="group relative w-full h-80 border-2 border-dashed border-white/20 rounded-2xl flex flex-col items-center justify-center text-center cursor-pointer hover:border-primary/50 hover:bg-white/5 transition-all overflow-hidden bg-black/20" id="drop-area">

                    <input type="file" name="image" id="file-input" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20" accept="image/*" onchange="previewImage(this)">

                    {{-- Placeholder showing if no image --}}
                    <div id="upload-placeholder" class="relative z-10 transition-opacity duration-300 {{ $portfolio->image_path ? 'opacity-0' : '' }}">
                        <div class="w-16 h-16 rounded-full bg-white/5 flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-3xl text-gray-400 group-hover:text-primary">cloud_upload</span>
                        </div>
                        <h4 class="text-white font-bold mb-1">Upload Gambar Baru</h4>
                        <p class="text-gray-500 text-xs px-8">Drag & drop atau klik untuk mengganti (Opsional)</p>
                    </div>

                    {{-- Current/Preview Image --}}
                    <img id="image-preview"
                        src="{{ $portfolio->image_path ? asset('storage/' . $portfolio->image_path) : '#' }}"
                        alt="Preview"
                        class="absolute inset-0 w-full h-full object-cover {{ $portfolio->image_path ? '' : 'hidden' }} z-10">

                    {{-- Overlay for Remove --}}
                    <div id="remove-overlay" class="absolute inset-0 bg-black/60 z-20 hidden items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none">
                        <p class="text-white font-bold">Ganti Gambar</p>
                    </div>
                </div>
                @error('image') <p class="text-red-400 text-xs mt-2 text-center">{{ $message }}</p> @enderror

                <div class="mt-6 p-4 bg-yellow-500/10 border border-yellow-500/20 rounded-xl flex gap-3 items-start">
                    <span class="material-symbols-outlined text-yellow-400 text-xl mt-0.5">warning</span>
                    <div>
                        <h5 class="text-yellow-400 font-bold text-sm">Perhatian</h5>
                        <p class="text-yellow-300/70 text-xs mt-1 leading-relaxed">
                            Biarkan kosong jika tidak ingin mengubah gambar yang sudah ada. Gambar baru akan menimpa gambar lama.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@push('scripts')
<script>
    function previewImage(input) {
        const preview = document.getElementById('image-preview');
        const placeholder = document.getElementById('upload-placeholder');
        const overlay = document.getElementById('remove-overlay');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                placeholder.classList.add('opacity-0');
                overlay.classList.remove('hidden');
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush

@endsection