<x-app-layout>
    <x-slot name="title">Daftar Pesan Kontak</x-slot>

    <!-- Header -->
    <div class="flex justify-between items-center mb-6 py-4">
        <h2 class="text-2xl font-merriweather font-semibold text-gray-800">Pesan Masuk</h2>
    </div>

    <x-message />

    <!-- Search -->
    <div class="mb-4">
        <form method="GET" action="{{ route('kontak.index') }}" class="flex sm:flex-row items-center gap-2">
            <div class="relative w-full sm:w-64">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                    <x-heroicon-o-magnifying-glass class="w-5 h-5" />
                </span>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari pesan..."
                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-200 focus:border-indigo-500">
            </div>
            <button type="submit"
                class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">
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
                    <th class="px-6 py-3 text-left font-semibold tracking-wider">Nama</th>
                    <th class="px-6 py-3 text-left font-semibold tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left font-semibold tracking-wider">Telepon</th>
                    <th class="px-6 py-3 text-left font-semibold tracking-wider">Pesan</th>
                    <th class="px-6 py-3 text-left font-semibold tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-left font-semibold tracking-wider">Status</th>
                    <th class="px-6 py-3 text-right font-semibold tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($kontak as $index => $k)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">
                            {{ $kontak->firstItem() + $index }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">{{ $k->nama }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $k->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $k->telepon ?? '-' }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ Str::limit($k->pesan, 50) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $k->created_at->format('d M Y H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($k->dibalas)
                                <span
                                    class="px-3 py-1 inline-flex text-xs font-semibold rounded-full bg-green-100 text-green-700">
                                    Sudah Dibalas
                                </span>
                            @else
                                <span
                                    class="px-3 py-1 inline-flex text-xs font-semibold rounded-full bg-yellow-100 text-yellow-700">
                                    Belum Dibalas
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right space-x-2">
                            <a href="{{ route('kontak.show', $k->id) }}"
                                class="inline-flex items-center gap-1 text-yellow-600 hover:text-yellow-800 font-medium">
                                <x-heroicon-o-eye class="w-4 h-4" /> Lihat
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-4 text-center text-gray-500">Belum ada pesan masuk.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $kontak->links() }}
    </div>
</x-app-layout>
