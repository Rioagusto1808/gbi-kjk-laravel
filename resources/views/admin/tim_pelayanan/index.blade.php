<x-app-layout>
    <x-slot name="title">Tim Pelayanan - {{ $ibadah->jenis }}</x-slot>

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 py-4 gap-3">
        <h2 class="text-2xl font-merriweather font-semibold text-gray-800">
            Tim Pelayanan ({{ $ibadah->tanggal_mulai->format('d M Y') }})
        </h2>

        <a href="{{ route('tim-pelayanan.create', $ibadah->id) }}"
           class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">
            <x-heroicon-o-plus class="w-5 h-5" /> Tambah Tim
        </a>
    </div>

    <x-message />

    @if($timPelayanan->count())
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($timPelayanan as $t)
                <div class="bg-white rounded-lg shadow p-5 hover:shadow-lg transition flex flex-col justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">{{ $t->pelayanan->nama ?? '-'}}</h3>
                        <p class="text-sm text-gray-600">Petugas : {{ $t->jemaat->name ?? '-' }}</p>
                    </div>
                    <div class="mt-4 flex items-center justify-end space-x-2 text-sm">
                        <a href="{{ route('tim-pelayanan.edit', [$ibadah->id, $t->id]) }}"
                           class="inline-flex items-center gap-1 text-indigo-600 hover:text-indigo-900 font-medium">
                            <x-heroicon-o-pencil-square class="w-4 h-4" /> Edit
                        </a>
                        <form id="delete-form-{{ $t->id }}" action="{{ route('tim-pelayanan.destroy', [$ibadah->id, $t->id]) }}" method="POST" class="hidden">
                            @csrf @method('DELETE')
                        </form>
                        <button type="button"
                                onclick="confirmDelete('{{ $t->id }}', 'Hapus {{ $t->pelayanan->nama ?? '-' }}?', 'Tim pelayanan ini akan dihapus.')"
                                class="inline-flex items-center gap-1 text-red-600 hover:text-red-900 font-medium">
                            <x-heroicon-o-trash class="w-4 h-4" /> Hapus
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-500">Belum ada tim pelayanan untuk ibadah ini.</p>
    @endif
</x-app-layout>
