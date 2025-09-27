<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'jemaat_name' => ['required', 'string', 'max:255'],
            'no_hp' => ['nullable', 'regex:/^[0-9]+$/', 'max:13'],
            'jenis_kelamin' => ['nullable', 'in:L,P'],
            'tanggal_lahir' => ['nullable', 'date'],
            'status_pernikahan' => ['nullable', 'in:Lajang,Menikah,Duda/Janda'],
            'pekerjaan' => ['nullable', 'string', 'max:255'],
            'foto' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'jemaat_name.required' => 'Nama lengkap jemaat wajib diisi',
            'no_hp.regex' => 'Nomor HP hanya boleh berisi angka',
            'no_hp.max' => 'Nomor HP maksimal 13 karakter',
            'foto.image' => 'File foto harus berupa gambar',
            'foto.mimes' => 'Format foto hanya boleh JPG atau PNG',
        ];
    }
}
