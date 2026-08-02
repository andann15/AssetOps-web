<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-emerald-50 text-emerald-600 rounded-lg shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-emerald-100 flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="mb-4 p-4 bg-red-50 text-red-600 rounded-lg shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-red-100 flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.04)] sm:rounded-xl border border-gray-100">
                <div class="flex justify-between items-center p-6 border-b border-gray-100 bg-gray-50/50">
                    <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        Daftar Pengguna
                    </h3>
                    <a href="{{ route('admin.users.create') }}" class="group inline-flex items-center gap-2 px-4 py-2 bg-sidebar text-white hover:bg-orange-500 hover:text-white transition-colors duration-200 border border-transparent hover:bg-brand/90 border border-transparent text-white rounded-lg  hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 font-medium text-sm">
                        <svg class="w-4 h-4 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        Tambah Pengguna
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Pengguna</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Peran (Role)</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Unit Kerja</th>
                                <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse ($users as $user)
                                <tr class="hover:bg-slate-50 transition-colors duration-200 group">
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span class="font-bold text-slate-900">{{ $user->name }}</span>
                                            <span class="text-sm text-gray-500">{{ $user->email }}</span>
                                            <span class="text-xs text-gray-400 mt-0.5 font-mono">NIK: {{ $user->nik }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($user->hasRole('admin'))
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-cyan-100 text-cyan-800 border border-cyan-200 shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
                                                Admin
                                            </span>
                                        @elseif($user->hasRole('operator'))
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800 border border-amber-200 shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
                                                Operator
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 border border-emerald-200 shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
                                                User
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-sm text-gray-700">{{ $user->workUnit->name ?? '-' }}</span>
                                        @if($user->workUnit)
                                            <div class="text-xs text-gray-500 mt-0.5">
                                                {{ $user->workUnit->department->name ?? '-' }} / {{ $user->workUnit->department->compartment->name ?? '-' }}
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end gap-3">
                                            <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-600 hover:text-cyan-900 font-medium text-sm hover:underline flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 font-medium text-sm hover:underline flex items-center gap-1">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                        <svg class="mx-auto h-12 w-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                        <p class="text-base font-medium text-gray-900">Belum ada pengguna</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if($users->hasPages())
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                    {{ $users->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
