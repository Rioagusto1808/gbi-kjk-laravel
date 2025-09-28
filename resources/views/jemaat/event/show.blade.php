<x-app-layout>
    <x-slot name="title">{{ $event->nama_event }}</x-slot>

    <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-lg overflow-hidden">
        <!-- Header -->
        @if ($event->image)
            <img src="{{ Storage::url($event->image) }}" alt="{{ $event->nama_event }}" class="w-full h-56 object-cover">
        @else
            <div
                class="w-full h-56 bg-gradient-to-r from-red-800 to-red-700 flex items-center justify-center text-white text-2xl font-bold">
                {{ strtoupper(Str::limit($event->nama_event, 20)) }}
            </div>
        @endif

        <!-- Body -->
        <div class="p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-3">{{ $event->nama_event }}</h2>
            <p class="text-gray-600 mb-6 leading-relaxed">{{ $event->deskripsi }}</p>

            <div class="space-y-2 text-sm text-gray-700">
                <p>
                    <x-heroicon-o-calendar class="w-5 h-5 inline mr-2 text-red-700" />
                    {{ $event->tanggal_mulai->format('d M Y H:i') }}
                    @if ($event->tanggal_selesai)
                        - {{ $event->tanggal_selesai->format('d M Y H:i') }}
                    @endif
                </p>
                <p>
                    <x-heroicon-o-map-pin class="w-5 h-5 inline mr-2 text-red-700" />
                    {{ $event->lokasi ?? '-' }}
                </p>
            </div>

            <!-- Tombol -->
            <div class="mt-8">
                @php
                    $sudahDaftar = $event
                        ->peserta()
                        ->where('jemaat_id', auth()->user()->jemaat->id ?? null)
                        ->exists();
                @endphp

                @if ($sudahDaftar)
                    <button class="w-full px-4 py-2 bg-gray-400 text-white rounded-lg cursor-not-allowed font-semibold">
                        ✅ Sudah Terdaftar
                    </button>
                @else
                    <form action="{{ route('event.daftar', $event->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="w-full px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 font-semibold transition">
                            Daftar Event
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
