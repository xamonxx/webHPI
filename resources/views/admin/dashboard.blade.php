@extends('admin.layouts.app')

@section('title', 'Dashboard Overview')
@section('page-title', 'Dashboard')

@section('content')

{{-- Welcome Banner --}}
<div class="mb-8 relative overflow-hidden rounded-2xl bg-linear-to-r from-primary/20 to-transparent p-1 border border-primary/10">
    <div class="relative z-10 glass-card bg-black/40 rounded-xl p-6 flex flex-col md:flex-row items-center justify-between gap-6">
        <div>
            <h2 class="text-2xl font-bold text-white mb-2">Selamat Datang, {{ auth()->user()->display_name ?? 'Admin' }}! 👋</h2>
            <p class="text-gray-400 text-sm">Berikut adalah ringkasan kinerja website Home Putra Interior hari ini.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.portfolio.create') }}" class="px-5 py-2.5 bg-primary hover:bg-primary-dark text-black font-bold rounded-lg transition-all shadow-lg shadow-primary/20 hover:shadow-primary/40 flex items-center gap-2 text-sm">
                <span class="material-symbols-outlined text-xl">add_photo_alternate</span>
                Upload Portfolio
            </a>
        </div>
    </div>
</div>

{{-- Stats Grid --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

    {{-- Portfolio Stats --}}
    <x-admin-stat-card
        title="Total Portfolio"
        value="{{ $stats['portfolios'] }}"
        icon="photo_library"
        color="blue"
        route="{{ route('admin.portfolio.index') }}"
        trend="+2 bulan ini" />

    {{-- Services Card --}}
    <x-admin-stat-card
        title="Layanan"
        value="{{ $stats['services'] ?? 0 }}"
        icon="design_services"
        color="green"
        route="{{ route('admin.services.index') }}"
        trend="+1 Layanan baru" />

    {{-- Testimonials Card --}}
    <x-admin-stat-card
        title="Testimoni"
        value="{{ $stats['testimonials'] ?? 0 }}"
        icon="reviews"
        color="purple"
        route="{{ route('admin.testimonials.index') }}"
        trend="4.8 Rata-rata" />
    {{-- Messages Stats --}}
    <x-admin-stat-card
        title="Pesan Masuk"
        value="{{ $stats['unread_messages'] ?? 0 }}"
        icon="mail"
        color="orange"
        route="{{ route('admin.messages.index') }}"
        trend="Perlu dibalas"
        :is_alert="$stats['unread_messages'] > 0" />
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    {{-- Recent Messages --}}
    <div class="lg:col-span-2 glass-card rounded-2xl overflow-hidden border border-white/5 flex flex-col h-full">
        <div class="p-6 border-b border-white/5 flex items-center justify-between">
            <h3 class="text-lg font-bold text-white flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">chat</span>
                Pesan Terbaru
            </h3>
            <a href="{{ route('admin.messages.index') }}" class="text-xs text-primary hover:text-white transition-colors">Lihat Semua</a>
        </div>

        <div class="flex-1 overflow-y-auto max-h-[400px] custom-scrollbar">
            @forelse($recentMessages as $message)
            <a href="{{ route('admin.messages.show', $message->id) }}" class="group block p-4 hover:bg-white/5 transition-all border-b border-white/5 last:border-0">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-full bg-linear-to-br from-gray-800 to-black border border-white/10 flex items-center justify-center text-primary font-bold shadow-lg group-hover:scale-110 transition-transform">
                        {{ $message->initials ?? substr($message->name ?? '?', 0, 2) }}
                    </div>
                    <div class="flex-1 min-w-0 pt-1">
                        <div class="flex items-center justify-between mb-1">
                            <h4 class="text-sm font-bold text-white group-hover:text-primary transition-colors truncate">
                                {{ $message->full_name ?? $message->name ?? 'Guest' }}
                            </h4>
                            <span class="text-[10px] text-gray-500 bg-black/30 px-2 py-0.5 rounded-full border border-white/5">
                                {{ $message->created_at->diffForHumans() }}
                            </span>
                        </div>
                        <p class="text-xs text-gray-400 line-clamp-2 leading-relaxed">
                            {{ $message->message ?: 'Tidak ada isi pesan.' }}
                        </p>
                    </div>
                </div>
            </a>
            @empty
            <div class="h-64 flex flex-col items-center justify-center text-gray-500 gap-3">
                <div class="w-16 h-16 rounded-full bg-white/5 flex items-center justify-center">
                    <span class="material-symbols-outlined text-3xl opacity-50">inbox</span>
                </div>
                <p class="text-sm">Belum ada pesan baru.</p>
            </div>
            @endforelse
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="glass-card rounded-2xl p-6 border border-white/5 h-full">
        <h3 class="text-lg font-bold text-white mb-6 flex items-center gap-2">
            <span class="material-symbols-outlined text-yellow-500">bolt</span>
            Aksi Cepat
        </h3>

        <div class="grid grid-cols-1 gap-3">
            <x-admin-action-button
                label="Tambah Portfolio"
                desc="Upload karya terbaru"
                icon="add_photo_alternate"
                color="blue"
                route="{{ route('admin.portfolio.create') }}" />

            <x-admin-action-button
                label="Buat Layanan"
                desc="Tawarkan jasa baru"
                icon="design_services"
                color="green"
                route="{{ route('admin.services.create') }}" />

            <x-admin-action-button
                label="Tulis Testimoni"
                desc="Input manual ulasan"
                icon="rate_review"
                color="purple"
                route="{{ route('admin.testimonials.create') }}" />

            <x-admin-action-button
                label="Pengaturan Website"
                desc="SEO & Konfigurasi"
                icon="settings"
                color="gray"
                route="#" />
        </div>
    </div>
</div>

@endsection