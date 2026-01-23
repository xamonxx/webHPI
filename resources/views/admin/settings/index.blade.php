@extends('admin.layouts.app')

@section('title', 'Pengaturan')
@section('page-title', 'Pengaturan Website')

@section('content')

<form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="space-y-8">

        {{-- Tab Navigation --}}
        <div class="flex flex-wrap gap-2 p-1 bg-black/20 border border-white/5 rounded-2xl" id="settings-tabs">
            <button type="button" onclick="switchTab('general')" data-tab="general"
                class="tab-btn flex-1 min-w-[140px] px-4 py-3 rounded-xl text-sm font-bold transition-all flex items-center justify-center gap-2 text-white bg-white/10 border border-white/10">
                <span class="material-symbols-outlined text-lg">tune</span>
                Umum
            </button>
            <button type="button" onclick="switchTab('contact')" data-tab="contact"
                class="tab-btn flex-1 min-w-[140px] px-4 py-3 rounded-xl text-sm font-bold transition-all flex items-center justify-center gap-2 text-gray-400 hover:text-white hover:bg-white/5">
                <span class="material-symbols-outlined text-lg">contact_page</span>
                Kontak
            </button>
            <button type="button" onclick="switchTab('social')" data-tab="social"
                class="tab-btn flex-1 min-w-[140px] px-4 py-3 rounded-xl text-sm font-bold transition-all flex items-center justify-center gap-2 text-gray-400 hover:text-white hover:bg-white/5">
                <span class="material-symbols-outlined text-lg">share</span>
                Sosial Media
            </button>
            <button type="button" onclick="switchTab('seo')" data-tab="seo"
                class="tab-btn flex-1 min-w-[140px] px-4 py-3 rounded-xl text-sm font-bold transition-all flex items-center justify-center gap-2 text-gray-400 hover:text-white hover:bg-white/5">
                <span class="material-symbols-outlined text-lg">search</span>
                SEO
            </button>
        </div>

        {{-- General Settings Tab --}}
        <div id="tab-general" class="tab-content space-y-6">
            <div class="glass-card p-6 rounded-2xl border border-white/5">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center">
                        <span class="material-symbols-outlined text-primary">tune</span>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-white">Pengaturan Umum</h3>
                        <p class="text-xs text-gray-500">Konfigurasi dasar website</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    {{-- Site Name --}}
                    <div class="group">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Nama Website</label>
                        <input type="text" name="site_name" value="{{ $settings['site_name'] ?? 'Home Putra Interior' }}"
                            class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-primary/50 focus:bg-black/40 transition-all font-medium"
                            placeholder="Nama website Anda">
                    </div>

                    {{-- Site Tagline --}}
                    <div class="group">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Tagline</label>
                        <input type="text" name="site_tagline" value="{{ $settings['site_tagline'] ?? '' }}"
                            class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-primary/50 focus:bg-black/40 transition-all font-medium"
                            placeholder="Slogan atau tagline">
                    </div>

                    {{-- Site Description --}}
                    <div class="lg:col-span-2 group">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Deskripsi Website</label>
                        <textarea name="site_description" rows="3"
                            class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-primary/50 focus:bg-black/40 transition-all"
                            placeholder="Deskripsi singkat tentang website...">{{ $settings['site_description'] ?? '' }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Logo & Favicon --}}
            <div class="glass-card p-6 rounded-2xl border border-white/5">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-blue-500/10 flex items-center justify-center">
                        <span class="material-symbols-outlined text-blue-400">image</span>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-white">Logo & Favicon</h3>
                        <p class="text-xs text-gray-500">Gambar identitas website</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    {{-- Logo Upload --}}
                    <div class="group">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Logo Website</label>
                        <div class="flex items-center gap-4">
                            <div class="w-20 h-20 bg-black/30 border border-white/10 rounded-xl flex items-center justify-center overflow-hidden">
                                @if(!empty($settings['site_logo']))
                                <img src="{{ Storage::url($settings['site_logo']) }}" alt="Logo" class="max-h-full max-w-full object-contain">
                                @else
                                <span class="material-symbols-outlined text-3xl text-gray-600">image</span>
                                @endif
                            </div>
                            <div class="flex-1">
                                <input type="file" name="site_logo" id="site_logo" accept="image/*" class="hidden"
                                    onchange="previewImage(this, 'logo-preview')">
                                <label for="site_logo"
                                    class="inline-flex items-center gap-2 px-4 py-2 bg-white/5 border border-white/10 rounded-xl text-sm text-gray-300 hover:bg-white/10 hover:text-white transition-all cursor-pointer">
                                    <span class="material-symbols-outlined text-lg">upload</span>
                                    Upload Logo
                                </label>
                                <p class="text-[10px] text-gray-500 mt-2">PNG, JPG, SVG, max 2MB</p>
                            </div>
                        </div>
                    </div>

                    {{-- Favicon Upload --}}
                    <div class="group">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Favicon</label>
                        <div class="flex items-center gap-4">
                            <div class="w-20 h-20 bg-black/30 border border-white/10 rounded-xl flex items-center justify-center overflow-hidden">
                                @if(!empty($settings['site_favicon']))
                                <img src="{{ Storage::url($settings['site_favicon']) }}" alt="Favicon" class="max-h-full max-w-full object-contain">
                                @else
                                <span class="material-symbols-outlined text-3xl text-gray-600">bookmark</span>
                                @endif
                            </div>
                            <div class="flex-1">
                                <input type="file" name="site_favicon" id="site_favicon" accept="image/*" class="hidden">
                                <label for="site_favicon"
                                    class="inline-flex items-center gap-2 px-4 py-2 bg-white/5 border border-white/10 rounded-xl text-sm text-gray-300 hover:bg-white/10 hover:text-white transition-all cursor-pointer">
                                    <span class="material-symbols-outlined text-lg">upload</span>
                                    Upload Favicon
                                </label>
                                <p class="text-[10px] text-gray-500 mt-2">PNG, ICO, max 512KB</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Contact Settings Tab --}}
        <div id="tab-contact" class="tab-content space-y-6 hidden">
            <div class="glass-card p-6 rounded-2xl border border-white/5">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-green-500/10 flex items-center justify-center">
                        <span class="material-symbols-outlined text-green-400">contact_page</span>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-white">Informasi Kontak</h3>
                        <p class="text-xs text-gray-500">Detail kontak yang tampil di website</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    {{-- Email --}}
                    <div class="group">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Email</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-gray-500 text-lg">mail</span>
                            <input type="email" name="contact_email" value="{{ $settings['contact_email'] ?? '' }}"
                                class="w-full bg-black/20 border border-white/10 rounded-xl pl-12 pr-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-green-500/50 focus:bg-black/40 transition-all font-medium"
                                placeholder="email@example.com">
                        </div>
                    </div>

                    {{-- Phone --}}
                    <div class="group">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Nomor Telepon</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-gray-500 text-lg">call</span>
                            <input type="text" name="contact_phone" value="{{ $settings['contact_phone'] ?? '' }}"
                                class="w-full bg-black/20 border border-white/10 rounded-xl pl-12 pr-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-green-500/50 focus:bg-black/40 transition-all font-medium"
                                placeholder="+62 812 3456 7890">
                        </div>
                    </div>

                    {{-- WhatsApp --}}
                    <div class="group">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">
                            Nomor WhatsApp
                            <span class="text-primary ml-1">(Penting!)</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-green-500">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                                </svg>
                            </span>
                            <input type="text" name="whatsapp_number" value="{{ $settings['whatsapp_number'] ?? '' }}"
                                class="w-full bg-black/20 border border-white/10 rounded-xl pl-12 pr-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-green-500/50 focus:bg-black/40 transition-all font-medium"
                                placeholder="628123456789">
                        </div>
                        <p class="text-[10px] text-gray-500 mt-2">
                            <span class="text-yellow-500">⚠️</span> Format: Tanpa tanda + atau spasi. Contoh: 628123456789
                        </p>
                    </div>

                    {{-- Address --}}
                    <div class="lg:col-span-2 group">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Alamat Lengkap</label>
                        <div class="relative">
                            <span class="absolute left-4 top-4 material-symbols-outlined text-gray-500 text-lg">location_on</span>
                            <textarea name="contact_address" rows="3"
                                class="w-full bg-black/20 border border-white/10 rounded-xl pl-12 pr-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-green-500/50 focus:bg-black/40 transition-all"
                                placeholder="Jl. Contoh No. 123, Kota, Provinsi">{{ $settings['contact_address'] ?? '' }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Social Media Settings Tab --}}
        <div id="tab-social" class="tab-content space-y-6 hidden">
            <div class="glass-card p-6 rounded-2xl border border-white/5">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-pink-500/10 flex items-center justify-center">
                        <span class="material-symbols-outlined text-pink-400">share</span>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-white">Sosial Media</h3>
                        <p class="text-xs text-gray-500">Link akun sosial media bisnis Anda</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    {{-- Instagram --}}
                    <div class="group">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Instagram</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-pink-500">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" />
                                </svg>
                            </span>
                            <input type="url" name="instagram_url" value="{{ $settings['instagram_url'] ?? '' }}"
                                class="w-full bg-black/20 border border-white/10 rounded-xl pl-12 pr-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-pink-500/50 focus:bg-black/40 transition-all font-medium"
                                placeholder="https://instagram.com/username">
                        </div>
                    </div>

                    {{-- Facebook --}}
                    <div class="group">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Facebook</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-blue-500">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                </svg>
                            </span>
                            <input type="url" name="facebook_url" value="{{ $settings['facebook_url'] ?? '' }}"
                                class="w-full bg-black/20 border border-white/10 rounded-xl pl-12 pr-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-blue-500/50 focus:bg-black/40 transition-all font-medium"
                                placeholder="https://facebook.com/pagename">
                        </div>
                    </div>

                    {{-- TikTok --}}
                    <div class="group">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">TikTok</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-white">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z" />
                                </svg>
                            </span>
                            <input type="url" name="tiktok_url" value="{{ $settings['tiktok_url'] ?? '' }}"
                                class="w-full bg-black/20 border border-white/10 rounded-xl pl-12 pr-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-white/50 focus:bg-black/40 transition-all font-medium"
                                placeholder="https://tiktok.com/@username">
                        </div>
                    </div>

                    {{-- YouTube --}}
                    <div class="group">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">YouTube</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-red-500">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                                </svg>
                            </span>
                            <input type="url" name="youtube_url" value="{{ $settings['youtube_url'] ?? '' }}"
                                class="w-full bg-black/20 border border-white/10 rounded-xl pl-12 pr-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-red-500/50 focus:bg-black/40 transition-all font-medium"
                                placeholder="https://youtube.com/@channel">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- SEO Settings Tab --}}
        <div id="tab-seo" class="tab-content space-y-6 hidden">
            <div class="glass-card p-6 rounded-2xl border border-white/5">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-purple-500/10 flex items-center justify-center">
                        <span class="material-symbols-outlined text-purple-400">search</span>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-white">Pengaturan SEO</h3>
                        <p class="text-xs text-gray-500">Optimasi mesin pencari</p>
                    </div>
                </div>

                <div class="space-y-6">
                    {{-- Meta Title --}}
                    <div class="group">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">
                            Meta Title
                            <span class="text-gray-600 normal-case font-normal ml-1">(max 70 karakter)</span>
                        </label>
                        <input type="text" name="seo_meta_title" value="{{ $settings['seo_meta_title'] ?? '' }}" maxlength="70"
                            class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-purple-500/50 focus:bg-black/40 transition-all font-medium"
                            placeholder="Judul yang muncul di hasil pencarian Google">
                        <div class="flex justify-between mt-1">
                            <p class="text-[10px] text-gray-500">Judul yang muncul di tab browser & hasil pencarian</p>
                            <span class="text-[10px] text-gray-500" id="title-count">0/70</span>
                        </div>
                    </div>

                    {{-- Meta Description --}}
                    <div class="group">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">
                            Meta Description
                            <span class="text-gray-600 normal-case font-normal ml-1">(max 160 karakter)</span>
                        </label>
                        <textarea name="seo_meta_description" rows="3" maxlength="160"
                            class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-purple-500/50 focus:bg-black/40 transition-all"
                            placeholder="Deskripsi singkat yang muncul di hasil pencarian...">{{ $settings['seo_meta_description'] ?? '' }}</textarea>
                        <div class="flex justify-between mt-1">
                            <p class="text-[10px] text-gray-500">Deskripsi yang muncul di bawah judul pada hasil pencarian</p>
                            <span class="text-[10px] text-gray-500" id="desc-count">0/160</span>
                        </div>
                    </div>

                    {{-- Keywords --}}
                    <div class="group">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Keywords</label>
                        <input type="text" name="seo_keywords" value="{{ $settings['seo_keywords'] ?? '' }}"
                            class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-purple-500/50 focus:bg-black/40 transition-all font-medium"
                            placeholder="interior, furniture, desain, renovation">
                        <p class="text-[10px] text-gray-500 mt-1">Pisahkan dengan koma</p>
                    </div>

                    {{-- Google Analytics --}}
                    <div class="group">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Google Analytics ID</label>
                        <input type="text" name="google_analytics_id" value="{{ $settings['google_analytics_id'] ?? '' }}"
                            class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-purple-500/50 focus:bg-black/40 transition-all font-mono"
                            placeholder="G-XXXXXXXXXX">
                        <p class="text-[10px] text-gray-500 mt-1">ID tracking dari Google Analytics 4</p>
                    </div>
                </div>
            </div>

            {{-- SEO Preview --}}
            <div class="glass-card p-6 rounded-2xl border border-white/5">
                <div class="flex items-center gap-3 mb-4">
                    <span class="material-symbols-outlined text-gray-400">preview</span>
                    <h4 class="text-sm font-bold text-gray-300">Preview di Google</h4>
                </div>
                <div class="bg-white rounded-xl p-4">
                    <p class="text-blue-800 text-lg font-medium hover:underline cursor-pointer" id="preview-title">
                        {{ $settings['seo_meta_title'] ?? 'Judul Website Anda' }}
                    </p>
                    <p class="text-green-700 text-sm">https://homeputra.com</p>
                    <p class="text-gray-600 text-sm mt-1" id="preview-desc">
                        {{ $settings['seo_meta_description'] ?? 'Deskripsi website Anda akan muncul di sini...' }}
                    </p>
                </div>
            </div>
        </div>

        {{-- Submit Button --}}
        <div class="flex items-center justify-end gap-4 pt-4">
            <button type="submit" class="px-8 py-4 rounded-xl bg-linear-to-r from-primary to-yellow-600 text-white font-bold uppercase tracking-wider hover:shadow-lg hover:shadow-primary/20 hover:scale-[1.01] transition-all flex items-center gap-2">
                <span class="material-symbols-outlined">save</span>
                Simpan Pengaturan
            </button>
        </div>

    </div>
</form>

@push('scripts')
<script>
    // Tab Switching
    function switchTab(tabName) {
        // Hide all tab contents
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.add('hidden');
        });

        // Show selected tab content
        document.getElementById('tab-' + tabName).classList.remove('hidden');

        // Update tab button styles
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('text-white', 'bg-white/10', 'border', 'border-white/10');
            btn.classList.add('text-gray-400', 'hover:text-white', 'hover:bg-white/5');
        });

        const activeBtn = document.querySelector('.tab-btn[data-tab="' + tabName + '"]');
        activeBtn.classList.remove('text-gray-400', 'hover:text-white', 'hover:bg-white/5');
        activeBtn.classList.add('text-white', 'bg-white/10', 'border', 'border-white/10');
    }

    // Character Counters
    document.addEventListener('DOMContentLoaded', function() {
        const titleInput = document.querySelector('input[name="seo_meta_title"]');
        const descInput = document.querySelector('textarea[name="seo_meta_description"]');
        const titleCount = document.getElementById('title-count');
        const descCount = document.getElementById('desc-count');
        const previewTitle = document.getElementById('preview-title');
        const previewDesc = document.getElementById('preview-desc');

        if (titleInput) {
            titleCount.textContent = titleInput.value.length + '/70';
            titleInput.addEventListener('input', function() {
                titleCount.textContent = this.value.length + '/70';
                previewTitle.textContent = this.value || 'Judul Website Anda';
            });
        }

        if (descInput) {
            descCount.textContent = descInput.value.length + '/160';
            descInput.addEventListener('input', function() {
                descCount.textContent = this.value.length + '/160';
                previewDesc.textContent = this.value || 'Deskripsi website Anda akan muncul di sini...';
            });
        }
    });
</script>
@endpush

@endsection