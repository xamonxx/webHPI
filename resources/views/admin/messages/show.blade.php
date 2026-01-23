@extends('admin.layouts.app')

@section('title', 'Detail Pesan')
@section('page-title', 'Pesan Masuk / Detail')

@section('content')

<div class="max-w-4xl mx-auto">
    <div class="glass-card rounded-2xl border border-white/5 overflow-hidden">
        {{-- Header --}}
        <div class="p-8 border-b border-white/5 bg-white/2">
            <div class="flex items-start justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-full bg-linear-to-br from-blue-500 to-cyan-600 flex items-center justify-center text-white font-bold text-2xl shadow-lg shadow-blue-500/20">
                        {{ $message->initials }}
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-white mb-1">{{ $message->service_type ?? 'Pesan Umum' }}</h1>
                        <div class="flex items-center gap-2 text-sm text-gray-400">
                            <span class="font-medium text-gray-300">{{ $message->full_name }}</span>
                            <span>&lt;{{ $message->email }}&gt;</span>
                        </div>
                    </div>
                </div>

                <div class="text-right">
                    <p class="text-sm font-medium text-gray-300">{{ $message->created_at->translatedFormat('l, d F Y') }}</p>
                    <p class="text-xs text-gray-500">{{ $message->created_at->format('H:i') }} WIB</p>
                </div>
            </div>
        </div>

        {{-- Meta Data --}}
        <div class="p-6 bg-black/20 border-b border-white/5 grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
            <div>
                <span class="text-gray-500 block text-xs uppercase tracking-wider mb-1">Nomor Telepon</span>
                <span class="text-white font-mono">{{ $message->phone ?? '-' }}</span>
            </div>
            <div>
                <span class="text-gray-500 block text-xs uppercase tracking-wider mb-1">Status</span>
                <span class="text-green-400 flex items-center gap-1">
                    <span class="material-symbols-outlined text-base">mark_email_read</span> Dibaca
                </span>
            </div>
        </div>

        {{-- Body --}}
        <div class="p-8 min-h-[300px] text-gray-300 leading-relaxed whitespace-pre-wrap font-sans text-base">
            {{ $message->message }}
        </div>

        {{-- Actions --}}
        <div class="p-6 border-t border-white/5 bg-white/2 flex items-center justify-between">
            <a href="{{ route('admin.messages.index') }}" class="px-4 py-2 rounded-lg hover:bg-white/5 text-gray-400 hover:text-white transition-colors flex items-center gap-2 text-sm font-bold">
                <span class="material-symbols-outlined">arrow_back</span>
                Kembali
            </a>

            <div class="flex items-center gap-3">
                @if($message->phone)
                @php
                // Format phone number for WhatsApp (remove leading 0, add 62)
                $phone = $message->phone;
                if (str_starts_with($phone, '0')) {
                $phone = '62' . substr($phone, 1);
                } elseif (!str_starts_with($phone, '62')) {
                $phone = '62' . $phone;
                }
                // Remove any non-numeric characters
                $phone = preg_replace('/[^0-9]/', '', $phone);

                // Create WhatsApp message template
                $waMessage = urlencode("Halo " . ($message->full_name ?? 'Bapak/Ibu') . ",\n\nTerima kasih telah menghubungi Home Putra Interior.\n\nKami telah menerima pesan Anda mengenai \"" . ($message->service_type ?? 'layanan kami') . "\".\n\nApakah ada yang bisa kami bantu lebih lanjut?\n\nSalam hangat,\nTim Home Putra Interior");
                @endphp
                <a href="https://wa.me/{{ $phone }}?text={{ $waMessage }}"
                    target="_blank"
                    class="px-5 py-2 bg-green-600 hover:bg-green-500 text-white font-bold rounded-lg shadow-lg shadow-green-500/20 transition-all flex items-center gap-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                    </svg>
                    Balas WhatsApp
                </a>
                @endif

                <a href="mailto:{{ $message->email }}?subject=Re: {{ $message->service_type ?? 'Pesan' }}" class="px-5 py-2 bg-blue-600 hover:bg-blue-500 text-white font-bold rounded-lg shadow-lg shadow-blue-500/20 transition-all flex items-center gap-2">
                    <span class="material-symbols-outlined">reply</span>
                    Balas Email
                </a>

                <button type="button"
                    onclick="openDeleteModal('{{ $message->id }}', '{{ $message->full_name }}')"
                    class="px-4 py-2 bg-red-500/10 hover:bg-red-500/20 text-red-500 font-bold rounded-lg transition-colors flex items-center gap-2">
                    <span class="material-symbols-outlined">delete</span>
                    Hapus
                </button>
            </div>
        </div>
    </div>
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