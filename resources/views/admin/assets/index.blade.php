<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Aset') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.04)] sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium">Daftar Aset</h3>
                    @can('assets.create')
                        <a href="{{ route('admin.assets.create') }}" class="px-4 py-2 bg-sidebar text-white hover:bg-orange-500 hover:text-white transition-colors duration-200 border border-transparent hover:bg-brand/90 border border-transparent text-white rounded ">
                            Tambah Aset
                        </a>
                    @endcan
                </div>

                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Kode</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Nama</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Kategori</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Merek</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Lokasi</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Status</th>
                            @can('assets.edit')
                                <th class="px-4 py-2 text-right text-sm font-medium text-gray-500">Aksi</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($assets as $asset)
                            <tr>
                                <td class="px-4 py-3">{{ $asset->code }}</td>
                                <td class="px-4 py-3">{{ $asset->name }}</td>
                                <td class="px-4 py-3">{{ $asset->category->name }}</td>
                                <td class="px-4 py-3">{{ $asset->brand->name ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $asset->location->name }}</td>
                                <td class="px-4 py-3">{{ $statuses[$asset->status] ?? $asset->status }}</td>
                                @can('assets.edit')
                                    <td class="px-4 py-3 text-right flex justify-end gap-2">
                                        <a href="{{ route('admin.assets.edit', $asset) }}" class="text-blue-600 hover:underline">Edit</a>
                                        @role('admin')
                                            <form action="{{ route('admin.assets.destroy', $asset) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus aset ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                            </form>
                                        @endrole
                                    </td>
                                @endcan
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-3 text-center text-gray-500">Belum ada data aset.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $assets->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>