<x-app-layout>
    <x-slot name="title">Event Jemaat</x-slot>

    <div class="flex justify-between items-center mb-6 py-4">
        <h2 class="text-2xl font-semibold text-gray-800">Daftar Event</h2>
    </div>

    @if ($event->count())
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($event as $e)
               <div class="p-5 bg-white flex flex-col h-full">
    <!-- Konten Atas -->
    <div class="flex-grow">
        <h3 class="text-lg font-bold text-gray-800 mb-1">{{ $e->nama_event }}</h3>
        <p class="text-sm text-gray-600 mb-3">{{ Str::limit($e->deskripsi, 80) }}</p>

        <p class="text-sm text-gray-700 mb-1">
            <x-heroicon-o-calendar class="w-4 h-4 inline mr-1 text-red-700" />
            {{ $e->tanggal_mulai->format('d M Y H:i') }}
        </p>
        <p class="text-sm text-gray-700">
            <x-heroicon-o-map-pin class="w-4 h-4 inline mr-1 text-red-700" />
            {{ $e->lokasi ?? '-' }}
        </p>
    </div>

    <!-- Footer -->
    <div class="mt-4 flex justify-between items-center">
        <a href="{{ route('jemaat.event.show', $e->id) }}"
           class="px-4 py-2 bg-red-700 text-white text-sm rounded-md shadow hover:bg-red-800 transition">
            Lihat Detail
        </a>

        @if ($e->peserta()->where('jemaat_id', auth()->user()->jemaat->id ?? null)->exists())
            <span class="px-3 py-1 bg-green-600 text-white rounded-full text-xs font-semibold">
                ✅ Terdaftar
            </span>
        @endif
    </div>
</div>

            @endforeach
        </div>

        <div class="mt-6">
            {{ $event->links() }}
        </div>
    @else
        <p class="text-gray-500">Belum ada event tersedia.</p>
    @endif
</x-app-layout>
