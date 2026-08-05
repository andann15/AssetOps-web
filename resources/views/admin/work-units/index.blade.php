<x-app-layout>
    <x-slot name="header">
        <x-ui.page-header title="Kelola Unit Kerja" description="Atur daftar Unit Kerja berdasarkan hierarki Kompartemen dan Departemen di PKT.">
            <x-slot name="action">
                <x-ui.button href="{{ route('admin.work-units.create') }}">+ Tambah Unit Kerja</x-ui.button>
            </x-slot>
        </x-ui.page-header>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-4">
            @if (session('success'))
                <div class="p-3 bg-green-100 text-green-800 text-sm rounded">{{ session('success') }}</div>
            @endif

            <x-ui.card :padded="false">
                <table class="min-w-full divide-y divide-gray-100">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 text-left text-xs font-medium text-gray-500">Kompartemen</th>
                            <th class="px-5 py-3 text-left text-xs font-medium text-gray-500">Departemen</th>
                            <th class="px-5 py-3 text-left text-xs font-medium text-gray-500">Unit Kerja</th>
                            <th class="px-5 py-3 text-left text-xs font-medium text-gray-500">Status</th>
                            <th class="px-5 py-3 text-right text-xs font-medium text-gray-500">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($workUnits as $workUnit)
                            <tr class="hover:bg-gray-50">
                                <td class="px-5 py-3 text-sm text-gray-800">{{ $workUnit->department?->compartment?->name ?? '-' }}</td>
                                <td class="px-5 py-3 text-sm text-gray-600">{{ $workUnit->department?->name ?? '-' }}</td>
                                <td class="px-5 py-3 text-sm text-gray-500">{{ $workUnit->name ?? '-' }}</td>
                                <td class="px-5 py-3"><x-ui.badge :active="$workUnit->is_active" /></td>
                                <td class="px-5 py-3 text-right space-x-3">
                                    <a href="{{ route('admin.work-units.edit', $workUnit) }}" class="text-blue-600 hover:underline text-sm font-medium">Edit</a>
                                    <form action="{{ route('admin.work-units.toggle', $workUnit) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-gray-500 hover:text-blue-600 hover:underline text-sm font-medium">
                                            {{ $workUnit->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="px-5 py-6 text-center text-sm text-gray-500">Belum ada data unit kerja.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </x-ui.card>

            <div>{{ $workUnits->links() }}</div>
        </div>
    </div>
</x-app-layout>
