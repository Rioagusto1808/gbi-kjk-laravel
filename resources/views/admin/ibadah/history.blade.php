<x-app-layout>
    <x-slot name="title">History Ibadah</x-slot>

    <div class="flex justify-between items-center mb-6 py-4">
        <h2 class="text-2xl font-merriweather font-semibold text-gray-800">History Ibadah</h2>
        <a href="{{ route('ibadah.index') }}"
            class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">
            ← Kembali ke Daftar Ibadah
        </a>
    </div>

    @if ($ibadah->count())
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($ibadah as $i)
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition p-5 flex flex-col justify-between">
                    <div>
                        <!-- Jenis + Lokasi -->
                        <h3 class="text-lg font-semibold text-gray-800">
                            {{ $i->jenis }}
                            @if ($i->lokasi)
                                – {{ $i->lokasi }}
                            @endif
                        </h3>

                        <!-- Tema -->
                        <p class="text-sm text-gray-600">Tema : {{ $i->tema ?? '-' }}</p>
                        <p class="text-sm text-gray-600 mb-2">Ayat : {{ $i->ayat ?? '-' }}</p>
                        <!-- Tanggal -->
                        <p class="text-sm text-gray-700">
                            <x-heroicon-o-calendar class="w-4 h-4 inline mr-1 text-indigo-500" />
                            {{ $i->tanggal_mulai->format('d M Y H:i') }}
                            @if ($i->tanggal_selesai)
                                – {{ $i->tanggal_selesai->format('H:i') }}
                            @endif
                        </p>

                        <!-- Gembala -->
                        <p class="text-sm text-gray-700">
                            <x-heroicon-o-user class="w-4 h-4 inline mr-1 text-green-500" />
                            {{ $i->gembala ?? '-' }}
                        </p>
                    </div>

                    <!-- Status Badge -->
                    <div class="mt-4 flex justify-end">
                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
                            {{ $i->status }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $ibadah->links() }}
        </div>
    @else
        <p class="text-center text-gray-500">Belum ada ibadah selesai.</p>
    @endif
</x-app-layout>
