@extends('layouts.landing')

@section('content')
<section class="container mx-auto px-6 py-12">
    <h2 class="text-3xl font-bold mb-6 text-center">Semua Berita</h2>

    @if ($berita->count())
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
            @foreach ($berita as $b)
                <div class="bg-white shadow rounded overflow-hidden hover:shadow-lg transition flex flex-col">
                    {{-- Gambar --}}
                    @if ($b->files->count())
                        <img src="{{ Storage::url($b->files->first()->path) }}" 
                             alt="{{ $b->judul }}" class="w-full h-48 object-cover">
                    @else
                        <img src="{{ asset('images/no-image.jpg') }}" 
                             alt="No Image" class="w-full h-48 object-cover">
                    @endif

                    <div class="p-4 flex flex-col flex-1">
                        <h3 class="font-bold text-lg text-gray-800 mb-2">{{ $b->judul }}</h3>

                        <p class="text-xs text-gray-500 mb-2">
                            {{ $b->published_at?->translatedFormat('d F Y') ?? 'Belum dipublikasikan' }}
                        </p>

                        <p class="text-sm text-gray-700 line-clamp-3">
                            {{ Str::limit(strip_tags($b->isi ?? ''), 120) }}
                        </p>

                        {{-- Link baca selengkapnya --}}
                        <a href="{{ route('berita.public.show', $b->id) }}" 
                           class="mt-3 inline-block text-red-700 font-semibold hover:underline">
                           Baca Selengkapnya →
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $berita->links() }}
        </div>
    @else
        <p class="text-center text-gray-500">Belum ada berita.</p>
    @endif
</section>
@endsection
