<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IbadahRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'jenis' => 'required|in:Umum,Sekolah Minggu,Youth,Doa,Lainnya',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'lokasi' => 'nullable|string|max:255',
            'tema' => 'nullable|string|max:255',
            'ayat' => 'nullable|string|max:255',
            'gembala' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'status' => 'required|in:Akan Datang,Sedang Berlangsung,Selesai',
        ];
    }

    public function messages(): array
    {
        return [
            'jenis.required' => 'Jenis ibadah wajib dipilih.',
            'jenis.in' => 'Jenis ibadah tidak valid.',

            'tanggal_mulai.required' => 'Tanggal mulai ibadah wajib diisi.',
            'tanggal_mulai.date' => 'Tanggal mulai harus berupa format tanggal yang benar.',

            'tanggal_selesai.date' => 'Tanggal selesai harus berupa format tanggal yang benar.',
            'tanggal_selesai.after_or_equal' => 'Tanggal selesai tidak boleh sebelum tanggal mulai.',

            'lokasi.string' => 'Lokasi harus berupa teks.',
            'lokasi.max' => 'Lokasi maksimal 255 karakter.',

            'tema.string' => 'Tema harus berupa teks.',
            'tema.max' => 'Tema maksimal 255 karakter.',

            'ayat.string' => 'Ayat harus berupa teks.',
            'ayat.max' => 'Ayat maksimal 255 karakter.',

            'gembala.string' => 'Nama gembala harus berupa teks.',
            'gembala.max' => 'Nama gembala maksimal 255 karakter.',

            'deskripsi.string' => 'Deskripsi harus berupa teks.',

            'status.required' => 'Status ibadah wajib dipilih.',
            'status.in' => 'Status ibadah tidak valid.',
        ];
    }
}
