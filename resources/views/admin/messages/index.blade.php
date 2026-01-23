@extends('admin.layouts.app')

@section('title', 'Kotak Masuk')
@section('page-title', 'Pesan Masuk')

@section('content')

{{-- Stats --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="glass-card p-6 rounded-2xl border border-white/5 bg-blue-500/5 relative overflow-hidden group">
        <div class="absolute -right-4 -top-4 w-24 h-24 bg-blue-500/20 rounded-full blur-2xl group-hover:bg-blue-500/30 transition-colors"></div>
        <div class="relative z-10">
            <h3 class="text-3xl font-bold text-white mb-1">{{ $messages->total() ?? 0 }}</h3>
            <p class="text-blue-400 text-sm font-medium">Total Pesan</p>
        </div>
    </div>
</div>

{{-- Main Content --}}
<div class="glass-card rounded-2xl border border-white/5 overflow-hidden">
    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-white/5 text-gray-400 text-xs uppercase tracking-wider font-semibold border-b border-white/5">
                    <th class="p-6">Pengirim</th>
                    <th class="p-6">Subjek</th>
                    <th class="p-6">Waktu</th>
                    <th class="p-6 text-center">Status</th>
                    <th class="p-6 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5 text-sm">
                @forelse($messages as $item)
                <tr class="group hover:bg-white/2 transition-colors {{ $item->is_read ? 'opacity-75' : 'bg-blue-500/5' }}">
                    <td class="p-6">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full bg-linear-to-br from-blue-500 to-cyan-600 flex items-center justify-center text-white font-bold text-lg shadow-lg">
                                {{ $item->initials }}
                            </div>
                            <div>
                                <h4 class="font-bold text-white group-hover:text-primary transition-colors text-base">{{ $item->full_name }}</h4>
                                <p class="text-xs text-gray-500 mt-0.5">{{ $item->email }}</p>
                            </div>
                        </div>
                    </td>

                    <td class="p-6">
                        <p class="text-white font-medium mb-1">{{ $item->service_type ?? 'Pesan Umum' }}</p>
                        <p class="text-gray-400 text-xs line-clamp-1">{{ $item->message }}</p>
                    </td>

                    <td class="p-6">
                        <div class="text-gray-400 text-xs">
                            <p class="text-gray-300 font-medium">{{ $item->created_at->diffForHumans() }}</p>
                            <p>{{ $item->created_at->format('d M Y H:i') }}</p>
                        </div>
                    </td>

                    <td class="p-6 text-center">
                        @if(!$item->is_read)
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-blue-500 text-white shadow-lg shadow-blue-500/20">
                            <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span> Baru
                        </span>
                        @else
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-white/5 text-gray-400 border border-white/10">
                            Dibaca
                        </span>
                        @endif
                    </td>

                    <td class="p-6">
                        <div class="flex items-center justify-end gap-2">
                            @if($item->phone)
                            @php
                            $phone = $item->phone;
                            if (str_starts_with($phone, '0')) {
                            $phone = '62' . substr($phone, 1);
                            } elseif (!str_starts_with($phone, '62')) {
                            $phone = '62' . $phone;
                            }
                            $phone = preg_replace('/[^0-9]/', '', $phone);
                            $waMsg = urlencode("Halo " . ($item->full_name ?? 'Bapak/Ibu') . ", terima kasih telah menghubungi Home Putra Interior. Ada yang bisa kami bantu?");
                            @endphp
                            <a href="https://wa.me/{{ $phone }}?text={{ $waMsg }}"
                                target="_blank"
                                class="p-2 rounded-lg text-green-400 hover:bg-green-500/10 hover:text-green-300 transition-colors"
                                title="Balas WhatsApp">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                                </svg>
                            </a>
                            @endif

                            <a href="{{ route('admin.messages.show', $item->id) }}" class="p-2 rounded-lg text-blue-400 hover:bg-blue-500/10 hover:text-blue-300 transition-colors" title="Baca Detail">
                                <span class="material-symbols-outlined text-lg">visibility</span>
                            </a>

                            <button type="button"
                                onclick="openDeleteModal('{{ $item->id }}', '{{ $item->full_name }}')"
                                class="p-2 rounded-lg text-red-400 hover:bg-red-500/10 hover:text-red-300 transition-colors" title="Hapus">
                                <span class="material-symbols-outlined text-lg">delete</span>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-12 text-center">
                        <div class="flex flex-col items-center justify-center text-gray-500">
                            <div class="w-16 h-16 bg-white/5 rounded-full flex items-center justify-center mb-4">
                                <span class="material-symbols-outlined text-3xl opacity-50">inbox</span>
                            </div>
                            <p class="text-sm">Belum ada pesan masuk.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($messages instanceof \Illuminate\Pagination\LengthAwarePaginator && $messages->hasPages())
    <div class="p-6 border-t border-white/5">
        {{ $messages->links() }}
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
                <h3 class="text-xl font-bold text-white mb-2">Hapus Pesan?</h3>
                <p class="text-gray-400 text-sm leading-relaxed">
                    Anda akan menghapus pesan dari <span id="deleteItemName" class="text-red-400 font-semibold"></span>.
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
        deleteForm.action = `/admin/messages/${id}`;
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