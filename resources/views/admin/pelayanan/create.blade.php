<x-app-layout>
    <x-slot name="title">Tambah Pelayanan</x-slot>

    <div class="max-w-4xl mx-auto bg-white shadow rounded-lg p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Tambah Pelayanan Baru</h2>

        <form method="POST" action="{{ route('pelayanan.store') }}" class="space-y-4">
            @include('admin.pelayanan._form')
        </form>
    </div>
</x-app-layout>
