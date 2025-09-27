@csrf

<!-- Nama Pelayanan -->
<div>
    <x-input-label for="nama" :value="__('Nama Pelayanan')" />
    <x-text-input id="nama" type="text" name="nama" value="{{ old('nama', $pelayanan->nama ?? '') }}"
        class="w-full mt-1" required />
    <x-input-error :messages="$errors->get('nama')" class="mt-1" />
</div>

<!-- Deskripsi -->
<div>
    <x-input-label for="deskripsi" :value="__('Deskripsi')" />
    <textarea id="deskripsi" name="deskripsi" rows="3" class="w-full mt-1 border-gray-300 rounded-md">{{ old('deskripsi', $pelayanan->deskripsi ?? '') }}</textarea>
    <x-input-error :messages="$errors->get('deskripsi')" class="mt-1" />
</div>

<!-- Tombol -->
<div class="flex gap-2 justify-end">
    <a href="{{ route('pelayanan.index') }}"
        class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">Batal</a>
    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Simpan</button>
</div>
