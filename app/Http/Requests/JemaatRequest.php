<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JemaatRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string|max:500',
            'no_hp' => 'nullable|string|max:13',
            'status_pernikahan' => 'nullable|in:Lajang,Menikah,Duda/Janda',
            'pekerjaan' => 'nullable|string|max:255',
            'aktif' => 'boolean',
            'foto_id' => 'nullable|exists:files,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama lengkap wajib diisi.',
            'name.string' => 'Nama lengkap harus berupa teks.',
            'name.max' => 'Nama lengkap maksimal 255 karakter.',

            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in' => 'Jenis kelamin harus L (Laki-laki) atau P (Perempuan).',

            'tanggal_lahir.date' => 'Tanggal lahir harus berupa tanggal yang valid.',

            'alamat.string' => 'Alamat harus berupa teks.',
            'alamat.max' => 'Alamat maksimal 500 karakter.',

            'no_hp.string' => 'Nomor HP harus berupa teks.',
            'no_hp.max' => 'Nomor HP maksimal 13 karakter.',

            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',

            'status_pernikahan.in' => 'Status pernikahan hanya boleh: Lajang, Menikah, atau Duda/Janda.',

            'pekerjaan.string' => 'Pekerjaan harus berupa teks.',
            'pekerjaan.max' => 'Pekerjaan maksimal 255 karakter.',

            'aktif.boolean' => 'Status aktif harus berupa true/false.',

            'foto_id.exists' => 'Foto tidak valid atau tidak ditemukan.',
        ];
    }
}
