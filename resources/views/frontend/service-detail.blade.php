@extends('frontend.layouts.app')

@php
    $siteName = $settings['site_name'] ?? 'Home Putra Interior';
    $pageTitle = "{$service->title} - {$siteName}";
    $pageDescription = \Illuminate\Support\Str::limit(strip_tags($service->description ?? "Layanan {$service->title} dari {$siteName}."), 155);
    $serviceTitle = $service->title ?? 'Layanan Interior';
    $serviceTitleLower = \Illuminate\Support\Str::lower($serviceTitle);
    $serviceDetails = match (true) {
        str_contains($serviceTitleLower, 'kitchen') || str_contains($serviceTitleLower, 'dapur') => [
            ['icon' => 'straighten', 'title' => 'Layout Dapur Presisi', 'desc' => 'Ukuran kabinet, area kerja, jalur plumbing, listrik, dan sirkulasi dapur dipetakan sebelum produksi.'],
            ['icon' => 'countertops', 'title' => 'Material Mudah Dirawat', 'desc' => 'Finishing, top table, hardware, dan storage dipilih agar kitchen set kuat, rapi, dan nyaman dipakai harian.'],
            ['icon' => 'carpenter', 'title' => 'Instalasi Rapi', 'desc' => 'Produksi dan pemasangan kitchen set disesuaikan dengan kondisi ruang supaya hasil akhir presisi.'],
        ],
        str_contains($serviceTitleLower, 'wardrobe') || str_contains($serviceTitleLower, 'storage') || str_contains($serviceTitleLower, 'lemari') => [
            ['icon' => 'inventory_2', 'title' => 'Kebutuhan Storage Dihitung', 'desc' => 'Jumlah pakaian, barang, akses harian, dan dimensi ruang menjadi dasar pembagian kabinet.'],
            ['icon' => 'view_agenda', 'title' => 'Kompartemen Fungsional', 'desc' => 'Rak, gantungan, drawer, dan area tertutup dirancang agar penyimpanan lebih rapi dan mudah dijangkau.'],
            ['icon' => 'construction', 'title' => 'Finishing Menyatu', 'desc' => 'Warna, handle, dan material wardrobe disesuaikan dengan karakter kamar atau area penyimpanan.'],
        ],
        str_contains($serviceTitleLower, 'backdrop') || str_contains($serviceTitleLower, 'tv') || str_contains($serviceTitleLower, 'wall') => [
            ['icon' => 'tv', 'title' => 'Titik TV Dipetakan', 'desc' => 'Ukuran layar, stop kontak, jalur kabel, lighting, dan posisi pandang diatur sejak awal.'],
            ['icon' => 'dashboard_customize', 'title' => 'Panel Lebih Bersih', 'desc' => 'Backdrop dibuat untuk menyembunyikan kabel, merapikan focal point, dan memperkuat karakter ruang.'],
            ['icon' => 'lightbulb', 'title' => 'Detail Pencahayaan', 'desc' => 'Aksen lampu dan finishing panel disusun agar area TV terlihat elegan tanpa mengganggu fungsi ruang.'],
        ],
        str_contains($serviceTitleLower, 'furniture') || str_contains($serviceTitleLower, 'meja') || str_contains($serviceTitleLower, 'kabinet') => [
            ['icon' => 'design_services', 'title' => 'Ukuran Custom', 'desc' => 'Dimensi furniture dibuat mengikuti ruang, kebutuhan penyimpanan, dan aktivitas pengguna.'],
            ['icon' => 'chair', 'title' => 'Fungsi Diprioritaskan', 'desc' => 'Bentuk, komposisi, dan material dipilih agar furniture nyaman dipakai serta tidak membuang ruang.'],
            ['icon' => 'precision_manufacturing', 'title' => 'Produksi Terukur', 'desc' => 'Detail sambungan, finishing, dan hardware dikerjakan sesuai spesifikasi desain yang disepakati.'],
        ],
        str_contains($serviceTitleLower, 'renovasi') || str_contains($serviceTitleLower, 'renovation') => [
            ['icon' => 'home_repair_service', 'title' => 'Kondisi Existing Dicek', 'desc' => 'Area lama, kerusakan, ukuran, utilitas, dan batas pekerjaan dianalisis sebelum renovasi dimulai.'],
            ['icon' => 'engineering', 'title' => 'Tahapan Kerja Jelas', 'desc' => 'Pembongkaran, perbaikan, produksi, dan instalasi diatur agar pekerjaan lebih rapi dan terkontrol.'],
            ['icon' => 'verified', 'title' => 'Hasil Akhir Siap Pakai', 'desc' => 'Finishing dan detail akhir diperiksa agar ruang baru nyaman digunakan sesuai kebutuhan Anda.'],
        ],
        str_contains($serviceTitleLower, 'komersial') || str_contains($serviceTitleLower, 'kantor') || str_contains($serviceTitleLower, 'retail') => [
            ['icon' => 'storefront', 'title' => 'Alur Aktivitas Bisnis', 'desc' => 'Layout disusun berdasarkan kebutuhan operasional, area pelanggan, display, dan efisiensi kerja tim.'],
            ['icon' => 'groups', 'title' => 'Ruang Lebih Produktif', 'desc' => 'Desain mendukung kenyamanan pengguna, identitas brand, dan pengalaman pengunjung.'],
            ['icon' => 'schedule', 'title' => 'Pengerjaan Terjadwal', 'desc' => 'Produksi dan instalasi direncanakan agar dampak ke aktivitas bisnis bisa diminimalkan.'],
        ],
        default => [
            ['icon' => 'fact_check', 'title' => 'Kebutuhan Dipetakan', 'desc' => "Brief, ukuran ruang, fungsi, dan prioritas {$serviceTitle} dibahas sejak awal."],
            ['icon' => 'architecture', 'title' => 'Konsep Sesuai Layanan', 'desc' => "Rancangan {$serviceTitle} disesuaikan dengan aktivitas, karakter ruang, dan target anggaran."],
            ['icon' => 'verified', 'title' => 'Eksekusi Terukur', 'desc' => "Pengerjaan {$serviceTitle} dijalankan dengan alur kerja yang rapi dari awal sampai akhir."],
        ],
    };
@endphp

@section('title', $pageTitle)
@section('meta_title', $pageTitle)
@section('meta_description', $pageDescription)
@section('og_title', $pageTitle)
@section('og_description', $pageDescription)
@section('twitter_title', $pageTitle)
@section('twitter_description', $pageDescription)

@section('content')
<div class="bg-background-dark text-white min-h-screen">
    <section class="relative overflow-hidden pt-28 pb-16 sm:pt-36 sm:pb-24">
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute -top-24 right-0 h-96 w-96 rounded-full bg-primary/10 blur-[140px]"></div>
            <div class="absolute bottom-0 left-0 h-80 w-80 rounded-full bg-white/5 blur-[120px]"></div>
        </div>

        <div class="relative z-10 mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <nav class="mb-10 flex flex-wrap items-center gap-3 text-xs font-bold uppercase tracking-widest text-gray-500">
                <a href="{{ route('home') }}" class="hover:text-primary transition-colors">Beranda</a>
                <span class="material-symbols-outlined text-base">chevron_right</span>
                <a href="{{ route('services.all') }}" class="hover:text-primary transition-colors">Layanan</a>
                <span class="material-symbols-outlined text-base">chevron_right</span>
                <span class="text-primary">{{ $service->title }}</span>
            </nav>

            <div class="grid items-center gap-10 lg:grid-cols-[1.1fr_0.9fr]">
                <div>
                    <div class="mb-6 inline-flex items-center gap-2 rounded-full border border-primary/25 bg-primary/10 px-4 py-2">
                        <span class="h-1.5 w-1.5 rounded-full bg-primary"></span>
                        <span class="text-[10px] font-bold uppercase tracking-[0.24em] text-primary">Detail Layanan</span>
                    </div>

                    <h1 class="max-w-4xl text-4xl font-bold leading-tight text-white sm:text-5xl lg:text-7xl">
                        {{ $service->title }}
                    </h1>

                    <p class="mt-6 max-w-3xl text-base leading-relaxed text-gray-300 sm:text-lg">
                        {{ $service->description }}
                    </p>

                    <div class="mt-9 flex flex-col gap-3 sm:flex-row">
                        <a href="{{ route('home') }}#contact" class="inline-flex min-h-14 items-center justify-center gap-3 rounded-full bg-primary px-8 text-sm font-bold uppercase tracking-wider text-black transition-colors hover:bg-white">
                            <span>Konsultasi Gratis</span>
                            <span class="material-symbols-outlined text-lg">arrow_forward</span>
                        </a>
                        <a href="{{ route('portfolio.all') }}" class="inline-flex min-h-14 items-center justify-center gap-3 rounded-full border border-white/15 bg-white/5 px-8 text-sm font-bold uppercase tracking-wider text-white transition-colors hover:border-primary/50 hover:text-primary">
                            <span>Lihat Portofolio</span>
                            <span class="material-symbols-outlined text-lg">photo_library</span>
                        </a>
                    </div>
                </div>

                <div class="relative">
                    <div class="absolute inset-0 rounded-[2rem] bg-primary/20 blur-3xl"></div>
                    <div class="relative rounded-[2rem] border border-white/10 bg-white/[0.04] p-8 shadow-2xl shadow-black/30 backdrop-blur-xl">
                        <div class="mb-10 flex h-20 w-20 items-center justify-center rounded-2xl bg-primary/15">
                            <span class="material-symbols-outlined text-4xl text-primary">{{ $service->icon ?: 'design_services' }}</span>
                        </div>

                        <div class="grid gap-5">
                            @foreach($serviceDetails as $item)
                            <div class="flex gap-4 rounded-2xl border border-white/8 bg-black/10 p-4">
                                <span class="material-symbols-outlined text-primary">{{ $item['icon'] }}</span>
                                <div>
                                    <h2 class="font-bold text-white">{{ $item['title'] }}</h2>
                                    <p class="mt-1 text-sm leading-relaxed text-gray-400">{{ $item['desc'] }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if($relatedServices->count() > 0)
    <section class="pb-16 sm:pb-24">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="mb-8 flex items-end justify-between gap-4">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-[0.24em] text-primary">Layanan Lainnya</span>
                    <h2 class="mt-2 text-3xl font-serif text-white">Eksplor Layanan</h2>
                </div>
                <a href="{{ route('services.all') }}" class="hidden text-sm font-bold uppercase tracking-widest text-gray-400 transition-colors hover:text-primary sm:inline-flex">
                    Semua Layanan
                </a>
            </div>

            <div class="grid gap-5 md:grid-cols-3">
                @foreach($relatedServices as $related)
                <a href="{{ route('services.show', $related) }}" class="group rounded-2xl border border-white/10 bg-white/[0.04] p-6 transition-all hover:-translate-y-1 hover:border-primary/30 hover:bg-white/[0.07]">
                    <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-primary/10">
                        <span class="material-symbols-outlined text-primary">{{ $related->icon ?: 'design_services' }}</span>
                    </div>
                    <h3 class="text-lg font-bold text-white transition-colors group-hover:text-primary">{{ $related->title }}</h3>
                    <p class="mt-3 line-clamp-3 text-sm leading-relaxed text-gray-400">{{ $related->description }}</p>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif
</div>
@endsection
