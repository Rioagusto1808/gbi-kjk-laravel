@extends('layouts.landing')

@section('content')
<section class="container mx-auto px-6 py-12 max-w-3xl">
    <article class="bg-white shadow rounded-lg p-6">
        {{-- Judul --}}
        <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $renungan->judul }}</h1>

        {{-- Tanggal & Penulis --}}
        <p class="text-sm text-gray-500 mb-6">
            {{ $renungan->published_at?->translatedFormat('d F Y, H:i') ?? 'Belum dipublikasikan' }}
            @if ($renungan->author)
                • Oleh {{ $renungan->author->name }}
            @endif
        </p>

        {{-- Isi Renungan --}}
        <div class="prose max-w-none">
            {!! $renungan->isi !!}
        </div>

        {{-- Tombol kembali --}}
        <div class="mt-8">
            <a href="{{ route('renungan.public.index') }}" 
               class="inline-block px-4 py-2 bg-red-700 text-white rounded hover:bg-red-800 transition">
               ← Kembali ke Renungan
            </a>
        </div>
    </article>
</section>
@endsection
