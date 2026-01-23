{{-- Admin Sidebar (God-Tier) --}}

<aside class="fixed inset-y-0 left-0 z-50 w-72 bg-[#0B0D11]/90 backdrop-blur-xl border-r border-white/5 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 flex flex-col" id="admin-sidebar">

    {{-- Logo Area --}}
    <div class="h-24 flex items-center px-8 border-b border-white/5 relative overflow-hidden group">
        <div class="absolute inset-0 bg-primary/5 translate-y-full group-hover:translate-y-0 transition-transform duration-500"></div>
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 relative z-10">
            <div class="w-10 h-10 rounded-xl bg-linear-to-br from-primary to-yellow-600 flex items-center justify-center shadow-lg shadow-primary/20">
                <span class="material-symbols-outlined text-white text-xl">grid_view</span>
            </div>
            <div>
                <h1 class="text-lg font-bold text-white tracking-tight leading-none">Home<span class="text-primary">Putra</span></h1>
                <p class="text-[10px] text-gray-500 font-medium uppercase tracking-widest mt-1">Admin Panel</p>
            </div>
        </a>
        <button class="lg:hidden absolute right-4 text-gray-400 hover:text-white" onclick="toggleSidebar()">
            <span class="material-symbols-outlined">close</span>
        </button>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto custom-scrollbar">
        <p class="px-4 text-[10px] font-bold text-gray-500 uppercase tracking-[0.2em] mb-3">Menu Utama</p>

        <x-admin-nav-link route="admin.dashboard" icon="dashboard" label="Dashboard" />
        <x-admin-nav-link route="admin.hero.index" icon="wallpaper" label="Hero Section" active="admin.hero.*" />
        <x-admin-nav-link route="admin.portfolio.index" icon="photo_library" label="Portfolio" active="admin.portfolio.*" />
        <x-admin-nav-link route="admin.services.index" icon="design_services" label="Layanan" active="admin.services.*" />
        <x-admin-nav-link route="admin.testimonials.index" icon="rate_review" label="Testimoni" active="admin.testimonials.*" />
        <x-admin-nav-link route="admin.statistics.index" icon="analytics" label="Statistik" active="admin.statistics.*" />
        <x-admin-nav-link route="admin.messages.index" icon="mail" label="Inbox Pesan" active="admin.messages.*" />
        <x-admin-nav-link route="#" icon="calculate" label="Kalkulator" />

        <p class="px-4 text-[10px] font-bold text-gray-500 uppercase tracking-[0.2em] mt-8 mb-3">Sistem</p>
        <x-admin-nav-link route="admin.settings.index" icon="settings" label="Pengaturan" active="admin.settings.*" />
        <x-admin-nav-link route="#" icon="group" label="Manajemen User" />

        {{-- Divider --}}
        <div class="my-6 border-t border-white/5 text-center">
            <span class="relative -top-3 bg-[#0B0D11] px-2 text-[10px] text-gray-600">Shortcuts</span>
        </div>

        <a href="{{ route('home') }}" target="_blank"
            class="group flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-gray-400 hover:text-white hover:bg-white/5 transition-all duration-300">
            <span class="material-symbols-outlined text-xl group-hover:scale-110 transition-transform text-gray-500 group-hover:text-primary">public</span>
            <span>Lihat Website</span>
            <span class="material-symbols-outlined text-xs ml-auto opacity-0 group-hover:opacity-100 -translate-x-2 group-hover:translate-x-0 transition-all">arrow_outward</span>
        </a>
    </nav>

    {{-- User Profile Snippet --}}
    <div class="p-4 border-t border-white/5 bg-black/20">
        <div class="flex items-center gap-3 p-3 rounded-xl bg-white/5 border border-white/5 hover:border-primary/30 transition-colors group cursor-pointer">
            <div class="w-10 h-10 rounded-full bg-linear-to-tr from-gray-700 to-gray-600 flex items-center justify-center text-white font-bold text-sm border-2 border-[#0B0D11] shadow-lg">
                AD
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-bold text-white truncate group-hover:text-primary transition-colors">Admin Super</p>
                <p class="text-[10px] text-gray-500 truncate">admin@homeputra.com</p>
            </div>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="p-2 rounded-lg text-gray-400 hover:text-red-500 hover:bg-red-500/10 transition-colors" title="Logout">
                    <span class="material-symbols-outlined text-lg">logout</span>
                </button>
            </form>
        </div>
    </div>
</aside>

{{-- Sidebar Overlay --}}
<div class="fixed inset-0 bg-black/80 backdrop-blur-sm z-40 lg:hidden hidden transition-opacity duration-300" id="sidebar-overlay" onclick="toggleSidebar()"></div>

@push('scripts')
<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('admin-sidebar');
        const overlay = document.getElementById('sidebar-overlay');

        if (sidebar.classList.contains('-translate-x-full')) {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
            setTimeout(() => overlay.classList.remove('opacity-0'), 10);
        } else {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('opacity-0');
            setTimeout(() => overlay.classList.add('hidden'), 300);
        }
    }
</script>
@endpush