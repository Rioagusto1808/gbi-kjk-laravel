@extends('layouts.landing')

@section('content')
    {{-- Header Event --}}
    <section class="relative w-full h-[240px] flex items-center justify-center bg-center bg-cover"
        style="background-image: url('{{ asset('images/header-event.jpg') }}');">
        <div class="absolute inset-0 bg-black/40"></div>
        <h2 class="relative text-3xl font-bold text-white z-10">Semua Event</h2>
    </section>

    {{-- Daftar Event --}}
    <section id="event" class="container mx-auto px-6 py-12">
        @if ($event->count())
            <div class="grid gap-6 grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
                @foreach ($event as $e)
                    <div class="bg-white shadow rounded-lg overflow-hidden hover:shadow-lg transition flex flex-col">
                        {{-- Gambar --}}
                        @if ($e->image)
                            <img src="{{ Storage::url($e->image) }}" alt="{{ $e->nama_event }}"
                                class="w-full h-48 object-cover">
                        @else
                            <img src="{{ asset('images/no-image.jpg') }}" alt="No Image" class="w-full h-48 object-cover">
                        @endif

                        <div class="p-4 flex flex-col flex-1">
                            {{-- Status --}}
                            <span
                                class="inline-block mb-2 px-3 py-1 text-xs rounded-full
                                @if ($e->status === 'Sedang Berlangsung') bg-green-100 text-green-700
                                @elseif($e->status === 'Akan Datang') bg-yellow-100 text-yellow-700
                                @else bg-gray-200 text-gray-600 @endif">
                                {{ $e->status }}
                            </span>

                            {{-- Nama Event --}}
                            <h3 class="font-bold text-lg text-red-700 mb-1">{{ $e->nama_event }}</h3>

                            {{-- Tema --}}
                            @if ($e->tema)
                                <p class="text-sm italic text-gray-600 mb-2">Tema: {{ $e->tema }}</p>
                            @endif

                            {{-- Deskripsi --}}
                            <p class="text-sm text-gray-700 line-clamp-3 flex-1">
                                {{ Str::limit(strip_tags($e->deskripsi ?? ''), 120) }}
                            </p>

                            {{-- Detail info --}}
                            <div class="mt-3 text-sm text-gray-500 space-y-1">
                                <p>📅 {{ $e->tanggal_mulai->translatedFormat('l, d F Y H:i') }}
                                    @if ($e->tanggal_selesai)
                                        - {{ $e->tanggal_selesai->translatedFormat('H:i') }} WIB
                                    @endif
                                </p>
                                @if ($e->lokasi)
                                    <p>📍 {{ $e->lokasi }}</p>
                                @endif
                                <p>💰 {{ $e->biaya > 0 ? 'Rp' . number_format($e->biaya, 0, ',', '.') : 'Gratis' }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $event->links() }}
            </div>
        @else
            <p class="text-center text-gray-500">Belum ada event tersedia.</p>
        @endif
    </section>
@endsection
