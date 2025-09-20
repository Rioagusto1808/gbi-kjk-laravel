<x-app-layout>
    <x-slot name="title">Recycle Bin Jemaat</x-slot>

    <!-- Header -->
    <div class="flex justify-between items-center mb-6 py-4">
        <h2 class="text-2xl font-semibold text-gray-800">Recycle Bin Jemaat</h2>
        <a href="{{ route('jemaat.index') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
            ← Kembali ke Daftar Jemaat
        </a>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-red-600 text-white">
                <tr>
                    <th class="px-6 py-3 text-left font-semibold tracking-wider">No</th>
                    <th class="px-6 py-3 text-left font-semibold tracking-wider">Nama Lengkap</th>
                    <th class="px-6 py-3 text-left font-semibold tracking-wider">No HP</th>
                    <th class="px-6 py-3 text-left font-semibold tracking-wider">Alamat</th>
                    <th class="px-6 py-3 text-right font-semibold tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($jemaat as $index => $j)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">{{ $jemaat->firstItem() + $index }}</td>
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $j->name }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $j->no_hp ?? '-' }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ Str::limit($j->alamat, 30) ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right space-x-2">
                            <!-- Restore -->
                            <form action="{{ route('jemaat.restore', $j->id) }}" method="POST" class="inline-block">
                                @csrf
                                <button class="inline-flex items-center gap-1 text-green-600 hover:text-green-900 font-medium">
                                    <x-heroicon-o-arrow-path class="w-4 h-4" />
                                    Restore
                                </button>
                            </form>
                            
                            <!-- Hapus Permanen -->
                            <form id="delete-form-{{ $j->id }}" action="{{ route('jemaat.force-delete', $j->id) }}" method="POST" class="inline-block hidden">
                                @csrf
                                @method('DELETE')
                            </form>

                            <button type="button" 
                                    onclick="confirmDelete('{{ $j->id }}', 'Yakin hapus jemaat {{ $j->name }}?', 'Data jemaat ini tidak bisa dipulihkan.')"
                                    class="inline-flex items-center gap-1 text-red-600 hover:text-red-900 font-medium">
                                <x-heroicon-o-trash class="w-4 h-4" />
                                Hapus
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                            Tidak ada jemaat di recycle bin.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $jemaat->links() }}
    </div>
</x-app-layout>
