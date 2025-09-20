<x-app-layout>
    <x-slot name="title">Tambah Tim Pelayanan</x-slot>

    <div class="max-w-3xl mx-auto bg-white shadow rounded-lg p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Tambah Tim Pelayanan</h2>

        <form method="POST" action="{{ route('tim-pelayanan.store', $ibadah->id) }}" class="space-y-4">
            @csrf

            <div>
                <x-input-label for="pelayanan_id" :value="__('Kategori Pelayanan')" />
                <select name="pelayanan_id" id="pelayanan_id" class="w-full mt-1 border-gray-300 rounded-md">
                    @foreach($pelayanan as $p)
                        <option value="{{ $p->id }}">{{ $p->nama }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('pelayanan_id')" class="mt-1" />
            </div>

            <div>
                <x-input-label for="jemaat_id" :value="__('Jemaat')" />
                <select name="jemaat_id" id="jemaat_id" class="w-full mt-1 border-gray-300 rounded-md">
                    @foreach($jemaat as $j)
                        <option value="{{ $j->id }}">{{ $j->name }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('jemaat_id')" class="mt-1" />
            </div>

            <div class="flex justify-end gap-2">
                <a href="{{ route('tim-pelayanan.index', $ibadah->id) }}"
                   class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">Batal</a>
                <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Simpan</button>
            </div>
        </form>
    </div>
</x-app-layout>
