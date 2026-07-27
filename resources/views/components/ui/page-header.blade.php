@props(['title', 'description' => null])
<div class="flex items-center justify-between gap-4">
    <div>
        <h2 class="font-semibold text-lg text-gray-800 [font-family:'Poppins',sans-serif]">{{ $title }}</h2>
        @if ($description)
            <p class="text-sm text-gray-500">{{ $description }}</p>
        @endif
    </div>
    @isset($action)
        <div>{{ $action }}</div>
    @endisset
</div>