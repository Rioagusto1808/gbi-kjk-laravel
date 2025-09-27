<x-app-layout>
    <!-- Heading -->
    <div class="mb-8 text-center md:text-left">
        <h1 class="text-2xl md:text-3xl font-bold text-orange-600">
            Selamat Datang, {{ auth()->user()->name }}
        </h1>
        <p class="text-sm md:text-lg text-gray-600 mt-1">
            Semoga harimu diberkati dan penuh semangat ✨
        </p>
    </div>

    <div class="py-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <!-- Renungan Harian -->
            <div
                class="bg-gradient-to-br from-purple-500 to-purple-700 text-white rounded-xl shadow-lg hover:scale-105 transform transition p-6">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold">Renungan Harian</h3>
                    <span class="text-3xl">📖</span>
                </div>
                @if ($renungan)
                    <h4 class="mt-3 text-md font-bold">{{ $renungan->judul }}</h4>
                    <p class="text-sm text-gray-100">{{ $renungan->ayat ?? '-' }}</p>
                    <p class="mt-2 text-sm text-gray-200 line-clamp-3">{{ $renungan->isi }}</p>
                    <a href="{{ route('jemaat.renungan.show', $renungan->id) }}"
                        class="inline-block mt-4 text-sm font-medium bg-white text-purple-700 px-4 py-2 rounded-md shadow hover:bg-gray-100">
                        Baca Selengkapnya
                    </a>
                @else
                    <p class="mt-4 text-sm">Belum ada renungan hari ini.</p>
                @endif
            </div>

            <!-- Jadwal Ibadah -->
            <div
                class="bg-gradient-to-br from-indigo-500 to-indigo-700 text-white rounded-xl shadow-lg hover:scale-105 transform transition p-6">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold">Jadwal Ibadah</h3>
                    <span class="text-3xl">⛪</span>
                </div>
                <ul class="mt-4 space-y-2 text-sm">
                    @forelse($ibadah as $i)
                        <li class="flex items-center gap-2">
                            <span class="w-2 h-2 bg-white rounded-full"></span>
                            {{ $i->jenis }} - {{ $i->tanggal_mulai->format('d M Y H:i') }}
                        </li>
                    @empty
                        <li class="text-sm">Belum ada jadwal ibadah.</li>
                    @endforelse
                </ul>
                <a href="{{ route('jemaat.ibadah.index') }}"
                    class="inline-block mt-4 text-sm font-medium bg-white text-indigo-700 px-4 py-2 rounded-md shadow hover:bg-gray-100">
                    Lihat Detail
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
