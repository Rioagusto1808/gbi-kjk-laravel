@extends('layouts.landing')

@section('content')
<section class="container mx-auto px-6 py-12">
    <h2 class="text-3xl font-bold mb-6 text-center">Renungan Harian</h2>

    @if ($renungan->count())
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($renungan as $r)
                <div class="bg-white shadow rounded overflow-hidden hover:shadow-lg transition">
                    <div class="p-4 flex flex-col h-full">
                        {{-- Judul --}}
                        <h3 class="font-bold text-lg text-gray-800 mb-2">{{ $r->judul }}</h3>

                        {{-- Tanggal --}}
                        <p class="text-xs text-gray-500 mb-2">
                            {{ $r->published_at?->translatedFormat('d F Y') ?? 'Belum dipublikasikan' }}
                        </p>

                        {{-- Isi singkat --}}
                        <p class="text-sm text-gray-700 line-clamp-3 flex-1">
                            {{ Str::limit(strip_tags($r->isi ?? ''), 150) }}
                        </p>

                        {{-- Link detail --}}
                        <a href="{{ route('renungan.public.show', $r->id) }}"
                           class="mt-3 inline-block text-red-700 font-medium text-sm hover:underline">
                            Baca Selengkapnya →
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $renungan->links() }}
        </div>
    @else
        <p class="text-center text-gray-500">Belum ada renungan.</p>
    @endif
</section>
@endsection
