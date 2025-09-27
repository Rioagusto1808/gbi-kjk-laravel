<x-app-layout>
    <x-slot name="title">Edit Jemaat</x-slot>

    <div class="max-w-4xl mx-auto bg-white shadow rounded-lg p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Edit Data Jemaat</h2>

        <form method="POST" action="{{ route('jemaat.update', $jemaat) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Nama -->
            <div>
                <x-input-label for="name" :value="__('Nama Lengkap')" />
                <x-text-input id="name" type="text" name="name" value="{{ old('name', $jemaat->name) }}"
                    class="w-full mt-1" required />
                <x-input-error :messages="$errors->get('name')" class="mt-1" />
            </div>

            <!-- Jenis Kelamin -->
            <div>
                <x-input-label for="jenis_kelamin" :value="__('Jenis Kelamin')" />
                <select name="jenis_kelamin" id="jenis_kelamin" class="w-full mt-1 border-gray-300 rounded-md">
                    <option value="">Pilih</option>
                    <option value="L" {{ old('jenis_kelamin', $jemaat->jenis_kelamin) === 'L' ? 'selected' : '' }}>
                        Laki-laki</option>
                    <option value="P" {{ old('jenis_kelamin', $jemaat->jenis_kelamin) === 'P' ? 'selected' : '' }}>
                        Perempuan</option>
                </select>
                <x-input-error :messages="$errors->get('jenis_kelamin')" class="mt-1" />
            </div>

            <!-- Tanggal Lahir -->
            <div>
                <x-input-label for="tanggal_lahir" :value="__('Tanggal Lahir')" />
                <x-text-input id="tanggal_lahir" type="date" name="tanggal_lahir"
                    value="{{ old('tanggal_lahir', $jemaat->tanggal_lahir) }}" class="w-full mt-1" />
                <x-input-error :messages="$errors->get('tanggal_lahir')" class="mt-1" />
            </div>

            <!-- Alamat -->
            <div>
                <x-input-label for="alamat" :value="__('Alamat')" />
                <textarea id="alamat" name="alamat" rows="3" class="w-full mt-1 border-gray-300 rounded-md">{{ old('alamat', $jemaat->alamat) }}</textarea>
                <x-input-error :messages="$errors->get('alamat')" class="mt-1" />
            </div>

            <!-- No HP -->
            <div>
                <x-input-label for="no_hp" :value="__('No HP')" />
                <x-text-input id="no_hp" type="text" name="no_hp" value="{{ old('no_hp', $jemaat->no_hp) }}"
                    class="w-full mt-1" />
                <x-input-error :messages="$errors->get('no_hp')" class="mt-1" />
            </div>

            <!-- Status Pernikahan -->
            <div>
                <x-input-label for="status_pernikahan" :value="__('Status Pernikahan')" />
                <select name="status_pernikahan" id="status_pernikahan" class="w-full mt-1 border-gray-300 rounded-md">
                    <option value="">Pilih</option>
                    <option value="Lajang"
                        {{ old('status_pernikahan', $jemaat->status_pernikahan) === 'Lajang' ? 'selected' : '' }}>Lajang
                    </option>
                    <option value="Menikah"
                        {{ old('status_pernikahan', $jemaat->status_pernikahan) === 'Menikah' ? 'selected' : '' }}>
                        Menikah</option>
                    <option value="Duda/Janda"
                        {{ old('status_pernikahan', $jemaat->status_pernikahan) === 'Duda/Janda' ? 'selected' : '' }}>
                        Duda/Janda</option>
                </select>
                <x-input-error :messages="$errors->get('status_pernikahan')" class="mt-1" />
            </div>

            <!-- Pekerjaan -->
            <div>
                <x-input-label for="pekerjaan" :value="__('Pekerjaan')" />
                <x-text-input id="pekerjaan" type="text" name="pekerjaan"
                    value="{{ old('pekerjaan', $jemaat->pekerjaan) }}" class="w-full mt-1" />
                <x-input-error :messages="$errors->get('pekerjaan')" class="mt-1" />
            </div>

            <!-- Status Aktif -->
            <div>
                <x-input-label for="aktif" :value="__('Status')" />
                <select name="aktif" id="aktif" class="w-full mt-1 border-gray-300 rounded-md">
                    <option value="1" {{ old('aktif', $jemaat->aktif) == 1 ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ old('aktif', $jemaat->aktif) == 0 ? 'selected' : '' }}>Nonaktif</option>
                </select>
                <x-input-error :messages="$errors->get('aktif')" class="mt-1" />
            </div>

            <!-- Tombol -->
            <div class="flex gap-2 justify-end">
                <a href="{{ route('jemaat.index') }}"
                    class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
                    Batal
                </a>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
