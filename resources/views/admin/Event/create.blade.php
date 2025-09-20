<x-app-layout>
    <x-slot name="title">Tambah Event</x-slot>

    <div class="max-w-4xl mx-auto bg-white shadow rounded-lg p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Tambah Event</h2>

        <form method="POST" action="{{ route('event.store') }}" class="space-y-4">
            @csrf
            @include('admin.event._form')
        </form>
    </div>
</x-app-layout>
