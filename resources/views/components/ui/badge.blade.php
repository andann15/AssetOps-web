@props(['active' => true])
<span {{ $attributes->merge(['class' => 'px-2 py-1 text-xs font-medium rounded ' . ($active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500')]) }}>
    {{ $active ? 'Aktif' : 'Nonaktif' }}
</span>