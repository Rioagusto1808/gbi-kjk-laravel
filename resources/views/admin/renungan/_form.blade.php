@csrf

<!-- Judul -->
<div>
    <x-input-label for="judul" :value="__('Judul Renungan')" />
    <x-text-input id="judul" type="text" name="judul" value="{{ old('judul', $renungan->judul ?? '') }}"
        class="w-full mt-1" required />
    <x-input-error :messages="$errors->get('judul')" class="mt-1" />
</div>

<!-- Ayat -->
<div>
    <x-input-label for="ayat" :value="__('Ayat')" />
    <x-text-input id="ayat" type="text" name="ayat" value="{{ old('ayat', $renungan->ayat ?? '') }}"
        class="w-full mt-1" />
    <x-input-error :messages="$errors->get('ayat')" class="mt-1" />
</div>

<!-- Isi -->
<div>
    <x-input-label for="isi" :value="__('Isi Renungan')" />
    <textarea id="isi" name="isi" rows="5" class="w-full mt-1 border-gray-300 rounded-md">{{ old('isi', $renungan->isi ?? '') }}</textarea>
    <x-input-error :messages="$errors->get('isi')" class="mt-1" />
</div>

<!-- Doa -->
<div>
    <x-input-label for="doa" :value="__('Doa')" />
    <textarea id="doa" name="doa" rows="3" class="w-full mt-1 border-gray-300 rounded-md">{{ old('doa', $renungan->doa ?? '') }}</textarea>
    <x-input-error :messages="$errors->get('doa')" class="mt-1" />
</div>

<!-- Penulis -->
<div>
    <x-input-label for="penulis" :value="__('Penulis')" />
    <x-text-input id="penulis" type="text" name="penulis" value="{{ old('penulis', $renungan->penulis ?? '') }}"
        class="w-full mt-1" />
    <x-input-error :messages="$errors->get('penulis')" class="mt-1" />
</div>

<!-- Status -->
<div>
    <x-input-label for="status" :value="__('Status')" />
    <select name="status" id="status" class="w-full mt-1 border-gray-300 rounded-md">
        @foreach (['draft' => 'Draft', 'publish' => 'Publish'] as $val => $label)
            <option value="{{ $val }}"
                {{ old('status', $renungan->status ?? 'draft') === $val ? 'selected' : '' }}>
                {{ $label }}
            </option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get('status')" class="mt-1" />
</div>

<!-- Tombol -->
<div class="flex gap-2 justify-end">
    <a href="{{ route('renungan.index') }}"
        class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">Batal</a>
    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Simpan</button>
</div>
