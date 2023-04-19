<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class SessionsController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginUserRequest $request): RedirectResponse
    {
        $attributes = $request->only('password');
        $usernameOrEmail = $request->input('username_or_email');
    
        if (filter_var($usernameOrEmail, FILTER_VALIDATE_EMAIL)) {
            $attributes['email'] = $usernameOrEmail;
        } else {
            $attributes['name'] = $usernameOrEmail;
        }

        $rememberToken = $request->has('remember_token') ? true : false;

        if (!Auth::attempt($attributes, $rememberToken)) {
            throw ValidationException::withMessages([
                'username_or_email' => 'username or email not found',
                'password' => 'password does not match'
            ]);
        }

        session()->regenerate();

        return redirect('/dashboard');
    }

    public function destroy(): RedirectResponse
    {
        auth()->logout();

        return redirect(route('login.create'));
    }
}
