<x-app-layout>
    <x-slot name="title">Manajemen Jemaat</x-slot>
    
    <!-- Header -->
    <div class="flex justify-between items-center mb-6 py-4">
    <h2 class="text-2xl font-merriweather font-semibold text-gray-800">Daftar Jemaat</h2>

    <a href="{{ route('jemaat.deleted') }}"
       class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition">
        <x-heroicon-o-trash class="w-5 h-5" />
        Kotak Sampah
    </a>
    </div>
    <x-message />
    <!-- Search -->
    <div class="mb-4">
        <form method="GET" action="{{ route('jemaat.index') }}" class="flex sm:flex-row items-center gap-2">
            <!-- Input field with icon -->
            <div class="relative w-full sm:w-64">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                    <x-heroicon-o-magnifying-glass class="w-5 h-5" />
                </span>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Cari jemaat..."
                       class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-200 focus:border-indigo-500">
            </div>

            <!-- Cari Button with icon -->
            <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">
                <span>Cari</span>
            </button>
            
        </form>
    </div>
    <!-- Table -->
    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-indigo-600 text-white">
                <tr>
                    <th class="px-6 py-3 text-left font-semibold tracking-wider">No</th>
                    <th class="px-6 py-3 text-left font-semibold tracking-wider">Nama Lengkap</th>
                    <th class="px-6 py-3 text-left font-semibold tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left font-semibold tracking-wider">No HP</th>
                    <th class="px-6 py-3 text-left font-semibold tracking-wider">Status</th>
                    <th class="px-6 py-3 text-right font-semibold tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($jemaat as $index => $j)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">{{ $jemaat->firstItem() + $index }}</td>
                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">{{ $j->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">{{ $j->user->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $j->no_hp ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($j->aktif)
                                <span class="px-3 py-1 inline-flex text-xs font-semibold rounded-full bg-green-100 text-green-700">
                                    Aktif
                                </span>
                            @else
                                <span class="px-3 py-1 inline-flex text-xs font-semibold rounded-full bg-red-100 text-red-700">
                                    Nonaktif
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right space-x-2">
                            <a href="{{ route('jemaat.show', $j->id) }}"
                               class="inline-flex items-center gap-1 text-yellow-600 hover:text-indigo-900 font-medium">
                                <x-heroicon-o-eye class="w-4 h-4" />
                                Lihat
                            </a>
                            <a href="{{ route('jemaat.edit', $j->id) }}"
                               class="inline-flex items-center gap-1 text-indigo-600 hover:text-indigo-900 font-medium">
                                <x-heroicon-o-pencil-square class="w-4 h-4" />
                                Edit
                            </a>
                            <form id="delete-form-{{ $j->id }}" action="{{ route('jemaat.destroy', $j->id) }}" method="POST" class="inline-block hidden">
                                @csrf
                                @method('DELETE')
                            </form>

                            <button type="button" 
                                    onclick="confirmDelete('{{ $j->id }}', 'Hapus {{ $j->name }}?', 'Data jemaat akan masuk kotak sampah.')"
                                    class="inline-flex items-center gap-1 text-red-600 hover:text-red-900 font-medium">
                                <x-heroicon-o-trash class="w-4 h-4" />
                                Hapus
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">Tidak ada data jemaat.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $jemaat->links() }}
    </div>

    
</x-app-layout>
