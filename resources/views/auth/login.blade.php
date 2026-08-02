<x-guest-layout>
    <!-- Logo inside card (desktop) -->
    <div class="hidden lg:flex justify-center mb-5">
        <x-application-logo class="w-14 h-14" />
    </div>

    <!-- Heading -->
    <div class="text-center mb-7">
        <h1 class="text-gray-800 font-bold text-2xl" style="font-family:'Poppins',sans-serif;">
            Selamat Datang di <span class="text-[#0B1E36]">S</span><span class="text-[#F97316]">i</span><span class="text-[#0B1E36]">AP</span>
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
</x-guest-layout>
