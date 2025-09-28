<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarouselRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $imageRequired = $this->isMethod('post') ? 'required' : 'nullable';

        return [
            'judul' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'urutan' => [
                'required',
                'integer',
                'min:1',
                'max:10000',
                // unique tapi saat update abaikan id sendiri
                'unique:carousels,urutan,'.($this->carousel->id ?? 'null'),
            ],
            'aktif' => 'required|boolean',
            'image' => [$imageRequired, 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ];
    }

    public function messages(): array
    {
        return [
            'urutan.required' => 'Urutan wajib diisi.',
            'urutan.integer' => 'Urutan harus berupa angka.',
            'urutan.min' => 'Urutan minimal 1.',
            'aktif.required' => 'Status wajib dipilih.',
            'aktif.boolean' => 'Status tidak valid.',
            'image.required' => 'Gambar carousel wajib diupload.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar hanya jpg, jpeg, png, atau webp.',
            'image.max' => 'Ukuran gambar maksimal 5MB.',
        ];
    }
}
