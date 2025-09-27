@props(['route', 'id', 'title' => 'Yakin hapus data ini?', 'text' => 'Data yang dihapus tidak bisa dikembalikan.'])

<form id="delete-form-{{ $id }}" action="{{ $route }}" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>

<button type="button" onclick="confirmDelete('{{ $id }}', '{{ $title }}', '{{ $text }}')"
    {{ $attributes->merge(['class' => 'text-red-600 hover:text-red-900 font-medium']) }}>
    Hapus
</button>
