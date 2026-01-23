@extends('admin.layouts.app')

@section('title', 'Edit Testimoni')
@section('page-title', 'Testimoni / Edit Data')

@section('content')

<form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Left Column: Form Inputs --}}
        <div class="lg:col-span-2 space-y-6">

            <div class="glass-card p-6 rounded-2xl border border-white/5">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-bold text-white flex items-center gap-2">
                        <span class="material-symbols-outlined text-purple-400">rate_review</span>
                        Detail Ulasan
                    </h3>
                    <span class="text-xs text-gray-500 font-mono">ID: #{{ $testimonial->id }}</span>
                </div>

                <div class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Client Name --}}
                        <div class="group">
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Nama Klien</label>
                            <input type="text" name="client_name" value="{{ old('client_name', $testimonial->client_name) }}"
                                class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-purple-500/50 focus:bg-black/40 transition-all font-medium"
                                placeholder="Nama lengkap klien" required>
                            @error('client_name') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Client Location --}}
                        <div class="group">
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Lokasi / Proyek</label>
                            <input type="text" name="client_location" value="{{ old('client_location', $testimonial->client_location) }}"
                                class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-purple-500/50 focus:bg-black/40 transition-all"
                                placeholder="Contoh: Jakarta Selatan">
                            @error('client_location') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    {{-- Rating System --}}
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Rating Kepuasan</label>
                        <div class="flex items-center gap-4 bg-black/20 border border-white/10 rounded-xl p-4">
                            <div class="flex flex-row-reverse justify-end gap-2 group">
                                @for($i = 5; $i >= 1; $i--)
                                <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" class="peer hidden" {{ old('rating', $testimonial->rating) == $i ? 'checked' : '' }}>
                                <label for="star{{ $i }}" class="cursor-pointer text-gray-600 peer-checked:text-yellow-400 hover:text-yellow-400 peer-hover:text-yellow-400 transition-colors">
                                    <span class="material-symbols-outlined text-3xl fill-current">star</span>
                                </label>
                                @endfor
                            </div>
                            <span class="text-xs text-gray-500">Pilih jumlah bintang</span>
                        </div>
                    </div>

                    {{-- Testimonial Text --}}
                    <div class="group">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Isi Testimoni</label>
                        <textarea name="testimonial_text" rows="5"
                            class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-purple-500/50 focus:bg-black/40 transition-all"
                            placeholder="Tuliskan pengalaman klien disini..." required>{{ old('testimonial_text', $testimonial->testimonial_text) }}</textarea>
                        @error('testimonial_text') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center gap-4 pt-4">
                <a href="{{ route('admin.testimonials.index') }}" class="px-6 py-3 rounded-xl bg-white/5 border border-white/10 text-gray-300 font-bold hover:bg-white/10 transition-colors">
                    Batal
                </a>
                <button type="submit" class="flex-1 px-6 py-3 rounded-xl bg-linear-to-r from-purple-500 to-indigo-600 text-white font-bold uppercase tracking-wider hover:shadow-lg hover:shadow-purple-500/20 hover:scale-[1.01] transition-all flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined">save</span>
                    Simpan Perubahan
                </button>
            </div>
        </div>

        {{-- Right Column: Image & Settings --}}
        <div class="space-y-6">
            {{-- Image Upload --}}
            <div class="glass-card p-6 rounded-2xl border border-white/5">
                <h3 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-purple-400">face</span>
                    Foto Klien
                </h3>

                <div class="relative w-full aspect-square bg-black/20 border-2 border-dashed border-white/10 rounded-xl overflow-hidden group hover:border-purple-500/50 transition-colors cursor-pointer" id="drop-zone">
                    <input type="file" name="client_image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" id="file-input" accept="image/*" onchange="previewImage(this)">

                    <div class="absolute inset-0 flex flex-col items-center justify-center text-center p-4 transition-opacity duration-300 {{ $testimonial->client_image ? 'opacity-0' : '' }}" id="upload-placeholder">
                        <div class="w-16 h-16 bg-white/5 rounded-full flex items-center justify-center mb-3 group-hover:bg-purple-500/10 transition-colors">
                            <span class="material-symbols-outlined text-3xl text-gray-400 group-hover:text-purple-400">add_a_photo</span>
                        </div>
                        <p class="text-gray-400 text-xs font-medium">Klik atau drop untuk ganti</p>
                    </div>

                    @if($testimonial->client_image)
                    <img id="image-preview" src="{{ asset('storage/' . $testimonial->client_image) }}" class="absolute inset-0 w-full h-full object-cover" />
                    @else
                    <img id="image-preview" class="absolute inset-0 w-full h-full object-cover hidden" />
                    @endif
                </div>
            </div>

            <div class="glass-card p-6 rounded-2xl border border-white/5">
                <h3 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-purple-400">tune</span>
                    Status
                </h3>

                <div class="space-y-4">
                    {{-- Display Order --}}
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Urutan</label>
                        <input type="number" name="display_order" value="{{ old('display_order', $testimonial->display_order) }}"
                            class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-purple-500/50 focus:bg-black/40 transition-all font-mono">
                    </div>

                    {{-- Active Toogle --}}
                    <div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ old('is_active', $testimonial->is_active) ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-gray-700 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-purple-500 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-purple-500"></div>
                            <span class="ml-3 text-sm font-medium text-gray-300">Tampilkan</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@push('scripts')
<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('image-preview').src = e.target.result;
                document.getElementById('image-preview').classList.remove('hidden');
                document.getElementById('upload-placeholder').classList.add('opacity-0');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush

@endsection