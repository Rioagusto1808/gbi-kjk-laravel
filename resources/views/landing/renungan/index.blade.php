@extends('layouts.landing')

@section('content')
    {{-- Header Renungan --}}
    <section class="relative w-full h-[240px] flex items-center justify-center bg-center bg-cover"
        style="background-image: url('{{ asset('images/header-renungan.jpg') }}');">
        <div class="absolute inset-0 bg-black/40"></div>
        <h2 class="relative text-3xl font-bold text-white z-10">Renungan</h2>
    </section>

    {{-- Daftar Renungan --}}
    <section class="container mx-auto px-6 py-12">
        @if ($renungan->count())
            <div class="grid gap-6 grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
                @foreach ($renungan as $r)
                    <div class="bg-white shadow rounded overflow-hidden hover:shadow-lg transition flex flex-col">
                        <div class="p-4 flex flex-col flex-1">
                            <h3 class="font-bold text-lg text-gray-800 mb-1">{{ $r->judul }}</h3>

                            @if ($r->ayat)
                                <p class="text-sm text-gray-600 italic mb-1">Ayat: {{ $r->ayat }}</p>
                            @endif

                            <p class="text-xs text-gray-500 mb-2">
                                {{ $r->created_at->translatedFormat('d F Y') }}
                                @if ($r->penulis)
                                    • {{ $r->penulis }}
                                @endif
                            </p>

                            <p class="text-sm text-gray-700 line-clamp-3 flex-1">
                                {{ Str::limit(strip_tags($r->isi ?? ''), 120) }}
                            </p>

                            {{-- Link detail --}}
                            <a href="{{ route('renungan.public.show', $r->id) }}"
                                class="mt-3 inline-block text-red-700 font-medium hover:underline">
                                Baca Selengkapnya →
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $renungan->links() }}
            </div>
        @else
            <p class="text-center text-gray-500">Belum ada renungan.</p>
        @endif
    </section>
@endsection
