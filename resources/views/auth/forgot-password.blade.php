<x-guest-layout>
    <!-- Logo inside card (desktop) -->
    <div class="hidden lg:flex justify-center mb-5">
        <x-application-logo class="w-14 h-14" />
    </div>

    <!-- Heading -->
    <div class="text-center mb-7">
        <h1 class="text-gray-800 font-bold text-xl" style="font-family:'Poppins',sans-serif;">
            Lupa <span class="text-[#F97316]">Password?</span>
        </h1>
        <p class="text-gray-500 text-xs mt-2 leading-relaxed px-2" style="font-family:'Poppins',sans-serif;">
            Tidak masalah. Masukkan alamat email Anda dan kami akan mengirimkan tautan untuk mengatur ulang password Anda.
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-6">
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
                    placeholder="Masukkan alamat email Anda"
                    class="form-input-custom @error('email') border-red-400 @enderror"
                />
            </div>
            @error('email')
                <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn-login">
            <span>Kirim Link Reset</span>
            <svg style="width:18px;height:18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
            </svg>
        </button>

        <div class="text-center mt-6">
            <a href="{{ route('login') }}" class="text-xs font-semibold text-[#1a4fa0] hover:text-orange-500 transition-colors" style="font-family:'Poppins',sans-serif;">
                &larr; Kembali ke halaman login
            </a>
        </div>
    </form>
</x-guest-layout>
