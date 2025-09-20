@csrf

<!-- Jenis -->
<div>
    <x-input-label for="jenis" :value="__('Jenis Ibadah')" />
    <select name="jenis" id="jenis" class="w-full mt-1 border-gray-300 rounded-md">
        @foreach(['Umum','Sekolah Minggu','Youth','Doa','Lainnya'] as $opt)
            <option value="{{ $opt }}" {{ old('jenis', $ibadah->jenis ?? '') === $opt ? 'selected' : '' }}>
                {{ $opt }}
            </option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get('jenis')" class="mt-1" />
</div>

<!-- Tanggal Mulai -->
<div>
    <x-input-label for="tanggal_mulai" :value="__('Tanggal Mulai')" />
    <x-text-input id="tanggal_mulai" type="datetime-local" name="tanggal_mulai"
        value="{{ old('tanggal_mulai', isset($ibadah) ? $ibadah->tanggal_mulai->format('Y-m-d\TH:i') : '') }}"
        class="w-full mt-1" required />
    <x-input-error :messages="$errors->get('tanggal_mulai')" class="mt-1" />
</div>

<!-- Tanggal Selesai -->
<div>
    <x-input-label for="tanggal_selesai" :value="__('Tanggal Selesai')" />
    <x-text-input id="tanggal_selesai" type="datetime-local" name="tanggal_selesai"
        value="{{ old('tanggal_selesai', isset($ibadah) && $ibadah->tanggal_selesai ? $ibadah->tanggal_selesai->format('Y-m-d\TH:i') : '') }}"
        class="w-full mt-1" />
    <x-input-error :messages="$errors->get('tanggal_selesai')" class="mt-1" />
</div>

<!-- Lokasi -->
<div>
    <x-input-label for="lokasi" :value="__('Lokasi')" />
    <x-text-input id="lokasi" type="text" name="lokasi"
        value="{{ old('lokasi', $ibadah->lokasi ?? '') }}" class="w-full mt-1" />
    <x-input-error :messages="$errors->get('lokasi')" class="mt-1" />
</div>

<!-- Tema -->
<div>
    <x-input-label for="tema" :value="__('Tema')" />
    <x-text-input id="tema" type="text" name="tema"
        value="{{ old('tema', $ibadah->tema ?? '') }}" class="w-full mt-1" />
    <x-input-error :messages="$errors->get('tema')" class="mt-1" />
</div>

<!-- Ayat -->
<div>
    <x-input-label for="ayat" :value="__('Ayat')" />
    <x-text-input id="ayat" type="text" name="ayat"
        value="{{ old('ayat', $ibadah->ayat ?? '') }}" class="w-full mt-1" />
    <x-input-error :messages="$errors->get('ayat')" class="mt-1" />
</div>

<!-- Gembala -->
<div>
    <x-input-label for="gembala" :value="__('Gembala')" />
    <x-text-input id="gembala" type="text" name="gembala"
        value="{{ old('gembala', $ibadah->gembala ?? '') }}" class="w-full mt-1" />
    <x-input-error :messages="$errors->get('gembala')" class="mt-1" />
</div>

<!-- Deskripsi -->
<div>
    <x-input-label for="deskripsi" :value="__('Deskripsi')" />
    <textarea id="deskripsi" name="deskripsi" rows="3" class="w-full mt-1 border-gray-300 rounded-md">{{ old('deskripsi', $ibadah->deskripsi ?? '') }}</textarea>
    <x-input-error :messages="$errors->get('deskripsi')" class="mt-1" />
</div>

<!-- Status -->
<div>
    <x-input-label for="status" :value="__('Status')" />
    <select name="status" id="status" class="w-full mt-1 border-gray-300 rounded-md">
        @foreach(['Akan Datang','Sedang Berlangsung','Selesai'] as $opt)
            <option value="{{ $opt }}" {{ old('status', $ibadah->status ?? 'Akan Datang') === $opt ? 'selected' : '' }}>
                {{ $opt }}
            </option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get('status')" class="mt-1" />
</div>

<!-- Tombol -->
<div class="flex gap-2 justify-end">
    <a href="{{ route('ibadah.index') }}"
       class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">Batal</a>
    <button type="submit"
       class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Simpan</button>
</div>
