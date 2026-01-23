@props(['label', 'desc', 'icon', 'color', 'route'])

@php
$colors = [
'blue' => 'text-blue-400 group-hover:text-blue-300',
'green' => 'text-green-400 group-hover:text-green-300',
'purple' => 'text-purple-400 group-hover:text-purple-300',
'gray' => 'text-gray-400 group-hover:text-white',
];
$iconColors = [
'blue' => 'bg-blue-500/10 group-hover:bg-blue-500/20',
'green' => 'bg-green-500/10 group-hover:bg-green-500/20',
'purple' => 'bg-purple-500/10 group-hover:bg-purple-500/20',
'gray' => 'bg-white/5 group-hover:bg-white/10',
];

$textCls = $colors[$color] ?? $colors['gray'];
$bgCls = $iconColors[$color] ?? $iconColors['gray'];
@endphp

<a href="{{ $route }}" class="mx-[-4px] flex items-center gap-4 p-3 rounded-xl hover:bg-white/5 transition-colors group border border-transparent hover:border-white/5">
    <div class="w-10 h-10 rounded-lg {{ $bgCls }} flex items-center justify-center transition-colors">
        <span class="material-symbols-outlined {{ $textCls }} transition-colors">{{ $icon }}</span>
    </div>
    <div class="flex-1">
        <p class="text-sm font-bold text-white group-hover:text-primary transition-colors">{{ $label }}</p>
        <p class="text-xs text-gray-500">{{ $desc }}</p>
    </div>
    <span class="material-symbols-outlined text-gray-600 group-hover:text-white group-hover:translate-x-1 transition-all">chevron_right</span>
</a>