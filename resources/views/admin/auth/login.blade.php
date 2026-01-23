<!DOCTYPE html>
<html lang="id" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Access - Admin Panel | Home Putra Interior</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link href="{{ asset('assets/css/material-symbols.css') }}" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="min-h-screen bg-[#050608] flex items-center justify-center p-4 relative overflow-hidden">

    {{-- Cinematic Background --}}
    <div class="fixed inset-0 pointer-events-none">
        <div class="absolute top-[-10%] left-[-10%] w-[600px] h-[600px] bg-primary/10 rounded-full blur-[150px] opacity-40 animate-pulse"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[600px] h-[600px] bg-blue-600/10 rounded-full blur-[150px] opacity-30"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0IiBoZWlnaHQ9IjQiPgo8cmVjdCB3aWR0aD0iNCIgaGVpZ2h0PSI0IiBmaWxsPSIjZmZmIiBmaWxsLW9wYWNpdHk9IjAuMDI1Ii8+Cjwvc3ZnPg==')] opacity-20"></div>
    </div>

    <div class="relative w-full max-w-[400px] z-10 transition-all duration-700 ease-out transform translate-y-0 opacity-100">
        {{-- Brand --}}
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-linear-to-tr from-surface-dark to-black border border-white/10 rounded-2xl shadow-2xl shadow-primary/10 mb-6 relative group cursor-default">
                <div class="absolute inset-0 bg-primary/20 blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <span class="material-symbols-outlined text-4xl text-primary relative z-10">verified_user</span>
            </div>
            <h1 class="text-3xl font-extrabold text-white tracking-tight">Admin<span class="text-primary">Panel</span></h1>
            <p class="text-gray-500 font-medium text-sm mt-2">Secure Access Gateway</p>
        </div>

        {{-- Login Card --}}
        <div class="bg-[#0B0D11]/60 backdrop-blur-xl border border-white/5 rounded-3xl p-8 shadow-2xl relative overflow-hidden group-hover:border-primary/20 transition-colors">

            {{-- Loading State (Hidden by default) --}}
            <div id="loading-overlay" class="absolute inset-0 bg-black/80 backdrop-blur-sm z-20 hidden flex-col items-center justify-center fade-in">
                <div class="w-10 h-10 border-4 border-primary/30 border-t-primary rounded-full animate-spin mb-4"></div>
                <p class="text-white font-medium text-sm tracking-widest uppercase">Authenticating</p>
            </div>

            @if($errors->any())
            <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 rounded-xl flex items-start gap-3 animate-shake">
                <span class="material-symbols-outlined text-red-400 mt-0.5">gpp_maybe</span>
                <div>
                    <h4 class="text-red-400 font-bold text-sm">Login Gagal</h4>
                    <p class="text-red-400/80 text-xs mt-1">{{ $errors->first() }}</p>
                </div>
            </div>
            @endif

            <form method="POST" action="{{ route('admin.login') }}" onsubmit="document.getElementById('loading-overlay').style.display = 'flex'">
                @csrf
                <div class="space-y-5">

                    {{-- Username --}}
                    <div class="group">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2 ml-1 group-focus-within:text-primary transition-colors">Username</label>
                        <div class="relative transition-all duration-300 transform group-focus-within:-translate-y-1">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 group-focus-within:text-primary transition-colors">person</span>
                            <input
                                type="text"
                                name="username"
                                value="{{ old('username') }}"
                                class="w-full h-12 pl-12 pr-4 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-600 focus:outline-none focus:bg-[#0B0D11] focus:border-primary/50 focus:shadow-[0_0_15px_rgba(255,178,4,0.1)] transition-all font-medium"
                                placeholder="Enter username"
                                required
                                autofocus>
                        </div>
                    </div>

                    {{-- Password --}}
                    <div class="group">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2 ml-1 group-focus-within:text-primary transition-colors">Password</label>
                        <div class="relative transition-all duration-300 transform group-focus-within:-translate-y-1">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 group-focus-within:text-primary transition-colors">lock</span>
                            <input
                                type="password"
                                name="password"
                                class="w-full h-12 pl-12 pr-4 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-600 focus:outline-none focus:bg-[#0B0D11] focus:border-primary/50 focus:shadow-[0_0_15px_rgba(255,178,4,0.1)] transition-all font-medium tracking-widest"
                                placeholder="••••••••"
                                required>
                        </div>
                    </div>

                    <button
                        type="submit"
                        class="w-full h-12 bg-linear-to-r from-primary to-yellow-600 hover:to-primary text-black font-bold uppercase tracking-wider rounded-xl shadow-lg shadow-primary/20 hover:shadow-primary/40 hover:scale-[1.02] active:scale-[0.98] transition-all duration-300 flex items-center justify-center gap-2 mt-2">
                        <span>Sign In Securely</span>
                        <span class="material-symbols-outlined text-lg">arrow_forward</span>
                    </button>
                </div>
            </form>
        </div>

        {{-- Footer --}}
        <p class="text-center text-gray-600 text-xs mt-8">
            &copy; {{ date('Y') }} Home Putra CMS &bull; v2.0
        </p>
    </div>

    <style>
        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-5px);
            }

            75% {
                transform: translateX(5px);
            }
        }

        .animate-shake {
            animation: shake 0.4s ease-in-out;
        }
    </style>
</body>

</html>