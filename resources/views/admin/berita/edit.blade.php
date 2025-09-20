<x-app-layout>
    <x-slot name="title">Edit Berita</x-slot>
    <div class="max-w-4xl mx-auto bg-white shadow rounded-lg p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Edit Berita</h2>
        <form method="POST" action="{{ route('berita.update', $berita->id) }}" enctype="multipart/form-data" class="space-y-4">
            @include('admin.berita._form-edit', ['berita' => $berita])
        </form>
    </div>
</x-app-layout>
