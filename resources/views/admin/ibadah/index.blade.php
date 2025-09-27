<x-app-layout>
    <x-slot name="title">Manajemen Ibadah</x-slot>

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 py-4 gap-3">
        <h2 class="text-2xl font-merriweather font-semibold text-gray-800">Daftar Ibadah</h2>

        <div class="flex flex-col sm:flex-row gap-2">
            <a href="{{ route('ibadah.history') }}"
                class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-yellow-600 text-white rounded-md hover:bg-yellow-700 transition">
                <x-heroicon-o-clock class="w-5 h-5" />
                History Ibadah
            </a>
            <a href="{{ route('ibadah.create') }}"
                class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">
                <x-heroicon-o-plus class="w-5 h-5" />
                Tambah Ibadah
            </a>
        </div>
    </div>

    <x-message />

    <!-- Search -->
    <div class="mb-4">
        <form method="GET" action="{{ route('ibadah.index') }}" class="flex sm:flex-row items-center gap-2">
            <div class="relative w-full sm:w-64">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                    <x-heroicon-o-magnifying-glass class="w-5 h-5" />
                </span>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari ibadah..."
                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-200 focus:border-indigo-500">
            </div>

            <button type="submit"
                class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">
                Cari
            </button>
        </form>
    </div>

    <!-- Cards -->
    @if ($ibadah->count())
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($ibadah as $i)
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition p-5 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-800 mb-1">{{ $i->jenis }}</h3>
                            <!-- Status Badge -->
                            @php
                                $color = match ($i->status) {
                                    'Akan Datang' => 'bg-yellow-100 text-yellow-700',
                                    'Sedang Berlangsung' => 'bg-blue-100 text-blue-700',
                                    'Selesai' => 'bg-green-100 text-green-700',
                                    default => 'bg-gray-100 text-gray-700',
                                };
                            @endphp
                            <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $color }}">
                                {{ $i->status }}
                            </span>
                        </div>
                        <p class="text-sm text-gray-600 mb-2">Tema : {{ $i->tema ?? '-' }}</p>

                        <p class="text-sm text-gray-700">
                            <x-heroicon-o-calendar class="w-4 h-4 inline mr-1 text-indigo-500" />
                            {{ $i->tanggal_mulai->format('d M Y H:i') }}
                            @if ($i->tanggal_selesai)
                                - {{ $i->tanggal_selesai->format('H:i') }}
                            @endif
                        </p>
                        <p class="text-sm text-gray-700">
                            <x-heroicon-o-map-pin class="w-4 h-4 inline mr-1 text-pink-500" />
                            {{ $i->lokasi ?? '-' }}
                        </p>
                        <p class="text-sm text-gray-700">
                            <x-heroicon-o-user class="w-4 h-4 inline mr-1 text-green-500" />
                            {{ $i->gembala ?? '-' }}
                        </p>
                    </div>

                    <div class="mt-4 flex items-center justify-between">
                        <!-- Actions -->
                        <div class="space-x-2 text-sm">
                            <a href="{{ route('tim-pelayanan.index', $i->id) }}"
                                class="inline-flex items-center gap-1 text-yellow-600 hover:text-yellow-800">
                                <x-heroicon-o-user-group class="w-4 h-4" />
                                Atur Tim
                            </a>
                            <a href="{{ route('ibadah.edit', $i->id) }}"
                                class="inline-flex items-center gap-1 text-indigo-600 hover:text-indigo-900 font-medium">
                                <x-heroicon-o-pencil-square class="w-4 h-4" /> Edit
                            </a>
                            <form id="delete-form-{{ $i->id }}" action="{{ route('ibadah.destroy', $i->id) }}"
                                method="POST" class="inline-block hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button type="button"
                                onclick="confirmDelete('{{ $i->id }}', 'Hapus {{ $i->tema ?? $i->jenis }}?', 'Data ibadah akan masuk kotak sampah.')"
                                class="inline-flex items-center gap-1 text-red-600 hover:text-red-900 font-medium">
                                <x-heroicon-o-trash class="w-4 h-4" /> Hapus
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $ibadah->links() }}
        </div>
    @else
        <p class="text-center text-gray-500">Tidak ada data ibadah.</p>
    @endif
</x-app-layout>
