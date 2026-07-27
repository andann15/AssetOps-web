<x-app-layout>
    <x-slot name="header">
        <x-ui.page-header title="Dashboard Operator" description="Tiket yang perlu ditangani beserta status SLA." />
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-4">
            <x-ui.card>
                <p class="text-sm text-gray-600">
                    Selamat datang, {{ auth()->user()->name }}. Berikut akses cepat ke tiket yang menunggu ditangani.
                </p>
            </x-ui.card>

            <x-ui.card title="Aksi Cepat">
                <div class="flex flex-wrap gap-3">
                    <x-ui.button href="{{ route('tickets.index') }}">Lihat Daftar Tiket</x-ui.button>
                </div>
            </x-ui.card>
        </div>
    </div>
</x-app-layout>