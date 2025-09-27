<x-app-layout>
    <x-slot name="title">{{ $event->nama_event }}</x-slot>

    <div class="max-w-3xl mx-auto bg-white shadow rounded-lg p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $event->nama_event }}</h2>
        <p class="text-gray-600 mb-4">{{ $event->deskripsi }}</p>

        <p class="text-sm text-gray-700">
            <x-heroicon-o-calendar class="w-4 h-4 inline mr-1 text-indigo-500" />
            {{ $event->tanggal_mulai->format('d M Y H:i') }}
            @if ($event->tanggal_selesai)
                - {{ $event->tanggal_selesai->format('d M Y H:i') }}
            @endif
        </p>
        <p class="text-sm text-gray-700">
            <x-heroicon-o-map-pin class="w-4 h-4 inline mr-1 text-pink-500" />
            {{ $event->lokasi ?? '-' }}
        </p>

        <div class="mt-6">
            @php
                $sudahDaftar = $event
                    ->peserta()
                    ->where('jemaat_id', auth()->user()->jemaat->id ?? null)
                    ->exists();
            @endphp

            @if ($sudahDaftar)
                <button class="px-4 py-2 bg-gray-400 text-white rounded-md cursor-not-allowed" disabled>
                    ✅ Sudah Terdaftar
                </button>
            @else
                <form action="{{ route('event.daftar', $event->id) }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">
                        Daftar Event
                    </button>
                </form>
            @endif
        </div>
    </div>
</x-app-layout>
