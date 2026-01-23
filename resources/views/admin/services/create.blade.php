@extends('admin.layouts.app')

@section('title', 'Tambah Layanan Baru')
@section('page-title', 'Layanan / Tambah Baru')

@section('content')

<form action="{{ route('admin.services.store') }}" method="POST">
    @csrf

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Left Column: Form Inputs --}}
        <div class="lg:col-span-2 space-y-6">

            <div class="glass-card p-6 rounded-2xl border border-white/5">
                <h3 class="text-lg font-bold text-white mb-6 flex items-center gap-2">
                    <span class="material-symbols-outlined text-green-400">design_services</span>
                    Informasi Layanan
                </h3>

                <div class="space-y-6">
                    {{-- Title --}}
                    <div class="group">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Nama Layanan</label>
                        <input type="text" name="title" value="{{ old('title') }}"
                            class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-green-500/50 focus:bg-black/40 transition-all font-medium"
                            placeholder="Contoh: Desain Interior Rumah" required>
                        @error('title') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Description --}}
                    <div class="group">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Deskripsi Layanan</label>
                        <textarea name="description" rows="5"
                            class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-green-500/50 focus:bg-black/40 transition-all"
                            placeholder="Jelaskan apa saja yang termasuk dalam layanan ini..." required>{{ old('description') }}</textarea>
                        @error('description') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center gap-4 pt-4">
                <a href="{{ route('admin.services.index') }}" class="px-6 py-3 rounded-xl bg-white/5 border border-white/10 text-gray-300 font-bold hover:bg-white/10 transition-colors">
                    Batal
                </a>
                <button type="submit" class="flex-1 px-6 py-3 rounded-xl bg-linear-to-r from-green-500 to-emerald-600 text-white font-bold uppercase tracking-wider hover:shadow-lg hover:shadow-green-500/20 hover:scale-[1.01] transition-all flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined">save</span>
                    Simpan Layanan
                </button>
            </div>
        </div>

        {{-- Right Column: Settings --}}
        <div class="space-y-6">
            <div class="glass-card p-6 rounded-2xl border border-white/5 sticky top-24">
                <h3 class="text-lg font-bold text-white mb-6 flex items-center gap-2">
                    <span class="material-symbols-outlined text-green-400">tune</span>
                    Pengaturan
                </h3>

                <div class="space-y-6">
                    {{-- Icon Picker --}}
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Pilih Ikon</label>

                        {{-- Selected Icon Preview --}}
                        <div class="flex items-center gap-3 p-4 bg-black/20 border border-white/10 rounded-xl mb-4">
                            <div class="w-14 h-14 bg-green-500/10 rounded-xl flex items-center justify-center border border-green-500/20">
                                <span class="material-symbols-outlined text-green-400 text-3xl" id="icon-preview">{{ old('icon', 'home') }}</span>
                            </div>
                            <div>
                                <p class="text-white font-bold text-sm">Ikon Terpilih</p>
                                <p class="text-gray-500 text-xs font-mono" id="icon-name-display">{{ old('icon', 'home') }}</p>
                            </div>
                        </div>

                        {{-- Icon Grid --}}
                        <div class="grid grid-cols-6 gap-2 p-3 bg-black/20 border border-white/10 rounded-xl max-h-64 overflow-y-auto custom-scrollbar">
                            @php
                            $icons = [
                            // Residential
                            ['name' => 'home', 'label' => 'Rumah'],
                            ['name' => 'apartment', 'label' => 'Apartemen'],
                            ['name' => 'villa', 'label' => 'Villa'],
                            ['name' => 'cottage', 'label' => 'Cottage'],

                            // Rooms
                            ['name' => 'living', 'label' => 'Ruang Tamu'],
                            ['name' => 'bedroom_parent', 'label' => 'Kamar Tidur'],
                            ['name' => 'kitchen', 'label' => 'Dapur'],
                            ['name' => 'bathroom', 'label' => 'Kamar Mandi'],
                            ['name' => 'dining', 'label' => 'Ruang Makan'],
                            ['name' => 'meeting_room', 'label' => 'Ruang Rapat'],

                            // Furniture
                            ['name' => 'chair', 'label' => 'Kursi'],
                            ['name' => 'table_restaurant', 'label' => 'Meja'],
                            ['name' => 'bed', 'label' => 'Tempat Tidur'],
                            ['name' => 'weekend', 'label' => 'Sofa'],
                            ['name' => 'door_sliding', 'label' => 'Lemari'],
                            ['name' => 'tv', 'label' => 'TV/Backdrop'],

                            // Commercial
                            ['name' => 'storefront', 'label' => 'Toko'],
                            ['name' => 'corporate_fare', 'label' => 'Kantor'],
                            ['name' => 'restaurant', 'label' => 'Restoran'],
                            ['name' => 'local_cafe', 'label' => 'Kafe'],
                            ['name' => 'hotel', 'label' => 'Hotel'],
                            ['name' => 'store', 'label' => 'Retail'],

                            // Design & Services
                            ['name' => 'design_services', 'label' => 'Desain'],
                            ['name' => 'architecture', 'label' => 'Arsitektur'],
                            ['name' => 'construction', 'label' => 'Konstruksi'],
                            ['name' => 'handyman', 'label' => 'Renovasi'],
                            ['name' => 'plumbing', 'label' => 'Plumbing'],
                            ['name' => 'electrical_services', 'label' => 'Listrik'],

                            // Decor
                            ['name' => 'palette', 'label' => 'Warna'],
                            ['name' => 'brush', 'label' => 'Cat'],
                            ['name' => 'wallpaper', 'label' => 'Wallpaper'],
                            ['name' => 'light', 'label' => 'Lampu'],
                            ['name' => 'curtains', 'label' => 'Gorden'],
                            ['name' => 'frame_inspect', 'label' => 'Dekorasi'],
                            ];
                            @endphp

                            @foreach($icons as $icon)
                            <button type="button"
                                class="icon-option aspect-square flex flex-col items-center justify-center p-2 rounded-lg border border-transparent hover:border-green-500/50 hover:bg-green-500/10 transition-all group"
                                data-icon="{{ $icon['name'] }}"
                                title="{{ $icon['label'] }}">
                                <span class="material-symbols-outlined text-gray-400 group-hover:text-green-400 text-xl transition-colors">{{ $icon['name'] }}</span>
                            </button>
                            @endforeach
                        </div>

                        {{-- Hidden Input --}}
                        <input type="hidden" name="icon" id="icon-input" value="{{ old('icon', 'home') }}">

                        <p class="text-[10px] text-gray-500 mt-2">
                            Atau lihat lebih banyak di <a href="https://fonts.google.com/icons" target="_blank" class="text-green-400 hover:underline">Google Fonts Icons</a>
                        </p>
                        @error('icon') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Display Order --}}
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Urutan Tampil</label>
                        <input type="number" name="display_order" value="{{ old('display_order', 0) }}"
                            class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-green-500/50 focus:bg-black/40 transition-all font-mono">
                        <p class="text-[10px] text-gray-500 mt-1">Semakin kecil angkanya, semakin awal munculnya.</p>
                    </div>

                    {{-- Active Status --}}
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Status</label>
                        <label class="relative inline-flex items-center cursor-pointer mt-1">
                            <input type="checkbox" name="is_active" value="1" class="sr-only peer" checked>
                            <div class="w-11 h-6 bg-gray-700 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-green-500 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-500"></div>
                            <span class="ml-3 text-sm font-medium text-gray-300">Aktif</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@push('scripts')
<script>
    function selectIcon(iconName) {
        // Update hidden input
        document.getElementById('icon-input').value = iconName;

        // Update preview
        document.getElementById('icon-preview').innerText = iconName;
        document.getElementById('icon-name-display').innerText = iconName;

        // Update visual selection
        document.querySelectorAll('.icon-option').forEach(btn => {
            btn.classList.remove('border-green-500', 'bg-green-500/20');
            btn.classList.add('border-transparent');
            btn.querySelector('span').classList.remove('text-green-400');
            btn.querySelector('span').classList.add('text-gray-400');
        });

        const selected = document.querySelector('.icon-option[data-icon="' + iconName + '"]');
        if (selected) {
            selected.classList.remove('border-transparent');
            selected.classList.add('border-green-500', 'bg-green-500/20');
            selected.querySelector('span').classList.remove('text-gray-400');
            selected.querySelector('span').classList.add('text-green-400');
        }
    }

    // Initialize on page load and attach event listeners
    document.addEventListener('DOMContentLoaded', function() {
        // Attach click handlers to all icon buttons
        document.querySelectorAll('.icon-option[data-icon]').forEach(function(btn) {
            btn.addEventListener('click', function() {
                selectIcon(this.getAttribute('data-icon'));
            });
        });

        // Set initial selection
        const currentIcon = document.getElementById('icon-input').value;
        if (currentIcon) {
            selectIcon(currentIcon);
        }
    });
</script>
@endpush

@endsection