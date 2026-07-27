@props(['variant' => 'primary', 'href' => null, 'type' => 'button'])

@php
$base = 'inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-medium rounded-md transition-all ease-in-out duration-300 disabled:opacity-50 disabled:cursor-not-allowed hover:-translate-y-0.5 hover:shadow-md';
$variants = [
    'primary' => 'bg-sidebar text-white hover:bg-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-300',
    'secondary' => 'bg-white text-gray-700 border border-gray-300 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-200',
    'danger' => 'bg-red-600 text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-300',
];
$classes = $base . ' ' . ($variants[$variant] ?? $variants['primary']);
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</button>
@endif