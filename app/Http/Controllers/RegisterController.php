<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class RegisterController extends Controller
{
    public function store(StoreUserRequest $request): RedirectResponse
    {
        $attributes = $request->validated();

        $user = User::create($attributes);

        auth()->login($user);

        event(new Registered($user));

        return redirect(route('verification.notice'));
    }

    public function verifying(): View
    {
        return view('auth.verify');
    }

    public function verify(EmailVerificationRequest $request): RedirectResponse
    {
        $request->fulfill();
     
        return redirect(route('email.verified'));
    }
}
