<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'AssetOps') }}</title>

        <!-- Favicon -->
        <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600|poppins:600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-sidebar relative overflow-hidden">
            <!-- Decorative background circles -->
            <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-brand/10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-96 h-96 bg-orange-500/10 rounded-full blur-3xl pointer-events-none"></div>

            <div class="z-10 flex flex-col items-center">
                <a href="/" class="flex items-center justify-center gap-3 group">
                    <x-application-logo class="h-16 w-16 shadow-[0_0_15px_rgba(255,255,255,0.1)] rounded-[14px] transition-transform duration-300 group-hover:scale-105" />
                    <span class="text-4xl font-extrabold italic [font-family:'Poppins',sans-serif] tracking-tight">
                        <span class="text-white drop-shadow-md">Λsset</span><span class="text-orange-500 drop-shadow-md">Ops</span>
                    </span>
                </a>
                <span class="text-xs uppercase tracking-[0.08em] font-semibold text-gray-400 mt-3 leading-[1.4] text-center">
                    Integrated Asset &<br>Maintenance Management
                </span>
            </div>

            <div class="z-10 w-full sm:max-w-md mt-10 px-8 py-10 bg-white shadow-[0_20px_50px_rgba(0,0,0,0.3)] overflow-hidden rounded-2xl">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>