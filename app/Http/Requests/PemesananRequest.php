<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PemesananRequest extends FormRequest
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
            'pengguna_id' => ['required'],
            'tgl_pemesanan' => ['required', 'date'],
            'plat_nomor' => ['required'],
            'merek' => ['required'],
            'ket_pemesanan' => ['nullable'],
        ];
    }
}
