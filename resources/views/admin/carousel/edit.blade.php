<x-app-layout>
    <x-slot name="title">Edit Carousel</x-slot>

    <div class="max-w-4xl mx-auto bg-white shadow rounded-lg p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Edit Carousel</h2>
        <form method="POST" action="{{ route('carousel.update', $carousel->id) }}" enctype="multipart/form-data"
            class="space-y-4">
            @include('admin.carousel._form')
        </form>
    </div>
</x-app-layout>
