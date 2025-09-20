<x-app-layout>
    <x-slot name="title">Event Jemaat</x-slot>

    <div class="flex justify-between items-center mb-6 py-4">
        <h2 class="text-2xl font-semibold text-gray-800">Daftar Event</h2>
    </div>

    @if($event->count())
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($event as $e)
                <div class="bg-white rounded-lg shadow p-5 flex flex-col justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">{{ $e->nama_event }}</h3>
                        <p class="text-sm text-gray-600 mb-2">{{ Str::limit($e->deskripsi, 80) }}</p>

                        <p class="text-sm text-gray-700">
                            <x-heroicon-o-calendar class="w-4 h-4 inline mr-1 text-indigo-500" />
                            {{ $e->tanggal_mulai->format('d M Y H:i') }}
                        </p>
                        <p class="text-sm text-gray-700">
                            <x-heroicon-o-map-pin class="w-4 h-4 inline mr-1 text-pink-500" />
                            {{ $e->lokasi ?? '-' }}
                        </p>
                    </div>

                    <div class="mt-4 flex justify-between items-center">
                        <a href="{{ route('jemaat.event.show', $e->id) }}"
                           class="text-indigo-600 hover:underline">Lihat Detail</a>

                        @php
                            $sudahDaftar = $e->peserta()
                                ->where('jemaat_id', auth()->user()->jemaat->id ?? null)
                                ->exists();
                        @endphp

                        @if($sudahDaftar)
                            <span class="px-3 py-1 bg-gray-400 text-white rounded-md text-xs">✅ Terdaftar</span>
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
