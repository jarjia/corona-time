<?php

namespace App\Http\Requests\verifications;

use Illuminate\Foundation\Http\FormRequest;

class EmailPasswordRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email'
        ];
    }
}
