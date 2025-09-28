<x-app-layout>
    <h2 class="text-2xl font-bold mb-4">Peserta Event: {{ $event->nama_event }}</h2>

    <div class="bg-white shadow rounded p-4">
        <table class="w-full text-sm border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2">No</th>
                    <th class="px-4 py-2">Nama Jemaat</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Hadir</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($peserta as $index => $p)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $peserta->firstItem() + $index}}</td>
                        <td class="px-4 py-2">{{ $p->jemaat->name ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $p->status }}</td>
                        <td class="px-4 py-2">{{ $p->hadir ? '✅' : '❌' }}</td>
                        <td class="px-4 py-2">
                            <form action="{{ route('event.peserta.update', $p->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <select name="status" class="border rounded p-1 text-sm">
                                    @foreach (['Daftar', 'Dikonfirmasi', 'Bayar', 'Batal'] as $status)
                                        <option value="{{ $status }}"
                                            {{ $p->status === $status ? 'selected' : '' }}>
                                            {{ $status }}
                                        </option>
                                    @endforeach
                                </select>
                                <label class="ml-2 text-sm">
                                    <input type="checkbox" name="hadir" value="1"
                                        {{ $p->hadir ? 'checked' : '' }}> Hadir
                                </label>
                                <button type="submit" class="ml-2 px-3 py-1 bg-indigo-600 text-white rounded text-sm">
                                    Simpan
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $peserta->links() }}
        </div>
    </div>
</x-app-layout>
