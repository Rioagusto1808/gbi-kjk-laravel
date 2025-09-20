<x-app-layout>
    <x-slot name="title">Edit Pelayanan</x-slot>

    <div class="max-w-4xl mx-auto bg-white shadow rounded-lg p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Edit Pelayanan</h2>

        <form method="POST" action="{{ route('pelayanan.update', $pelayanan) }}" class="space-y-4">
            @method('PUT')
            @include('admin.pelayanan._form', ['pelayanan' => $pelayanan])
        </form>
    </div>
</x-app-layout>
