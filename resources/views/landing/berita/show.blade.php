@extends('layouts.landing')

@section('content')
    <section class="container mx-auto px-6 py-12">
        <div class="grid lg:grid-cols-3 gap-8">
            {{-- Kolom utama --}}
            <div class="lg:col-span-2">
                <article class="bg-white shadow rounded-lg p-6">
                    {{-- Gambar utama --}}
                    @if ($berita->files->count())
                        <img src="{{ Storage::url($berita->files->first()->path) }}" alt="{{ $berita->judul }}"
                            class="w-full h-80 object-cover rounded mb-6">
                    @endif

                    {{-- Gallery gambar tambahan --}}
                    @if ($berita->files->count() > 1)
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-6">
                            @foreach ($berita->files->skip(1) as $file)
                                <img src="{{ Storage::url($file->path) }}" alt="{{ $berita->judul }}"
                                    class="w-full h-32 object-cover rounded hover:opacity-80 transition">
                            @endforeach
                        </div>
                    @endif

                    <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $berita->judul }}</h1>
                    <p class="text-sm text-gray-500 mb-6">
                        {{ $berita->published_at?->translatedFormat('d F Y, H:i') ?? 'Belum dipublikasikan' }}
                        @if ($berita->author)
                            | {{ $berita->author->name }}
                        @endif
                    </p>

                    <div class="prose max-w-none">
                        {!! $berita->isi !!}
                    </div>

                    {{-- Tombol kembali --}}
                    <div class="mt-8">
                        <a href="{{ route('berita.public.index') }}"
                            class="inline-block px-4 py-2 bg-red-700 text-white rounded hover:bg-red-800 transition">
                            ← Kembali ke Berita
                        </a>
                    </div>
                </article>
            </div>

            {{-- Sidebar berita lainnya --}}
            <div>
                <div class="bg-white shadow rounded-lg p-4">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Berita Lainnya</h2>

                    @foreach ($beritaLain as $b)
                        <div
                            class="flex items-start gap-3 mb-4 pb-4 border-b border-gray-200 last:border-0 last:mb-0 last:pb-0">
                            {{-- Thumbnail --}}
                            @if ($b->files->count())
                                <img src="{{ Storage::url($b->files->first()->path) }}" alt="{{ $b->judul }}"
                                    class="w-20 h-16 object-cover rounded">
                            @else
                                <img src="{{ asset('images/no-image.jpg') }}" alt="No Image"
                                    class="w-20 h-16 object-cover rounded">
                            @endif

                            {{-- Info --}}
                            <div class="flex-1">
                                <a href="{{ route('berita.public.show', $b->id) }}"
                                    class="font-semibold text-sm text-gray-800 hover:text-red-700 line-clamp-2">
                                    {{ $b->judul }}
                                </a>
                                <p class="text-xs text-gray-500 mt-1">
                                    {{ $b->published_at?->translatedFormat('d M Y') }}
                                </p>
                                <p class="text-xs text-gray-500 mt-1">
                                    {{ $berita->author->name ?? 'Admin' }}
                                </p>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>
@endsection
