<x-app-layout>
    <x-slot name="title">Edit Ibadah</x-slot>

    <div class="max-w-4xl mx-auto bg-white shadow rounded-lg p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Edit Data Ibadah</h2>

        <form method="POST" action="{{ route('ibadah.update', $ibadah) }}" class="space-y-4">
            @method('PUT')
            @include('admin.ibadah._form', ['ibadah' => $ibadah])
        </form>
    </div>
</x-app-layout>
