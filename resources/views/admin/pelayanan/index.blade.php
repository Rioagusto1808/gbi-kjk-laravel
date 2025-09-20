<x-app-layout>
    <x-slot name="title">Manajemen Kategori Pelayanan</x-slot>

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 py-4 gap-3">
        <h2 class="text-2xl font-merriweather font-semibold text-gray-800">Daftar Kategori Pelayanan</h2>

        <div class="flex flex-col sm:flex-row gap-2">
            <a href="{{ route('pelayanan.create') }}"
               class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">
                <x-heroicon-o-plus class="w-5 h-5" />
                Tambah Kategori Pelayanan
            </a>
        </div>
    </div>

    <x-message />

    <!-- Cards -->
    @if($pelayanan->count())
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($pelayanan as $p)
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition p-5 flex flex-col justify-between">
                    <div>
                        <!-- Nama Pelayanan -->
                        <h3 class="text-lg font-semibold text-gray-800">{{ $p->nama }}</h3>

                        <!-- Deskripsi -->
                        <p class="text-sm text-gray-600 mb-2">{{ Str::limit($p->deskripsi, 80) ?? '-' }}</p>
                    </div>

                    <!-- Actions -->
                    <div class="mt-4 flex items-center justify-end space-x-2 text-sm">
                        <a href="{{ route('pelayanan.edit', $p->id) }}"
                           class="inline-flex items-center gap-1 text-indigo-600 hover:text-indigo-900 font-medium">
                            <x-heroicon-o-pencil-square class="w-4 h-4" /> Edit
                        </a>
                        <form id="delete-form-{{ $p->id }}" action="{{ route('pelayanan.destroy', $p->id) }}" method="POST" class="inline-block hidden">
                            @csrf
                            @method('DELETE')
                        </form>
                        <button type="button"
                                onclick="confirmDelete('{{ $p->id }}', 'Hapus {{ $p->nama }}?', 'Data pelayanan akan dihapus.')"
                                class="inline-flex items-center gap-1 text-red-600 hover:text-red-900 font-medium">
                            <x-heroicon-o-trash class="w-4 h-4" /> Hapus
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $pelayanan->links() }}
        </div>
    @else
        <p class="text-center text-gray-500">Tidak ada data kategori pelayanan.</p>
    @endif
</x-app-layout>
