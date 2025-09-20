<x-app-layout>
    <x-slot name="title">Tambah Ibadah</x-slot>

    <div class="max-w-4xl mx-auto bg-white shadow rounded-lg p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Tambah Data Ibadah</h2>

        <form method="POST" action="{{ route('ibadah.store') }}" class="space-y-4">
            @include('admin.ibadah._form')
        </form>
    </div>
</x-app-layout>
