@extends('layouts.landing')

@section('content')
    {{-- Header Jadwal --}}
    <section class="relative w-full h-[240px] flex items-center justify-center bg-center bg-cover"
        style="background-image: url('{{ asset('images/header-jadwal.jpg') }}');">
        <div class="absolute inset-0 bg-black/40"></div>
        <h2 class="relative text-3xl font-bold text-white z-10">Semua Jadwal Ibadah</h2>
    </section>

    {{-- Daftar Jadwal --}}
    {{-- Jadwal Ibadah --}}
    <section id="jadwal" class="container mx-auto px-6 py-12">
        {{-- Scroll di mobile, grid di tablet/desktop --}}
        <div class="flex space-x-4 overflow-x-auto pb-4 md:grid md:grid-cols-2 lg:grid-cols-4 md:gap-6 md:space-x-0">
            @forelse ($jadwal as $j)
                <div
                    class="bg-gray-100 shadow rounded-lg p-6 hover:shadow-lg transition min-w-[260px] md:min-w-0 flex-shrink-0">

                    {{-- Status Badge --}}
                    <span
                        class="inline-block mb-2 px-3 py-1 text-xs rounded-full
                        @if ($j->status === 'Sedang Berlangsung') bg-green-100 text-green-700
                        @elseif($j->status === 'Akan Datang') bg-yellow-100 text-yellow-700
                        @else bg-gray-200 text-gray-600 @endif">
                        {{ $j->status }}
                    </span>

                    {{-- Jenis & Tema --}}
                    <h3 class="text-xl font-bold text-red-700">{{ $j->jenis }}</h3>
                    <p class="mt-1 text-gray-800 italic">Tema: {{ $j->tema ?? 'Belum tersedia' }}</p>

                    {{-- Ayat --}}
                    <p class="mt-1 text-sm text-gray-600">Ayat: {{ $j->ayat ?? '-' }}</p>

                    {{-- Gembala --}}
                    <p class="mt-1 text-sm text-gray-600">Gembala: {{ $j->gembala ?? 'Belum tersedia' }}</p>

                    {{-- Tanggal & Waktu --}}
                    <p class="mt-3 text-gray-700 font-medium">
                        {{ $j->tanggal_mulai->translatedFormat('l, d F Y') }}
                    </p>
                    <p class="text-gray-600">
                        {{ $j->tanggal_mulai->format('H:i') }} WIB -
                        {{ $j->tanggal_selesai ? $j->tanggal_selesai->format('H:i') . ' WIB' : 'Selesai' }}
                    </p>

                    {{-- Lokasi --}}
                    <p class="mt-2 flex text-sm text-gray-500"><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg> {{ $j->lokasi }}</p>
                </div>
            @empty
                <p class="text-center text-gray-500 col-span-4">Belum ada jadwal ibadah tersedia.</p>
            @endforelse
        </div>
        <div class="mt-6">{{ $jadwal->links() }}</div>
    </section>
@endsection
