@extends('admin.layouts.app')

@section('title', 'Tambah Portfolio Baru')
@section('page-title', 'Portfolio / Tambah Baru')

@section('content')

<form action="{{ route('admin.portfolio.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Left Column: Form Inputs --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- General Info Card --}}
            <div class="glass-card p-6 rounded-2xl border border-white/5">
                <h3 class="text-lg font-bold text-white mb-6 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">edit_document</span>
                    Informasi Project
                </h3>

                <div class="space-y-6">
                    {{-- Title --}}
                    <div class="group">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Nama Project / Judul</label>
                        <input type="text" name="title" value="{{ old('title') }}"
                            class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-primary/50 focus:bg-black/40 transition-all font-medium"
                            placeholder="Contoh: Modern Minimalist Living Room" required>
                        @error('title') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Description --}}
                    <div class="group">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Deskripsi Project</label>
                        <textarea name="description" rows="5"
                            class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-primary/50 focus:bg-black/40 transition-all"
                            placeholder="Jelaskan detail project, tantangan, dan solusi yang diberikan...">{{ old('description') }}</textarea>
                        @error('description') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Location --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Lokasi</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-500">location_on</span>
                                <input type="text" name="location" value="{{ old('location') }}"
                                    class="w-full pl-10 bg-black/20 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-primary/50 focus:bg-black/40 transition-all"
                                    placeholder="Jakarta Selatan">
                            </div>
                        </div>

                        {{-- Completion Date --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Tanggal Selesai</label>
                            <input type="date" name="completion_date" value="{{ old('completion_date') }}"
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
                            <option value="" disabled selected>Pilih Kategori</option>
                            <option value="Interior Design">Interior Design</option>
                            <option value="Architecture">Architecture</option>
                            <option value="Furniture Custom">Furniture Custom</option>
                            <option value="Renovation">Renovation</option>
                        </select>
                        <p class="text-[10px] text-gray-500 mt-1">*Pilih kategori yang paling sesuai</p>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Status Publikasi</label>
                        <div class="flex items-center gap-4 mt-2">
                            {{-- Active Toggle --}}
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="is_active" value="1" class="sr-only peer" checked>
                                <div class="w-11 h-6 bg-gray-700 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-primary rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-500"></div>
                                <span class="ml-3 text-sm font-medium text-gray-300">Aktif / Terbit</span>
                            </label>

                            {{-- Featured Toggle --}}
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="is_featured" value="1" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-700 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-primary rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                                <span class="ml-3 text-sm font-medium text-gray-300">Featured</span>
                            </label>
                        </div>
                        <p class="text-[10px] text-gray-500 mt-1">*Project aktif akan tampil di website. Featured akan masuk slider.</p>
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
                    Simpan Project
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

                    <div id="upload-placeholder" class="relative z-10 transition-opacity duration-300">
                        <div class="w-16 h-16 rounded-full bg-white/5 flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-3xl text-gray-400 group-hover:text-primary">cloud_upload</span>
                        </div>
                        <h4 class="text-white font-bold mb-1">Upload Gambar Utama</h4>
                        <p class="text-gray-500 text-xs px-8">Drag & drop atau klik untuk memilih file (JPG, PNG, WEBP)</p>
                    </div>

                    <img id="image-preview" src="#" alt="Preview" class="absolute inset-0 w-full h-full object-cover hidden z-10">

                    {{-- Overlay for Remove (only visible when image is there) --}}
                    <div id="remove-overlay" class="absolute inset-0 bg-black/60 z-20 hidden items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none">
                        <p class="text-white font-bold">Ganti Gambar</p>
                    </div>
                </div>
                @error('image') <p class="text-red-400 text-xs mt-2 text-center">{{ $message }}</p> @enderror

                <div class="mt-6 p-4 bg-blue-500/10 border border-blue-500/20 rounded-xl flex gap-3 items-start">
                    <span class="material-symbols-outlined text-blue-400 text-xl mt-0.5">info</span>
                    <div>
                        <h5 class="text-blue-400 font-bold text-sm">Tips Gambar</h5>
                        <p class="text-blue-300/70 text-xs mt-1 leading-relaxed">
                            Gunakan gambar landscape dengan rasio 16:9. Ukuran max 2MB untuk performa terbaik.
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