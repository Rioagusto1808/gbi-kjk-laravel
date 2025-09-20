<x-app-layout>
    <x-slot name="title">Manajemen Renungan</x-slot>

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 py-4 gap-3">
        <h2 class="text-2xl font-merriweather font-semibold text-gray-800">Daftar Renungan</h2>

        <a href="{{ route('renungan.create') }}"
           class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">
            <x-heroicon-o-plus class="w-5 h-5" />
            Tambah Renungan
        </a>
    </div>

    <x-message />

    @if($renungan->count())
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($renungan as $r)
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition p-5 flex flex-col justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">{{ $r->judul }}</h3>
                        <p class="text-sm text-gray-600">Ayat: {{ $r->ayat ?? '-' }}</p>
                        <p class="mt-2 text-sm text-gray-700 line-clamp-3">{{ $r->isi }}</p>
                        <p class="mt-2 text-xs text-gray-500">Oleh: {{ $r->penulis ?? '-' }}</p>
                    </div>

                    <div class="mt-4 flex items-center justify-between">
                        @php
                            $color = $r->status === 'publish'
                                ? 'bg-green-100 text-green-700'
                                : 'bg-yellow-100 text-yellow-700';
                        @endphp
                        <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $color }}">
                            {{ ucfirst($r->status) }}
                        </span>

                        <div class="space-x-2 text-sm">
                            <a href="{{ route('renungan.edit', $r->id) }}"
                               class="inline-flex items-center gap-1 text-indigo-600 hover:text-indigo-900 font-medium">
                                <x-heroicon-o-pencil-square class="w-4 h-4" /> Edit
                            </a>
                            <form id="delete-form-{{ $r->id }}" action="{{ route('renungan.destroy', $r->id) }}" method="POST" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button type="button"
                                    onclick="confirmDelete('{{ $r->id }}', 'Hapus {{ $r->judul }}?', 'Renungan akan dihapus permanen.')"
                                    class="inline-flex items-center gap-1 text-red-600 hover:text-red-900 font-medium">
                                <x-heroicon-o-trash class="w-4 h-4" /> Hapus
                            </button>
                        </div>
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
</x-app-layout>
