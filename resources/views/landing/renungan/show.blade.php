@extends('layouts.landing')

@section('content')
    <section class="container mx-auto px-6 py-12 grid lg:grid-cols-3 gap-8">
        {{-- Konten Renungan --}}
        <article class="lg:col-span-2 bg-white shadow rounded-lg p-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $renungan->judul }} </h1>
            <p class="text-sm text-gray-500 mb-6">
                {{ $renungan->created_at->translatedFormat('d F Y, H:i') }} | {{ $renungan->penulis ?? '-' }}
            </p>

            <div class="prose max-w-none">
                {!! $renungan->isi !!}
            </div>

            <div class="mt-8">
                <a href="{{ route('renungan.public.index') }}"
                    class="inline-block px-4 py-2 bg-red-700 text-white rounded hover:bg-red-800 transition">
                    ← Kembali ke Renungan
                </a>
            </div>
        </article>

        {{-- Sidebar Berita --}}
        <aside class="space-y-4">
            <div class="bg-white shadow rounded-lg p-4">
                <h3 class="font-semibold text-lg mb-4">Berita Terbaru</h3>
                @forelse ($berita as $b)
                    <div class="flex items-center gap-3 mb-3">
                        @if ($b->files->count())
                            <img src="{{ Storage::url($b->files->first()->path) }}" alt="{{ $b->judul }}"
                                class="w-16 h-16 object-cover rounded">
                        @else
                            <img src="{{ asset('images/no-image.jpg') }}" alt="No Image"
                                class="w-16 h-16 object-cover rounded">
                        @endif
                        <div>
                            <a href="{{ route('berita.public.show', $b->id) }}"
                                class="text-sm font-medium text-gray-800 hover:text-red-700">
                                {{ Str::limit($b->judul, 50) }}
                            </a>
                            <p class="text-xs text-gray-500">{{ $b->published_at?->translatedFormat('d M Y') }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-gray-500">Belum ada berita.</p>
                @endforelse
            </div>
        </aside>
    </section>
@endsection
