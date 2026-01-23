@props([
'route' => '#',
'icon' => 'circle',
'label' => 'Link',
'active' => null,
'badge' => null
])

@php
$isActive = request()->routeIs($active ?? $route);

$bgClass = $isActive
? 'bg-gradient-to-r from-primary/20 to-transparent border-l-2 border-primary text-white shadow-[0_0_20px_rgba(255,178,4,0.1)]'
: 'text-gray-400 hover:text-white hover:bg-white/5 border-l-2 border-transparent';

$iconClass = $isActive
? 'text-primary'
: 'text-gray-500 group-hover:text-white';

// Handle # routes
$href = ($route === '#') ? '#' : route($route);
@endphp

<a href="{{ $href }}"
    class="group flex items-center gap-3 px-4 py-3.5 mx-2 rounded-r-xl text-sm font-medium transition-all duration-300 relative overflow-hidden {{ $bgClass }}">

    @if($isActive)
    <div class="absolute inset-0 bg-primary/5 animate-pulse"></div>
    @endif

    <span class="material-symbols-outlined text-[22px] transition-colors relative z-10 {{ $iconClass }}">
        {{ $icon }}
    </span>

    <span class="relative z-10">{{ $label }}</span>

    @if($badge)
    <span class="ml-auto px-2 py-0.5 rounded-full bg-red-500/20 text-red-400 text-[10px] font-bold border border-red-500/20">
        {{ $badge }}
    </span>
    @endif
</a>