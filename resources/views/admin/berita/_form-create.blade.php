@csrf

<!-- Judul -->
<div>
    <x-input-label for="judul" :value="__('Judul Berita')" />
    <x-text-input id="judul" type="text" name="judul"
        value="{{ is_string(old('judul')) ? old('judul') : $berita->judul ?? '' }}" class="w-full mt-1" required />
    <x-input-error :messages="$errors->get('judul')" class="mt-1" />
</div>

<!-- Isi -->
<div>
    <x-input-label for="isi" :value="__('Isi Berita')" />
    <textarea id="isi" name="isi" rows="5" class="w-full mt-1 border-gray-300 rounded-md">{{ is_string(old('isi')) ? old('isi') : $berita->isi ?? '' }}</textarea>
    <x-input-error :messages="$errors->get('isi')" class="mt-1" />
</div>

<!-- Published At -->
<div>
    <x-input-label for="published_at" :value="__('Tanggal Publikasi')" />
    <x-text-input id="published_at" type="datetime-local" name="published_at"
        value="{{ is_string(old('published_at')) ? old('published_at') : (isset($berita->published_at) ? $berita->published_at->format('Y-m-d\TH:i') : '') }}"
        class="w-full mt-1" />
    <x-input-error :messages="$errors->get('published_at')" class="mt-1" />
</div>

<!-- Upload Foto -->
<div>
    <x-input-label for="foto" :value="__('Foto Berita')" />
    <input type="file" id="foto" name="foto[]" multiple class="w-full mt-1 border-gray-300 rounded-md" />
    <x-input-error :messages="collect($errors->get('foto.*'))->flatten()" class="mt-1" />
    <p class="text-sm text-gray-500 mt-1">Bisa pilih lebih dari satu foto.</p>
    <div class="mt-3 grid grid-cols-2 md:grid-cols-3 gap-3 preview-container"></div>
    @if (isset($berita) && $berita->files->count())
        <div class="mt-3 grid grid-cols-2 md:grid-cols-3 gap-3">
            @foreach ($berita->files as $file)
                <div class="relative">
                    <img src="{{ asset('storage/' . $file->path) }}" alt="{{ $file->nama_asli }}"
                        class="w-full h-32 object-cover rounded shadow" />
                    <p class="text-xs text-center mt-1 text-gray-600 truncate">
                        {{ $file->nama_asli }}
                    </p>
                </div>
            @endforeach
        </div>
    @endif
</div>

<!-- Tombol -->
<div class="flex gap-2 justify-end">
    <a href="{{ route('berita.index') }}"
        class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">Batal</a>
    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Simpan</button>
</div>
@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const fileInputs = document.querySelectorAll('input[type="file"][name="foto[]"]');

            fileInputs.forEach(input => {
                input.addEventListener("change", function(e) {
                    const previewContainer = input.closest('div').querySelector(
                        ".preview-container");
                    if (!previewContainer) return;

                    previewContainer.innerHTML = ""; // clear preview lama

                    Array.from(e.target.files).forEach(file => {
                        if (!file.type.startsWith("image/")) return;

                        const reader = new FileReader();
                        reader.onload = function(event) {
                            const img = document.createElement("img");
                            img.src = event.target.result;
                            img.classList.add("w-full", "h-32", "object-cover",
                                "rounded", "shadow");
                            previewContainer.appendChild(img);
                        };
                        reader.readAsDataURL(file);
                    });
                });
            });
        });
    </script>
@endpush
