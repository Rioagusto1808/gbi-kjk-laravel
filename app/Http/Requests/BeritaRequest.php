<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BeritaRequest extends FormRequest
{
    /**
     * Semua user yang login boleh request ini.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Rules sesuai schema database.
     */
    public function rules(): array
    {
        return [
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'author_id' => 'nullable|exists:users,id',
            'published_at' => 'nullable|date',
            'foto.*' => 'nullable|image|mimes:jpg,jpeg,png|max:5240',
        ];
    }

    /**
     * Custom error messages.
     */
    public function messages(): array
    {
        return [
            'judul.required' => 'Judul berita wajib diisi.',
            'judul.string' => 'Judul berita harus berupa teks.',
            'judul.max' => 'Judul berita maksimal 255 karakter.',

            'isi.required' => 'Isi berita wajib diisi.',
            'isi.string' => 'Isi berita harus berupa teks.',

            'author_id.exists' => 'Author tidak ditemukan pada data pengguna.',

            'published_at.date' => 'Tanggal publish harus berupa format tanggal yang valid.',

            'foto.*.image' => 'File harus berupa gambar.',
            'foto.*.mimes' => 'Foto hanya boleh berformat JPG, JPEG, atau PNG.',
            'foto.*.max' => 'Ukuran foto maksimal 5MB.',
        ];
    }
}
