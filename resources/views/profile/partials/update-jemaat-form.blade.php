<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">Biodata Jemaat</h2>
        <p class="mt-1 text-sm text-gray-600 mb-4">Update data pribadi jemaat di sini.</p>
    </header>
    <div class="flex flex-col md:items-start items-center">
        <div class="relative w-24 h-24 rounded-full border border-gray-300 shadow">
            {{-- Foto --}}
            <img id="previewFoto"
                src="{{ $user->jemaat && $user->jemaat->foto
                    ? asset('storage/' . $user->jemaat->foto->path)
                    : asset('images/default_profile.jpg') }}"
                alt="Foto Profil" class="w-full h-full object-cover rounded-full">

            {{-- Tombol hapus --}}
            @if ($user->jemaat && $user->jemaat->foto)
                <form id="delete-form-photo" action="{{ route('profile.removePhoto') }}" method="POST" class="hidden">
                    @csrf
                    @method('DELETE')
                </form>

                <button type="button" onclick="confirmDelete('photo', 'Hapus Foto?', 'Foto akan dihapus permanen.')"
                    class="bg-red-600 hover:bg-red-700 text-white rounded-full p-1 shadow absolute bottom-1 right-2 translate-x-1/4 translate-y-1/4 ">
                    <x-heroicon-s-trash class="w-5 h-5" />
                </button>
            @endif
        </div>
    </div>

    {{-- FORM UPDATE JEMAAT --}}
    <form method="POST" action="{{ route('profile.update.jemaat') }}" enctype="multipart/form-data"
        class="mt-6 space-y-6">
        @csrf
        @method('PATCH')

        {{-- Foto Profil --}}
        <div class="flex flex-col md:items-start items-center">

            {{-- Hidden input untuk kirim hasil crop --}}
            <input type="hidden" name="foto" id="fotoBase64">

            <div class="flex gap-3 md:ml-6 mt-[-20px]">
                <label for="foto"
                    class="cursor-pointer px-3 py-1 text-blue-600 text-sm rounded hover:text-blue-700">
                    Edit
                </label>
                <input id="foto" type="file" class="hidden" accept="image/*">
            </div>
        </div>

        {{-- Modal Croppie --}}
        <div id="cropModal" class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50">
            <div class="bg-white p-4 rounded-lg shadow-lg w-[90%] max-w-lg">
                <h3 class="font-semibold mb-2">Crop Foto</h3>
                <div id="croppieContainer"></div>
                <div class="mt-4 flex justify-end gap-2">
                    <button type="button" id="cancelCrop" class="px-3 py-1 bg-gray-300 rounded">Batal</button>
                    <button type="button" id="applyCrop" class="px-3 py-1 bg-blue-600 text-white rounded">Oke</button>
                </div>
            </div>
        </div>

        {{-- Nama Lengkap --}}
        <div class="mb-2">
            <x-input-label for="jemaat_name" :value="__('Nama Lengkap')" />
            <x-text-input id="jemaat_name" name="jemaat_name" type="text" class="mt-1 block w-full" :value="old('jemaat_name', $user->jemaat->name ?? '')"
                required />
            <x-input-error class="mt-2" :messages="$errors->get('jemaat_name')" />
        </div>

        {{-- No HP --}}
        <div class="mb-2">
            <x-input-label for="no_hp" :value="__('No HP')" />
            <x-text-input id="no_hp" name="no_hp" type="text" class="mt-1 block w-full" :value="old('no_hp', $user->jemaat->no_hp ?? '')" />
            <x-input-error class="mt-2" :messages="$errors->get('no_hp')" />
        </div>

        {{-- Jenis Kelamin --}}
        <div class="mb-2">
            <x-input-label for="jenis_kelamin" :value="__('Jenis Kelamin')" />
            <select name="jenis_kelamin" id="jenis_kelamin"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <option value="">Pilih</option>
                <option value="L"
                    {{ old('jenis_kelamin', $user->jemaat->jenis_kelamin ?? '') === 'L' ? 'selected' : '' }}>Laki-laki
                </option>
                <option value="P"
                    {{ old('jenis_kelamin', $user->jemaat->jenis_kelamin ?? '') === 'P' ? 'selected' : '' }}>Perempuan
                </option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('jenis_kelamin')" />
        </div>

        {{-- Tanggal Lahir --}}
        <div class="mb-2">
            <x-input-label for="tanggal_lahir" :value="__('Tanggal Lahir')" />
            <x-text-input id="tanggal_lahir" name="tanggal_lahir" type="date" class="mt-1 block w-full"
                :value="old('tanggal_lahir', $user->jemaat->tanggal_lahir ?? '')" />
            <x-input-error class="mt-2" :messages="$errors->get('tanggal_lahir')" />
        </div>

        {{-- Alamat --}}
        <div class="mb-2">
            <x-input-label for="alamat" :value="__('Alamat')" />
            <textarea id="alamat" name="alamat" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('alamat', $user->jemaat->alamat ?? '') }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('alamat')" />
        </div>

        {{-- Status Pernikahan --}}
        <div class="mb-2">
            <x-input-label for="status_pernikahan" :value="__('Status Pernikahan')" />
            <select name="status_pernikahan" id="status_pernikahan"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <option value="">Pilih</option>
                <option value="Lajang"
                    {{ old('status_pernikahan', $user->jemaat->status_pernikahan ?? '') === 'Lajang' ? 'selected' : '' }}>
                    Lajang</option>
                <option value="Menikah"
                    {{ old('status_pernikahan', $user->jemaat->status_pernikahan ?? '') === 'Menikah' ? 'selected' : '' }}>
                    Menikah</option>
                <option value="Duda/Janda"
                    {{ old('status_pernikahan', $user->jemaat->status_pernikahan ?? '') === 'Duda/Janda' ? 'selected' : '' }}>
                    Duda/Janda</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('status_pernikahan')" />
        </div>

        {{-- Pekerjaan --}}
        <div class="mb-4">
            <x-input-label for="pekerjaan" :value="__('Pekerjaan')" />
            <x-text-input id="pekerjaan" name="pekerjaan" type="text" class="mt-1 block w-full" :value="old('pekerjaan', $user->jemaat->pekerjaan ?? '')" />
            <x-input-error class="mt-2" :messages="$errors->get('pekerjaan')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button type="submit">Simpan</x-primary-button>
        </div>
    </form>
</section>

@push('scripts')
    <link rel="stylesheet" href="https://unpkg.com/croppie/croppie.css" />
    <script src="https://unpkg.com/croppie/croppie.min.js"></script>

    <script>
        let croppieInstance;

        const inputFoto = document.getElementById('foto');
        const previewFoto = document.getElementById('previewFoto');
        const cropModal = document.getElementById('cropModal');
        const croppieContainer = document.getElementById('croppieContainer');
        const cancelCrop = document.getElementById('cancelCrop');
        const applyCrop = document.getElementById('applyCrop');
        const fotoBase64 = document.getElementById('fotoBase64');

        // Saat pilih foto
        inputFoto.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function(event) {
                cropModal.classList.remove('hidden');
                cropModal.classList.add('flex');

                if (croppieInstance) croppieInstance.destroy();

                croppieInstance = new Croppie(croppieContainer, {
                    viewport: {
                        width: 200,
                        height: 200,
                        type: 'circle'
                    },
                    boundary: {
                        width: 300,
                        height: 300
                    },
                    enableZoom: true
                });

                croppieInstance.bind({
                    url: event.target.result
                });
            };
            reader.readAsDataURL(file);
        });

        // Batal
        cancelCrop.addEventListener('click', () => {
            if (croppieInstance) croppieInstance.destroy();
            cropModal.classList.add('hidden');
            cropModal.classList.remove('flex');
            inputFoto.value = "";
        });

        // Oke / Apply
        applyCrop.addEventListener('click', () => {
            croppieInstance.result({
                type: 'base64',
                size: {
                    width: 400,
                    height: 400
                },
                format: 'png'
            }).then((base64) => {
                // tampilkan preview
                previewFoto.src = base64;

                // simpan ke hidden input (PAKAI PREFIX)
                fotoBase64.value = base64;

                // tutup modal
                cropModal.classList.add('hidden');
                cropModal.classList.remove('flex');

                croppieInstance.destroy();
            });
        });
    </script>
@endpush
