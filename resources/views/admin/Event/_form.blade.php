@csrf

<!-- Nama Event -->
<div>
    <x-input-label for="nama_event" :value="__('Nama Event')" />
    <x-text-input id="nama_event" type="text" name="nama_event"
        value="{{ old('nama_event', $event->nama_event ?? '') }}"
        class="w-full mt-1" required />
    <x-input-error :messages="$errors->get('nama_event')" class="mt-1" />
</div>

<!-- Tema -->
<div>
    <x-input-label for="tema" :value="__('Tema')" />
    <x-text-input id="tema" type="text" name="tema"
        value="{{ old('tema', $event->tema ?? '') }}"
        class="w-full mt-1" />
    <x-input-error :messages="$errors->get('tema')" class="mt-1" />
</div>

<!-- Deskripsi -->
<div>
    <x-input-label for="deskripsi" :value="__('Deskripsi')" />
    <textarea id="deskripsi" name="deskripsi" rows="4"
        class="w-full mt-1 border-gray-300 rounded-md">{{ old('deskripsi', $event->deskripsi ?? '') }}</textarea>
    <x-input-error :messages="$errors->get('deskripsi')" class="mt-1" />
</div>

<!-- Lokasi -->
<div>
    <x-input-label for="lokasi" :value="__('Lokasi')" />
    <x-text-input id="lokasi" type="text" name="lokasi"
        value="{{ old('lokasi', $event->lokasi ?? '') }}"
        class="w-full mt-1" />
    <x-input-error :messages="$errors->get('lokasi')" class="mt-1" />
</div>

<!-- Tanggal Mulai -->
<div>
    <x-input-label for="tanggal_mulai" :value="__('Tanggal Mulai')" />
    <x-text-input id="tanggal_mulai" type="datetime-local" name="tanggal_mulai"
        value="{{ old('tanggal_mulai', isset($event->tanggal_mulai) ? $event->tanggal_mulai->format('Y-m-d\TH:i') : '') }}"
        class="w-full mt-1" required />
    <x-input-error :messages="$errors->get('tanggal_mulai')" class="mt-1" />
</div>

<!-- Tanggal Selesai -->
<div>
    <x-input-label for="tanggal_selesai" :value="__('Tanggal Selesai')" />
    <x-text-input id="tanggal_selesai" type="datetime-local" name="tanggal_selesai"
        value="{{ old('tanggal_selesai', isset($event->tanggal_selesai) ? $event->tanggal_selesai->format('Y-m-d\TH:i') : '') }}"
        class="w-full mt-1" />
    <x-input-error :messages="$errors->get('tanggal_selesai')" class="mt-1" />
</div>

<!-- Biaya -->
<div>
    <x-input-label for="biaya" :value="__('Biaya')" />
    <x-text-input id="biaya" type="number" step="0.01" name="biaya"
        value="{{ old('biaya', $event->biaya ?? 0) }}"
        class="w-full mt-1" />
    <x-input-error :messages="$errors->get('biaya')" class="mt-1" />
    <p class="text-sm text-gray-500 mt-1">Isi 0 untuk event gratis</p>
</div>

<!-- Tombol -->
<div class="flex gap-2 justify-end">
    <a href="{{ route('event.index') }}"
       class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">Batal</a>
    <button type="submit"
       class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Simpan</button>
</div>
