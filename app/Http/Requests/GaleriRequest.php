<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GaleriRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:5240',
        ];
    }

    public function messages(): array
    {
        return [
            'judul.required' => 'Judul galeri wajib diisi.',
            'image.required' => 'Gambar wajib diupload.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar hanya jpg, jpeg, png, atau webp.',
            'image.max' => 'Ukuran gambar maksimal 5MB.',
        ];
    }
}
