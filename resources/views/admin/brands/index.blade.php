<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Merek') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.04)] sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium">Daftar Merek</h3>
                    <a href="{{ route('admin.brands.create') }}" class="px-4 py-2 bg-sidebar text-white hover:bg-orange-500 hover:text-white transition-colors duration-200 border border-transparent hover:bg-brand/90 border border-transparent text-white rounded ">
                        Tambah Merek
                    </a>
                </div>

                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Nama</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Status</th>
                            <th class="px-4 py-2 text-right text-sm font-medium text-gray-500">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($brands as $brand)
                            <tr>
                                <td class="px-4 py-3">{{ $brand->name }}</td>
                                <td class="px-4 py-3">
                                    @if ($brand->is_active)
                                        <span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded">Aktif</span>
                                    @else
                                        <span class="px-2 py-1 text-xs bg-gray-100 text-gray-600 rounded">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-right space-x-2">
                                    <a href="{{ route('admin.brands.edit', $brand) }}" class="text-blue-600 hover:underline">Edit</a>
                                    <form action="{{ route('admin.brands.toggle', $brand) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-yellow-600 hover:underline">
                                            {{ $brand->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-3 text-center text-gray-500">Belum ada data merek.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $brands->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>