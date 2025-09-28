<x-app-layout>
    <x-slot name="title">Peserta Event: {{ $event->nama_event }}</x-slot>

    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">
            Peserta Event: {{ $event->nama_event }}
        </h2>
        <p class="text-gray-600">Total peserta: {{ $peserta->total() }}</p>
    </div>

    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-indigo-600 text-white">
                <tr>
                    <th class="px-6 py-3 text-left">No</th>
                    <th class="px-6 py-3 text-left">Nama Jemaat</th>
                    <th class="px-6 py-3 text-left">Status</th>
                    <th class="px-6 py-3 text-left">Hadir</th>
                    <th class="px-6 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($peserta as $index => $p)
                    <tr>
                        <td class="px-6 py-4">{{ $peserta->firstItem() + $index }}</td>
                        <td class="px-6 py-4">{{ $p->jemaat->name ?? '-' }}</td>
                        <td class="px-6 py-4">
                            <span
                                class="px-2 py-1 rounded-full text-xs font-medium
                                @if ($p->status === 'Daftar') bg-yellow-100 text-yellow-700
                                @elseif($p->status === 'Dikonfirmasi') bg-green-100 text-green-700
                                @elseif($p->status === 'Bayar') bg-blue-100 text-blue-700
                                @elseif($p->status === 'Batal') bg-red-100 text-red-700
                                @else bg-gray-100 text-gray-700 @endif">
                                {{ $p->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            {{ $p->hadir ? '✅' : '-' }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <form action="{{ route('event.peserta.update', $p->id) }}" method="POST"
                                class="inline-flex items-center gap-2">
                                @csrf
                                @method('PATCH')
                                <select name="status" class="border-gray-300 rounded text-sm">
                                    <option value="Daftar" {{ $p->status === 'Daftar' ? 'selected' : '' }}>Daftar
                                    </option>
                                    <option value="Dikonfirmasi" {{ $p->status === 'Dikonfirmasi' ? 'selected' : '' }}>
                                        Dikonfirmasi</option>
                                    <option value="Bayar" {{ $p->status === 'Bayar' ? 'selected' : '' }}>Bayar</option>
                                    <option value="Batal" {{ $p->status === 'Batal' ? 'selected' : '' }}>Batal
                                    </option>
                                </select>
                                <input type="checkbox" name="hadir" value="1"
                                    {{ $p->hadir ? 'checked' : '' }} /> Hadir
                                <button type="submit"
                                    class="px-3 py-1 bg-indigo-600 text-white rounded hover:bg-indigo-700 text-xs">
                                    Update
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $peserta->links() }}
    </div>
</x-app-layout>
