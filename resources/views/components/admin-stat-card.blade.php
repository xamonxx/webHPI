@props(['title', 'value', 'icon', 'color', 'route', 'trend', 'is_alert' => false])

@php
$colors = [
'blue' => 'bg-blue-500/10 text-blue-400 group-hover:bg-blue-500/20 group-hover:text-blue-300',
'green' => 'bg-green-500/10 text-green-400 group-hover:bg-green-500/20 group-hover:text-green-300',
'purple' => 'bg-purple-500/10 text-purple-400 group-hover:bg-purple-500/20 group-hover:text-purple-300',
'orange' => 'bg-orange-500/10 text-orange-400 group-hover:bg-orange-500/20 group-hover:text-orange-300',
'gray' => 'bg-gray-500/10 text-gray-400 group-hover:bg-gray-500/20 group-hover:text-gray-300',
];
$btnColors = [
'blue' => 'text-blue-400 group-hover:translate-x-1',
'green' => 'text-green-400 group-hover:translate-x-1',
'purple' => 'text-purple-400 group-hover:translate-x-1',
'orange' => 'text-orange-400 group-hover:translate-x-1',
'gray' => 'text-gray-400 group-hover:translate-x-1',
];

$cls = $colors[$color] ?? $colors['gray'];
$btnCls = $btnColors[$color] ?? $btnColors['gray'];
$borderClass = $is_alert ? 'border-red-500/30 shadow-[0_0_15px_rgba(239,68,68,0.1)]' : 'border-white/5 hover:border-white/10';
@endphp

<div class="glass-card rounded-2xl p-6 border {{ $borderClass }} relative group transition-all duration-300 hover:-translate-y-1">
    <div class="flex justify-between items-start mb-4">
        <div class="w-12 h-12 rounded-xl {{ $cls }} flex items-center justify-center transition-colors">
            <span class="material-symbols-outlined text-2xl">{{ $icon }}</span>
        </div>
        @if($is_alert)
        <span class="flex h-3 w-3 relative">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
        </span>
        @endif
    </div>

    <p class="text-gray-500 text-xs font-medium uppercase tracking-wider mb-1">{{ $title }}</p>
    <h3 class="text-3xl font-bold text-white mb-4">{{ $value }}</h3>

    <div class="flex items-center justify-between border-t border-white/5 pt-4">
        <span class="text-[10px] font-bold bg-white/5 px-2 py-1 rounded text-gray-400">{{ $trend }}</span>
        <a href="{{ $route }}" class="text-xs font-bold flex items-center gap-1 transition-transform duration-300 {{ $btnCls }}">
            DETAIL <span class="material-symbols-outlined text-sm">arrow_forward</span>
        </a>
    </div>
</div>