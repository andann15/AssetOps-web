@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-brand focus:ring-brand rounded-md shadow-[0_8px_30px_rgb(0,0,0,0.04)]']) }}>
