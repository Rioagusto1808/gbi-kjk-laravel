<x-app-layout>
    <x-slot name="title">Detail Ibadah</x-slot>

    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow p-6">
        @if ($ibadah)
            <!-- Header -->
            <div class="mb-4">
                <h2 class="text-2xl font-semibold text-gray-800">{{ $ibadah->jenis }}</h2>
                <p class="text-gray-600">Tema: {{ $ibadah->tema ?? '-' }}</p>
                <p class="text-sm text-gray-500 mt-1">
                    <x-heroicon-o-calendar class="w-4 h-4 inline mr-1 text-indigo-500" />
                    {{ $ibadah->tanggal_mulai->format('d M Y H:i') }}
                    @if ($ibadah->tanggal_selesai)
                        - {{ $ibadah->tanggal_selesai->format('H:i') }}
                    @endif
                    |
                    <x-heroicon-o-map-pin class="w-4 h-4 inline mr-1 text-pink-500" />
                    {{ $ibadah->lokasi ?? '-' }}
                </p>
                <p class="text-sm text-gray-500">
                    <x-heroicon-o-user class="w-4 h-4 inline mr-1 text-green-500" />
                    Gembala: {{ $ibadah->gembala ?? '-' }}
                </p>
            </div>

            <!-- Jadwal Pelayanan -->
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Jadwal Pelayanan</h3>
                <div class="grid gap-3 sm:grid-cols-2">
                    @forelse($ibadah->pelayananIbadah as $p)
                        <div class="bg-gray-50 p-3 rounded-lg flex items-center justify-between">
                            <span class="font-medium text-gray-700">{{ $p->pelayanan->nama }}</span>
                            <span class="text-gray-600">{{ $p->jemaat->name ?? '-' }}</span>
                        </div>
                    @empty
                        <p class="text-gray-500 text-sm">Belum ada data pelayanan yang ditugaskan.</p>
                    @endforelse
                </div>
            </div>

            <!-- Deskripsi -->
            @if ($ibadah->deskripsi)
                <div class="mt-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Deskripsi</h3>
                    <p class="text-gray-700 leading-relaxed">{{ $ibadah->deskripsi }}</p>
                </div>
            @endif
        @else
            <p class="text-center text-gray-500">Data ibadah tidak ditemukan.</p>
        @endif
    </div>
</x-app-layout>
