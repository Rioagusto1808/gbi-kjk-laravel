<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_event' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:5240',
            'deskripsi' => 'nullable|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'lokasi' => 'nullable|string|max:255',
            'tema' => 'nullable|string|max:255',
            'biaya' => 'nullable|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'nama_event.required' => 'Nama event wajib diisi.',
            'nama_event.string' => 'Nama event harus berupa teks.',
            'nama_event.max' => 'Nama event maksimal 255 karakter.',

            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar hanya boleh JPG, JPEG, atau PNG.',
            'image.max' => 'Ukuran gambar maksimal 5MB.',

            'tanggal_mulai.required' => 'Tanggal mulai wajib diisi.',
            'tanggal_mulai.date' => 'Tanggal mulai harus berupa tanggal yang valid.',

            'tanggal_selesai.date' => 'Tanggal selesai harus berupa tanggal yang valid.',
            'tanggal_selesai.after_or_equal' => 'Tanggal selesai tidak boleh sebelum tanggal mulai.',

            'biaya.numeric' => 'Biaya harus berupa angka.',
            'biaya.min' => 'Biaya minimal 0.',
        ];
    }
}
