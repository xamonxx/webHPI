@extends('admin.layouts.app')

@section('title', 'Manajemen Testimoni')
@section('page-title', 'Testimoni')

@section('content')

{{-- Stats & Quick Actions --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="glass-card p-6 rounded-2xl border border-white/5 bg-purple-500/5 relative overflow-hidden group">
        <div class="absolute -right-4 -top-4 w-24 h-24 bg-purple-500/20 rounded-full blur-2xl group-hover:bg-purple-500/30 transition-colors"></div>
        <div class="relative z-10">
            <h3 class="text-3xl font-bold text-white mb-1">{{ $testimonials->total() ?? 0 }}</h3>
            <p class="text-purple-400 text-sm font-medium">Total Ulasan</p>
        </div>
        <div class="mt-4 flex items-center gap-2 text-xs text-gray-400">
            <span class="material-symbols-outlined text-sm">star</span>
            <span>Kepuasan pelanggan</span>
        </div>
    </div>

    <div class="md:col-span-2 glass-card p-6 rounded-2xl border border-white/5 flex flex-col justify-center items-start">
        <h3 class="text-lg font-bold text-white mb-2">Kelola Ulasan Klien</h3>
        <p class="text-gray-400 text-sm mb-4 max-w-xl">Tampilkan testimoni terbaik dari klien untuk meningkatkan kepercayaan pengunjung website.</p>
        <a href="{{ route('admin.testimonials.create') }}" class="px-5 py-2.5 bg-primary hover:bg-primary-dark text-black font-bold rounded-xl shadow-lg shadow-primary/20 hover:shadow-primary/40 hover:-translate-y-1 transition-all flex items-center gap-2">
            <span class="material-symbols-outlined">add_circle</span>
            Tambah Testimoni Manual
        </a>
    </div>
</div>

{{-- Main Content --}}
<div class="glass-card rounded-2xl border border-white/5 overflow-hidden">
    {{-- Toolbar --}}
    <div class="p-6 border-b border-white/5 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-2 bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 focus-within:border-primary/50 focus-within:bg-white/10 transition-all w-full md:w-80">
            <span class="material-symbols-outlined text-gray-400">search</span>
            <input type="text" placeholder="Cari nama klien..." class="bg-transparent border-none text-white text-sm w-full focus:outline-none placeholder-gray-500">
        </div>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-white/5 text-gray-400 text-xs uppercase tracking-wider font-semibold border-b border-white/5">
                    <th class="p-6 w-20 text-center">No</th>
                    <th class="p-6">Info Klien</th>
                    <th class="p-6">Ulasan</th>
                    <th class="p-6">Rating</th>
                    <th class="p-6 text-center">Status</th>
                    <th class="p-6 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5 text-sm">
                @forelse($testimonials as $item)
                <tr class="group hover:bg-white/2 transition-colors">
                    <td class="p-6 text-center text-gray-500 font-mono">{{ $loop->iteration }}</td>

                    <td class="p-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-purple-500/10 border border-purple-500/20 overflow-hidden flex items-center justify-center relative">
                                @if($item->client_image)
                                <img src="{{ asset('storage/' . $item->client_image) }}" class="w-full h-full object-cover">
                                @else
                                <span class="text-purple-400 font-bold">{{ $item->initials }}</span>
                                @endif
                            </div>
                            <div>
                                <h4 class="font-bold text-white group-hover:text-primary transition-colors text-base">{{ $item->client_name }}</h4>
                                <p class="text-xs text-gray-500 mt-0.5">{{ $item->client_location ?? '-' }}</p>
                            </div>
                        </div>
                    </td>

                    <td class="p-6">
                        <div class="relative">
                            <span class="text-2xl text-white/10 font-serif absolute -top-3 -left-2">“</span>
                            <p class="text-gray-400 text-xs leading-relaxed line-clamp-2 max-w-sm pl-2">
                                {{ $item->testimonial_text }}
                            </p>
                        </div>
                    </td>

                    <td class="p-6">
                        <div class="flex items-center gap-0.5">
                            @foreach($item->stars as $star)
                            <span class="material-symbols-outlined text-yellow-500 text-lg fill-current">star</span>
                            @endforeach
                            @for($i = 0; $i < (5 - $item->rating); $i++)
                                <span class="material-symbols-outlined text-gray-700 text-lg">star</span>
                                @endfor
                        </div>
                    </td>

                    <td class="p-6 text-center">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded-full text-xs font-bold {{ $item->is_active ? 'bg-green-500/10 text-green-400 border border-green-500/20' : 'bg-red-500/10 text-red-400 border border-red-500/20' }}">
                            @if($item->is_active)
                            <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span> Aktif
                            @else
                            Nonaktif
                            @endif
                        </span>
                    </td>

                    <td class="p-6">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.testimonials.edit', $item->id) }}" class="p-2 rounded-lg text-blue-400 hover:bg-blue-500/10 hover:text-blue-300 transition-colors" title="Edit">
                                <span class="material-symbols-outlined text-lg">edit</span>
                            </a>

                            <button type="button"
                                onclick="openDeleteModal('{{ $item->id }}', '{{ $item->client_name }}')"
                                class="p-2 rounded-lg text-red-400 hover:bg-red-500/10 hover:text-red-300 transition-colors" title="Hapus">
                                <span class="material-symbols-outlined text-lg">delete</span>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-12 text-center">
                        <div class="flex flex-col items-center justify-center text-gray-500">
                            <div class="w-20 h-20 bg-white/5 rounded-full flex items-center justify-center mb-4">
                                <span class="material-symbols-outlined text-4xl opacity-50">reviews</span>
                            </div>
                            <h4 class="text-lg font-medium text-gray-300 mb-1">Belum ada testimoni</h4>
                            <p class="text-sm mb-6">Mulai tambahkan ulasan dari klien Anda.</p>
                            <a href="{{ route('admin.testimonials.create') }}" class="px-5 py-2 bg-primary text-black font-bold rounded-lg hover:bg-primary-dark transition-colors">
                                + Tambah Baru
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($testimonials instanceof \Illuminate\Pagination\LengthAwarePaginator && $testimonials->hasPages())
    <div class="p-6 border-t border-white/5">
        {{ $testimonials->links() }}
    </div>
    @endif
</div>

{{-- Delete Confirmation Modal --}}
<div id="deleteModal" class="fixed inset-0 z-50 hidden">
    {{-- Backdrop --}}
    <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" onclick="closeDeleteModal()"></div>

    {{-- Modal Content --}}
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="relative bg-linear-to-br from-gray-900 via-gray-900 to-gray-800 rounded-3xl border border-white/10 shadow-2xl shadow-black/50 w-full max-w-md transform transition-all duration-300 scale-95 opacity-0" id="deleteModalContent">
            {{-- Close Button --}}
            <button onclick="closeDeleteModal()" class="absolute top-4 right-4 p-2 rounded-full text-gray-400 hover:text-white hover:bg-white/10 transition-colors">
                <span class="material-symbols-outlined">close</span>
            </button>

            {{-- Icon --}}
            <div class="pt-8 pb-4 flex justify-center">
                <div class="w-20 h-20 bg-red-500/10 rounded-full flex items-center justify-center border-2 border-red-500/30 animate-pulse">
                    <span class="material-symbols-outlined text-red-400 text-4xl">delete_forever</span>
                </div>
            </div>

            {{-- Content --}}
            <div class="px-8 pb-4 text-center">
                <h3 class="text-xl font-bold text-white mb-2">Hapus Testimoni?</h3>
                <p class="text-gray-400 text-sm leading-relaxed">
                    Anda akan menghapus testimoni dari <span id="deleteItemName" class="text-red-400 font-semibold"></span>.
                    Tindakan ini tidak dapat dibatalkan.
                </p>
            </div>

            {{-- Actions --}}
            <div class="p-6 border-t border-white/5 flex items-center gap-3">
                <button type="button" onclick="closeDeleteModal()" class="flex-1 px-6 py-3 rounded-xl bg-white/5 border border-white/10 text-gray-300 font-bold hover:bg-white/10 transition-colors">
                    Batal
                </button>
                <form id="deleteForm" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full px-6 py-3 rounded-xl bg-linear-to-r from-red-500 to-red-600 text-white font-bold uppercase tracking-wider hover:shadow-lg hover:shadow-red-500/25 hover:scale-[1.02] transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-lg">delete</span>
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function openDeleteModal(id, name) {
        const modal = document.getElementById('deleteModal');
        const modalContent = document.getElementById('deleteModalContent');
        const deleteForm = document.getElementById('deleteForm');
        const deleteItemName = document.getElementById('deleteItemName');

        // Set the form action and item name
        deleteForm.action = `/admin/testimonials/${id}`;
        deleteItemName.textContent = name;

        // Show modal
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';

        // Animate in
        setTimeout(() => {
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');
        const modalContent = document.getElementById('deleteModalContent');

        // Animate out
        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');

        // Hide modal after animation
        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }, 200);
    }

    // Close modal on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeDeleteModal();
        }
    });
</script>
@endpush