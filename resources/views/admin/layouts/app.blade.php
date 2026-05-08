<!DOCTYPE html>
<html lang="id" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - Admin Panel | Home Putra Interior</title>

    <!-- Local Fonts -->
    <link href="{{ asset('assets/css/fonts.css') }}" rel="stylesheet">

    <!-- Icons -->
    <link href="{{ asset('assets/css/material-symbols.css') }}" rel="stylesheet">
    <!-- Custom CSS (Shared with Frontend) -->
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">

    <!-- Styles (Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Admin Specific Overrides */
        body {
            font-family: 'Montserrat', sans-serif;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #0B0D11;
        }

        ::-webkit-scrollbar-thumb {
            background: #333;
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #ffb204;
        }

        /* Glass Utility */
        .glass-card {
            background: rgba(20, 20, 20, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
    </style>
    @stack('styles')
</head>

<body class="bg-background-dark min-h-screen text-gray-300 overflow-x-hidden selection:bg-primary/30 selection:text-white">
    <div id="admin-toast-container" class="fixed top-5 right-5 z-[99999] flex w-full max-w-sm flex-col gap-3 pointer-events-none"></div>

    <!-- Background Decor -->
    <div class="fixed inset-0 z-0 pointer-events-none">
        <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-primary/5 rounded-full blur-[120px] -translate-x-1/2 -translate-y-1/2 opacity-50"></div>
        <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-blue-500/5 rounded-full blur-[120px] translate-x-1/2 translate-y-1/2 opacity-30"></div>
    </div>

    <div class="relative z-10 flex h-screen overflow-hidden">
        {{-- Sidebar --}}
        @include('admin.partials.sidebar')

        {{-- Main Content Wrapper --}}
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden lg:ml-72 transition-all duration-300">

            {{-- Header --}}
            @include('admin.partials.header')

            {{-- Content Scroll Area --}}
            <main class="flex-1 overflow-y-auto p-4 lg:p-8 scroll-smooth">
                <div class="max-w-7xl mx-auto w-full">
                    {{-- Flash Messages --}}
                    @if(session('success'))
                    <div class="mb-6 p-4 glass-card bg-green-500/10 border-green-500/20 rounded-xl text-green-400 text-sm font-medium flex items-center gap-3 animate-fade-in-down shadow-lg shadow-green-900/10">
                        <span class="material-symbols-outlined filled">check_circle</span>
                        {{ session('success') }}
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="mb-6 p-4 glass-card bg-red-500/10 border-red-500/20 rounded-xl text-red-400 text-sm font-medium flex items-center gap-3 animate-fade-in-down shadow-lg shadow-red-900/10">
                        <span class="material-symbols-outlined filled">error</span>
                        {{ session('error') }}
                    </div>
                    @endif

                    {{-- Page Content --}}
                    @yield('content')

                    <div class="h-10"></div> {{-- Spacer --}}
                </div>
            </main>
        </div>
    </div>

    @stack('scripts')
    <script>
        window.showAdminToast = function(message, type = 'error') {
            if (!message) return;

            const container = document.getElementById('admin-toast-container');
            if (!container) return;

            const palette = {
                success: 'border-green-500/30 bg-green-500/15 text-green-300',
                error: 'border-red-500/30 bg-red-500/15 text-red-300',
                info: 'border-blue-500/30 bg-blue-500/15 text-blue-300',
            };

            const icons = {
                success: 'check_circle',
                error: 'error',
                info: 'info',
            };

            const toast = document.createElement('div');
            toast.className = `pointer-events-auto translate-x-6 opacity-0 transition-all duration-300 rounded-2xl border px-4 py-3 shadow-2xl backdrop-blur-xl ${palette[type] || palette.error}`;
            toast.innerHTML = `
                <div class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-lg leading-none mt-0.5">${icons[type] || icons.error}</span>
                    <p class="text-sm font-medium leading-relaxed">${message}</p>
                </div>
            `;

            container.appendChild(toast);

            requestAnimationFrame(() => {
                toast.classList.remove('translate-x-6', 'opacity-0');
            });

            setTimeout(() => {
                toast.classList.add('translate-x-6', 'opacity-0');
                setTimeout(() => toast.remove(), 300);
            }, 5000);
        };

        document.addEventListener('DOMContentLoaded', () => {
            const notifications = [
                { message: @json(session('success')), type: 'success' },
                { message: @json(session('error')), type: 'error' },
                { message: @json($errors->first()), type: 'error' },
            ];

            notifications
                .filter(item => item.message)
                .forEach(item => window.showAdminToast(item.message, item.type));
        });
    </script>
</body>

</html>
