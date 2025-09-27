<x-app-layout>
    <x-slot name="title">Edit Foto Galeri</x-slot>

    <div class="max-w-4xl mx-auto bg-white shadow rounded-lg p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Edit Foto Galeri</h2>

        <form method="POST" action="{{ route('galeri.update', $galeri->id) }}" enctype="multipart/form-data"
            class="space-y-4">
            @include('admin.galeri._form', ['galeri' => $galeri])
        </form>
    </div>
</x-app-layout>
