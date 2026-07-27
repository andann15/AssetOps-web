@php
    $key = strtolower($priority ?? '');
    $dotColor = match(true) {
        str_contains($key, 'high') || str_contains($key, 'tinggi') => 'bg-red-500',
        str_contains($key, 'medium') || str_contains($key, 'sedang') => 'bg-yellow-500',
        str_contains($key, 'low') || str_contains($key, 'rendah') => 'bg-green-500',
        default => 'bg-gray-300',
    };
@endphp
<span class="inline-flex items-center gap-1.5 text-sm text-gray-700">
    <span class="w-2 h-2 rounded-full {{ $dotColor }}"></span>
    {{ $priority ?? '-' }}
</span>