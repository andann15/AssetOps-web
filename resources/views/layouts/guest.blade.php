<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SIAP') }} — Login</title>

        <!-- Favicon -->
        <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body { font-family: 'Poppins', sans-serif; }

            .login-left {
                background: linear-gradient(145deg, #0B1E36 0%, #0f2848 40%, #0B1E36 75%, #091729 100%);
                position: relative;
                overflow: hidden;
            }

            .login-left::before {
                content: '';
                position: absolute;
                top: -20%;
                right: -15%;
                width: 500px;
                height: 500px;
                background: radial-gradient(circle, rgba(173,218,240,0.08) 0%, transparent 70%);
                border-radius: 50%;
            }

            .login-left::after {
                content: '';
                position: absolute;
                bottom: -10%;
                left: -10%;
                width: 400px;
                height: 400px;
                background: radial-gradient(circle, rgba(249,115,22,0.07) 0%, transparent 70%);
                border-radius: 50%;
            }

            /* Animated wave lines */
            .wave-lines {
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                opacity: 0.15;
            }

            /* Dot grid pattern */
            .dot-pattern {
                position: absolute;
                top: 0; left: 0; right: 0; bottom: 0;
                background-image: radial-gradient(circle, rgba(255,255,255,0.08) 1px, transparent 1px);
                background-size: 28px 28px;
                pointer-events: none;
            }

            .feature-card {
                background: rgba(255, 255, 255, 0.06);
                backdrop-filter: blur(4px);
                border: 1px solid rgba(255, 255, 255, 0.1);
                border-radius: 12px;
                padding: 14px 16px;
                transition: all 0.3s ease;
            }

            .feature-card:hover {
                background: rgba(255, 255, 255, 0.1);
                transform: translateY(-2px);
            }

            .form-input-custom {
                width: 100%;
                padding: 12px 12px 12px 44px;
                border: 1.5px solid #e5e7eb;
                border-radius: 10px;
                font-size: 14px;
                font-family: 'Poppins', sans-serif;
                color: #1f2937;
                background: #f9fafb;
                transition: all 0.2s ease;
                outline: none;
            }

            .form-input-custom:focus {
                border-color: #1a4fa0;
                background: #ffffff;
                box-shadow: 0 0 0 3px rgba(26, 79, 160, 0.1);
            }

            .form-input-custom::placeholder {
                color: #9ca3af;
                font-size: 13px;
            }

            .btn-login {
                width: 100%;
                padding: 13px;
                background: linear-gradient(135deg, #1a4fa0 0%, #0d3580 100%);
                color: white;
                border: none;
                border-radius: 10px;
                font-size: 15px;
                font-weight: 600;
                font-family: 'Poppins', sans-serif;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
                transition: all 0.3s ease;
                box-shadow: 0 4px 15px rgba(13, 53, 128, 0.4);
                letter-spacing: 0.3px;
            }

            .btn-login:hover {
                background: linear-gradient(135deg, #1e5cbf 0%, #1a4fa0 100%);
                transform: translateY(-1px);
                box-shadow: 0 6px 20px rgba(13, 53, 128, 0.5);
            }

            .btn-login:active {
                transform: translateY(0);
            }

            .divider-line {
                display: flex;
                align-items: center;
                gap: 12px;
                color: #9ca3af;
                font-size: 12px;
            }

            .divider-line::before,
            .divider-line::after {
                content: '';
                flex: 1;
                height: 1px;
                background: #e5e7eb;
            }

            /* Fade in animation */
            @keyframes fadeInUp {
                from { opacity: 0; transform: translateY(20px); }
                to { opacity: 1; transform: translateY(0); }
            }

            .animate-fade-in { animation: fadeInUp 0.5s ease forwards; }
            .animate-fade-in-delay { animation: fadeInUp 0.5s ease 0.15s forwards; opacity: 0; }
            .animate-fade-in-delay-2 { animation: fadeInUp 0.5s ease 0.3s forwards; opacity: 0; }

            /* Eye toggle button */
            .eye-toggle {
                position: absolute;
                right: 12px;
                top: 50%;
                transform: translateY(-50%);
                background: none;
                border: none;
                cursor: pointer;
                color: #9ca3af;
                padding: 4px;
                display: flex;
                align-items: center;
            }

            .eye-toggle:hover { color: #6b7280; }
        </style>
    </head>
    <body class="antialiased">
        <div class="min-h-screen flex">

            <!-- ========================== -->
            <!-- LEFT PANEL (Branding)      -->
            <!-- ========================== -->
            <div class="login-left hidden lg:flex lg:w-7/12 xl:w-3/5 flex-col justify-between p-12 relative">
                <div class="dot-pattern"></div>

                <!-- Wave decoration bottom -->
                <svg class="wave-lines" viewBox="0 0 1200 200" preserveAspectRatio="none">
                    <path d="M0,100 C150,160 350,20 600,100 C850,180 1050,40 1200,100 L1200,200 L0,200 Z" fill="rgba(173,218,240,0.12)"/>
                    <path d="M0,130 C200,80 400,170 600,130 C800,90 1000,160 1200,130 L1200,200 L0,200 Z" fill="rgba(249,115,22,0.15)"/>
                </svg>

                <!-- Top: AdKor Logo (gambar asli) -->
                <div class="relative z-10 animate-fade-in">
                    <img src="{{ asset('images/Logo PKT AdKor.png') }}" alt="AdKor - PT Pupuk Kalimantan Timur" class="h-12 object-contain" style="filter: brightness(0) invert(1);">
                </div>

                <!-- Center: Main Branding -->
                <div class="relative z-10 flex flex-col items-center text-center animate-fade-in-delay">
                    <!-- Logo Icon -->
                    <div class="mb-6 drop-shadow-2xl" style="filter: drop-shadow(0 0 30px rgba(173,218,240,0.3));">
                        <x-application-logo class="w-28 h-28" />
                    </div>

                    <!-- Brand Name -->
                    <div class="mb-3">
                        <span class="font-black tracking-tight" style="font-family:'Poppins',sans-serif; font-size: 5.5rem; line-height:1; letter-spacing:-0.02em;">
                            <span class="text-white">S</span><span class="text-orange-400">i</span><span class="text-white">AP</span>
                        </span>
                    </div>

                    <!-- Tagline underline -->
                    <div class="w-20 h-1 bg-gradient-to-r from-orange-400 to-blue-400 rounded-full mb-4"></div>

                    <!-- Subtitle -->
                    <p class="text-white/70 text-base font-medium mb-2 tracking-wide uppercase" style="letter-spacing:0.1em; font-size:0.75rem;">
                        Sistem Informasi Aset & Pelayanan
                    </p>

                    <!-- Main tagline -->
                    <h2 class="text-white font-bold text-2xl mt-6 leading-snug max-w-sm">
                        Kelola Aset dengan <span class="text-blue-300">Cerdas</span>,<br>
                        Layani dengan <span class="text-orange-400">Profesional</span>.
                    </h2>

                    <p class="text-white/50 text-sm mt-4 max-w-xs leading-relaxed">
                        SIAP hadir untuk mendukung pengelolaan aset dan pelayanan secara terintegrasi, efisien, dan transparan.
                    </p>

                    <!-- Feature cards -->
                    <div class="grid grid-cols-3 gap-3 mt-10 w-full max-w-md">
                        <div class="feature-card text-center">
                            <div class="flex justify-center mb-2">
                                <svg class="w-6 h-6 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18"/>
                                </svg>
                            </div>
                            <p class="text-white text-xs font-semibold leading-tight">Kelola Aset</p>
                            <p class="text-white/40 text-[10px] mt-1 leading-tight">Inventaris terstruktur dan terkontrol</p>
                        </div>
                        <div class="feature-card text-center">
                            <div class="flex justify-center mb-2">
                                <svg class="w-6 h-6 text-orange-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                            </div>
                            <p class="text-white text-xs font-semibold leading-tight">Layanan Cepat</p>
                            <p class="text-white/40 text-[10px] mt-1 leading-tight">Pengajuan mudah & responsif</p>
                        </div>
                        <div class="feature-card text-center">
                            <div class="flex justify-center mb-2">
                                <svg class="w-6 h-6 text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                            </div>
                            <p class="text-white text-xs font-semibold leading-tight">Informasi Akurat</p>
                            <p class="text-white/40 text-[10px] mt-1 leading-tight">Data terintegrasi untuk keputusan tepat</p>
                        </div>
                    </div>
                </div>

                <!-- Bottom copyright left -->
                <div class="relative z-10 animate-fade-in-delay-2">
                    <p class="text-white/30 text-xs">© {{ date('Y') }} SIAP — Departemen Administrasi Korporat, PT Pupuk Kalimantan Timur</p>
                </div>
            </div>

            <!-- ========================== -->
            <!-- RIGHT PANEL (Login Form)   -->
            <!-- ========================== -->
            <div class="w-full lg:w-5/12 xl:w-2/5 flex items-center justify-center bg-slate-50 relative p-8">

                <!-- Decorative dots top right -->
                <div class="absolute top-6 right-6 grid grid-cols-4 gap-1.5 opacity-30">
                    @for ($r = 0; $r < 4; $r++)
                        @for ($c = 0; $c < 4; $c++)
                            <div class="w-1.5 h-1.5 rounded-full bg-blue-300"></div>
                        @endfor
                    @endfor
                </div>

                <div class="w-full max-w-sm animate-fade-in">
                    <!-- Mobile only: Logo -->
                    <div class="lg:hidden flex flex-col items-center mb-8">
                        <x-application-logo class="w-16 h-16 mb-3" />
                        <span class="font-black" style="font-family:'Poppins',sans-serif; font-size:2.5rem; line-height:1;">
                            <span class="text-[#1a4fa0]">S</span><span class="text-orange-500">i</span><span class="text-[#1a4fa0]">AP</span>
                        </span>
                    </div>

                    <!-- Form Card -->
                    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8">

                        <!-- Logo inside card (desktop) -->
                        <div class="hidden lg:flex justify-center mb-5">
                            <x-application-logo class="w-14 h-14" />
                        </div>

                        <!-- Heading -->
                        <div class="text-center mb-7">
                            <h1 class="text-gray-800 font-bold text-2xl" style="font-family:'Poppins',sans-serif;">
                                Selamat Datang di <span class="text-[#F97316]">SIAP</span>
                            </h1>
                            <p class="text-gray-400 text-sm mt-1">Silakan masuk untuk melanjutkan</p>
                        </div>

                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />

                        <!-- Form -->
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- Email -->
                            <div class="mb-4">
                                <label for="email" class="block text-sm font-semibold text-gray-600 mb-1.5" style="font-family:'Poppins',sans-serif;">Email</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                        <svg class="h-4.5 w-4.5 text-gray-400" style="width:18px;height:18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                        </svg>
                                    </div>
                                    <input
                                        id="email"
                                        type="email"
                                        name="email"
                                        value="{{ old('email') }}"
                                        required
                                        autofocus
                                        autocomplete="username"
                                        placeholder="Masukkan alamat email Anda"
                                        class="form-input-custom @error('email') border-red-400 @enderror"
                                    />
                                </div>
                                @error('email')
                                    <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-2">
                                <label for="password" class="block text-sm font-semibold text-gray-600 mb-1.5" style="font-family:'Poppins',sans-serif;">Password</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                        <svg class="text-gray-400" style="width:18px;height:18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                        </svg>
                                    </div>
                                    <input
                                        id="password"
                                        type="password"
                                        name="password"
                                        required
                                        autocomplete="current-password"
                                        placeholder="Masukkan password Anda"
                                        class="form-input-custom @error('password') border-red-400 @enderror"
                                    />
                                    <button type="button" class="eye-toggle" onclick="togglePassword()" title="Tampilkan/sembunyikan password">
                                        <svg id="eye-icon" style="width:18px;height:18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </button>
                                </div>
                                @error('password')
                                    <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Forgot password & Remember me -->
                            <div class="flex items-center justify-between mb-6 mt-3">
                                <label for="remember_me" class="flex items-center gap-2 cursor-pointer">
                                    <input id="remember_me" type="checkbox" name="remember"
                                        class="w-4 h-4 rounded border-gray-300 text-blue-700 focus:ring-blue-500">
                                    <span class="text-xs text-gray-500" style="font-family:'Poppins',sans-serif;">Ingat saya</span>
                                </label>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}"
                                        class="text-xs font-semibold text-[#1a4fa0] hover:text-orange-500 transition-colors"
                                        style="font-family:'Poppins',sans-serif;">
                                        Lupa password?
                                    </a>
                                @endif
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn-login">
                                <span>Masuk ke SIAP</span>
                                <svg style="width:18px;height:18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </button>
                        </form>
                    </div>

                    <!-- Copyright -->
                    <p class="text-center text-gray-400 text-xs mt-6" style="font-family:'Poppins',sans-serif;">
                        © {{ date('Y') }} SIAP. All rights reserved.
                    </p>
                </div>
            </div>
        </div>

        <script>
            function togglePassword() {
                const input = document.getElementById('password');
                const icon = document.getElementById('eye-icon');
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.innerHTML = `
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                    `;
                } else {
                    input.type = 'password';
                    icon.innerHTML = `
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    `;
                }
            }
        </script>
    </body>
</html>