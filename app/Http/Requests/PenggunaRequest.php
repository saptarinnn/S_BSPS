<?php

namespace App\Http\Requests;

use App\Models\Pengguna;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class PenggunaRequest extends FormRequest
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
            'nama' => ['required'],
            'no_hp' => ['required', Rule::unique(Pengguna::class)->ignore($this->pengguna?->id)],
            'username' => ['required', Rule::unique(Pengguna::class)->ignore($this->pengguna?->id)],
            'password' => ['required', Password::min(8)],
            'login_terakhir' => ['nullable'],
            'aktif' => ['required', 'in:1,0'],
        ];
    }
}
