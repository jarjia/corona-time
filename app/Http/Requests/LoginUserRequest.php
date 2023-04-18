<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'username_or_email' => ['required', function ($attribute, $value, $fail) {
                $user = User::where('name', $value)->orWhere('email', $value)->first();

                if (!$user) {
                    return $fail('User with that username or email does not exist');
                }
            },],
			'password' => 'required',
        ];
    }
}
