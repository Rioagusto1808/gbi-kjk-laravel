@csrf
@if (isset($carousel))
    @method('PUT')
@endif

<!-- Judul -->
<div>
    <x-input-label for="judul" :value="__('Judul Carousel')" />
    <x-text-input id="judul" type="text" name="judul" value="{{ old('judul', $carousel->judul ?? '') }}"
        class="w-full mt-1" required />
    <x-input-error :messages="$errors->get('judul')" class="mt-1" />
</div>

<!-- Deskripsi -->
<div>
    <x-input-label for="deskripsi" :value="__('Deskripsi (opsional)')" />
    <textarea id="deskripsi" name="deskripsi" rows="3" class="w-full mt-1 border-gray-300 rounded-md">{{ old('deskripsi', $carousel->deskripsi ?? '') }}</textarea>
    <x-input-error :messages="$errors->get('deskripsi')" class="mt-1" />
</div>

<!-- Urutan -->
<div>
    <x-input-label for="urutan" :value="__('Urutan Tampil')" />
    <x-text-input id="urutan" type="number" name="urutan" value="{{ old('urutan', $carousel->urutan ?? 1) }}"
        class="w-full mt-1" min="1" required />
    <x-input-error :messages="$errors->get('urutan')" class="mt-1" />
</div>

<!-- Status -->
<div>
    <x-input-label for="aktif" :value="__('Status')" />
    <select id="aktif" name="aktif" class="w-full mt-1 border-gray-300 rounded-md">
        <option value="1" {{ old('aktif', $carousel->aktif ?? 1) == 1 ? 'selected' : '' }}>Aktif</option>
        <option value="0" {{ old('aktif', $carousel->aktif ?? 1) == 0 ? 'selected' : '' }}>Nonaktif</option>
    </select>
    <x-input-error :messages="$errors->get('aktif')" class="mt-1" />
</div>

<!-- Upload Gambar -->
<div>
    <x-input-label for="image" :value="__('Gambar Carousel')" />
    <input type="file" id="image" name="image" accept="image/*"
        class="w-full mt-1 border-gray-300 rounded-md" />

    @if (isset($carousel) && $carousel->image)
        <div class="mt-3">
            <p class="text-sm font-medium text-gray-700 mb-1">Gambar Lama</p>
            <img src="{{ Storage::url($carousel->image) }}" alt="{{ $carousel->judul }}"
                class="w-full h-40 object-cover rounded shadow" />
        </div>
    @endif

    <x-input-error :messages="$errors->get('image')" class="mt-1" />
</div>

<!-- Tombol -->
<div class="flex gap-2 justify-end">
    <a href="{{ route('carousel.index') }}"
        class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">Batal</a>
    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
        {{ isset($carousel) ? 'Update' : 'Simpan' }}
    </button>
</div>
