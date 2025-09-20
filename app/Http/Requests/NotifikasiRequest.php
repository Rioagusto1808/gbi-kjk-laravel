<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotifikasiRequest extends FormRequest
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
            'judul' => 'required|string|max:255',
            'pesan' => 'required|string',
            'tipe' => 'required|in:Umum,Event,Ibadah,Keuangan',
            'target' => 'nullable|array',
            'target.*' => 'string',
            'dikirim_pada' => 'nullable|date',
        ];
    }
}
