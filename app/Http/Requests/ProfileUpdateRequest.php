<?php

namespace App\Http\Requests;

use App\Models\Pengguna;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'nama' => ['required'],
            'no_hp' => ['required', 'numeric', Rule::unique(Pengguna::class)->ignore(auth()->user()->id)],
            'username' => ['required', Rule::unique(Pengguna::class)->ignore(auth()->user()->id)],
        ];
    }
}
