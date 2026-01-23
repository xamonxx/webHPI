<!DOCTYPE html>
<html lang="id" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - Admin Panel | Home Putra Interior</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,500;1,600&family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link href="{{ asset('assets/css/material-symbols.css') }}" rel="stylesheet">
    <!-- Custom CSS (Shared with Frontend) -->
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">

    <!-- Styles (Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Admin Specific Overrides */
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
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
</body>

</html>