<x-app-layout>
    <x-slot name="title">Edit Renungan</x-slot>

    <div class="max-w-4xl mx-auto bg-white shadow rounded-lg p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Edit Renungan</h2>

        <form method="POST" action="{{ route('renungan.update', $renungan) }}" class="space-y-4">
            @method('PUT')
            @include('admin.renungan._form', ['renungan' => $renungan])
        </form>
    </div>
</x-app-layout>
