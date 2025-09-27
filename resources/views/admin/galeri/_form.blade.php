@csrf
@if (isset($galeri))
    @method('PUT')
@endif

<!-- Judul Foto -->
<div>
    <x-input-label for="judul" :value="__('Judul Foto')" />
    <x-text-input id="judul" type="text" name="judul" value="{{ old('judul', $galeri->judul ?? '') }}"
        class="w-full mt-1" required />
    <x-input-error :messages="$errors->get('judul')" class="mt-1" />
</div>

<!-- Deskripsi -->
<div>
    <x-input-label for="deskripsi" :value="__('Deskripsi (opsional)')" />
    <textarea id="deskripsi" name="deskripsi" rows="3" class="w-full mt-1 border-gray-300 rounded-md">{{ old('deskripsi', $galeri->deskripsi ?? '') }}</textarea>
    <x-input-error :messages="$errors->get('deskripsi')" class="mt-1" />
</div>

<!-- Upload Foto -->
<div>
    <x-input-label for="image" :value="__('Foto')" />
    <input type="file" id="image" name="image" accept="image/*" class="w-full mt-1 border-gray-300 rounded-md"
        required="{{ isset($galeri) ? false : true }}">

    @if (isset($galeri) && $galeri->image)
        <div class="mt-3">
            <img src="{{ Storage::url($galeri->image) }}" alt="{{ $galeri->judul }}"
                class="w-full h-40 object-cover rounded shadow" />
        </div>
    @endif

    <x-input-error :messages="$errors->get('image')" class="mt-1" />
</div>

<!-- Tombol -->
<div class="flex gap-2 justify-end">
    <a href="{{ route('galeri.index') }}"
        class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">Batal</a>
    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
        {{ isset($galeri) ? 'Update' : 'Simpan' }}
    </button>
</div>
