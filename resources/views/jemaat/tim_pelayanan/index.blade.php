<x-app-layout>
    <x-slot name="title">Tim Pelayanan - {{ $ibadah->jenis }}</x-slot>

    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">
            Tim Pelayanan ({{ $ibadah->tanggal_mulai->format('d M Y') }})
        </h2>

        <div class="grid gap-3 sm:grid-cols-2">
            @forelse($pelayananIbadah as $t)
                <div class="bg-gray-50 p-3 rounded-lg flex items-center justify-between">
                    <span class="font-medium text-gray-700">{{ $t->pelayanan->nama }}</span>
                    <span class="text-gray-600">{{ $t->jemaat->name ?? '-' }}</span>
                </div>
            @empty
                <p class="text-gray-500">Belum ada tim pelayanan untuk ibadah ini.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
