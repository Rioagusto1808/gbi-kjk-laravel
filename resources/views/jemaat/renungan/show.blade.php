<x-app-layout>
    <x-slot name="title">{{ $renungan->judul }}</x-slot>

    <div class="max-w-3xl mx-auto bg-white shadow rounded-lg p-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-2">{{ $renungan->judul }}</h2>
        <p class="text-sm text-gray-600 mb-2">Ayat: {{ $renungan->ayat ?? '-' }}</p>

        <div class="prose max-w-none text-gray-700">
            {!! nl2br(e($renungan->isi)) !!}
        </div>

        @if($renungan->doa)
            <div class="mt-4 p-4 bg-gray-50 rounded">
                <h3 class="text-sm font-semibold text-gray-800 mb-1">Doa</h3>
                <p class="text-gray-700 italic">{{ $renungan->doa }}</p>
            </div>
        @endif

        <div class="mt-6 flex justify-between items-center text-sm text-gray-500">
            <span>Penulis: {{ $renungan->penulis ?? '-' }}</span>
            <span>Diterbitkan: {{ $renungan->created_at->format('d M Y') }}</span>
        </div>

        <div class="mt-6">
            <a href="{{ route('jemaat.renungan.index') }}"
               class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
                Kembali
            </a>
        </div>
    </div>
</x-app-layout>
