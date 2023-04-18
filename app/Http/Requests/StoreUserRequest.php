<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'min:3', 'unique:users,name'],
            'email' => ['required', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:3'],
        ];
    }
}
