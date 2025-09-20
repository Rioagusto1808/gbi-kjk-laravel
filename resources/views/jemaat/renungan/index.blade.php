<x-app-layout>
    <x-slot name="title">Renungan Harian</x-slot>

    <div class="flex justify-between items-center mb-6 py-4">
        <h2 class="text-2xl font-merriweather font-semibold text-gray-800">Renungan Harian</h2>
    </div>

    @if($renungan->count())
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($renungan as $r)
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition p-5 flex flex-col justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-1">{{ $r->judul }}</h3>
                        <p class="text-sm text-gray-600">Ayat: {{ $r->ayat ?? '-' }}</p>
                        <p class="text-sm text-gray-700 mt-2 line-clamp-3">{{ $r->isi }}</p>
                    </div>

                    <div class="mt-4 flex justify-between items-center">
                        <p class="text-xs text-gray-500">Oleh: {{ $r->penulis ?? '-' }}</p>
                        <a href="{{ route('jemaat.renungan.show', $r->id) }}"
                           class="inline-flex items-center gap-1 text-indigo-600 hover:text-indigo-900 text-sm font-medium">
                            <x-heroicon-o-eye class="w-4 h-4" /> Baca
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $renungan->links() }}
        </div>
    @else
        <p class="text-center text-gray-500">Belum ada renungan tersedia.</p>
    @endif
</x-app-layout>
