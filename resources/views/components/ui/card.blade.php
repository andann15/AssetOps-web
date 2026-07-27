@props(['title' => null, 'padded' => true])
<div {{ $attributes->merge(['class' => 'bg-white rounded-lg shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100 overflow-hidden hover:shadow-md hover:-translate-y-1 transition-all duration-300 ease-in-out']) }}>
    @if ($title)
        <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
            <h3 class="text-sm font-semibold text-gray-700">{{ $title }}</h3>
            @isset($action){{ $action }}@endisset
        </div>
    @endif
    <div @class(['p-5' => $padded])>
        {{ $slot }}
    </div>
</div>