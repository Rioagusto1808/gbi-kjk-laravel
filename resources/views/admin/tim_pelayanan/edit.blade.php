<x-app-layout>
    <x-slot name="title">Edit Tim Pelayanan</x-slot>

    <div class="max-w-3xl mx-auto bg-white shadow rounded-lg p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Edit Tim Pelayanan</h2>

        <form method="POST" action="{{ route('tim-pelayanan.update', [$ibadah->id, $timPelayanan->id]) }}" class="space-y-4">
            @csrf @method('PUT')

            <div>
                <x-input-label for="pelayanan_id" :value="__('Kategori Pelayanan')" />
                <select name="pelayanan_id" id="pelayanan_id" class="w-full mt-1 border-gray-300 rounded-md">
                    @foreach($pelayanan as $p)
                        <option value="{{ $p->id }}" {{ $timPelayanan->pelayanan_id == $p->id ? 'selected' : '' }}>
                            {{ $p->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <x-input-label for="jemaat_id" :value="__('Jemaat')" />
                <select name="jemaat_id" id="jemaat_id" class="w-full mt-1 border-gray-300 rounded-md">
                    @foreach($jemaat as $j)
                        <option value="{{ $j->id }}" {{ $timPelayanan->jemaat_id == $j->id ? 'selected' : '' }}>
                            {{ $j->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-end gap-2">
                <a href="{{ route('tim-pelayanan.index', $ibadah->id) }}"
                   class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">Batal</a>
                <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Update</button>
            </div>
        </form>
    </div>
</x-app-layout>
