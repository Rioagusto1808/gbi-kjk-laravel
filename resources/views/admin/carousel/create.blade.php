<x-app-layout>
    <x-slot name="title">Tambah Carousel</x-slot>

    <div class="max-w-4xl mx-auto bg-white shadow rounded-lg p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Tambah Carousel</h2>
        <form method="POST" action="{{ route('carousel.store') }}" enctype="multipart/form-data" class="space-y-4">
            @include('admin.carousel._form')
        </form>
    </div>
</x-app-layout>
