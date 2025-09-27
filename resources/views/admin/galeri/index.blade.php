<x-app-layout>
    <x-slot name="title">Manajemen Galeri</x-slot>

    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 py-4 gap-3">
        <h2 class="text-2xl font-merriweather font-semibold text-gray-800">Daftar Galeri</h2>
        <a href="{{ route('galeri.create') }}"
            class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">
            <x-heroicon-o-plus class="w-5 h-5" /> Tambah Foto
        </a>
    </div>

    <x-message />

    @if ($galeri->count())
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($galeri as $g)
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition p-4 flex flex-col justify-between">
                    <img src="{{ Storage::url($g->image) }}" alt="{{ $g->judul }}"
                        class="w-full h-40 object-cover rounded mb-3" />
                    <h3 class="font-semibold">{{ $g->judul }}</h3>
                    <p class="text-sm text-gray-600 line-clamp-2">{{ $g->deskripsi }}</p>

                    <div class="mt-3 flex justify-between text-sm">
                        <a href="{{ route('galeri.edit', $g->id) }}" class="text-indigo-600 hover:underline">Edit</a>
                        <form action="{{ route('galeri.destroy', $g->id) }}" method="POST"
                            onsubmit="return confirm('Hapus foto ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $galeri->links() }}
        </div>
    @else
        <p class="text-center text-gray-500">Belum ada foto di galeri.</p>
    @endif
</x-app-layout>
