<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RenunganRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'judul' => 'required|string|max:255',
            'ayat' => 'nullable|string|max:255',
            'isi' => 'required|string',
            'doa' => 'nullable|string',
            'penulis' => 'nullable|string|max:255',
            'status' => 'required|in:draft,publish',
        ];
    }

    public function messages(): array
    {
        return [
            'judul.required' => 'Judul renungan wajib diisi.',
            'judul.string' => 'Judul renungan harus berupa teks.',
            'judul.max' => 'Judul maksimal 255 karakter.',

            'ayat.string' => 'Ayat harus berupa teks.',
            'ayat.max' => 'Ayat maksimal 255 karakter.',

            'isi.required' => 'Isi renungan wajib diisi.',
            'isi.string' => 'Isi renungan harus berupa teks.',

            'doa.string' => 'Doa harus berupa teks.',

            'penulis.string' => 'Nama penulis harus berupa teks.',
            'penulis.max' => 'Nama penulis maksimal 255 karakter.',

            'status.required' => 'Status renungan wajib dipilih.',
            'status.in' => 'Status renungan tidak valid.',
        ];
    }
}
