<?php

namespace App\Http\Controllers;

use App\Http\Requests\verifications\EmailPasswordRequest;
use App\Http\Requests\verifications\PasswordResetRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use Illuminate\Support\Str;


class ForgotPasswordController extends Controller
{
    public function email(): View 
    {
        return view('auth.verifyPassword.email-confirm');
    }

    public function send(EmailPasswordRequest $request): RedirectResponse
    {
        $request->validated();

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? redirect(route('recover.password.message'))
            : back()->withErrors(['email' => __($status)]);
    }

    public function message(): View 
    {
        return view('auth.verify');
    }
    public function password(string $token, Request $request): View
    {
        return view('auth.verifyPassword.recover-password', ['token' => $token, 'email' => $request->get('email')]);
    }
    public function reset(PasswordResetRequest $request): RedirectResponse
    {
        $request->validated();

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => $password
                ])->setRememberToken(Str::random(60));
     
                $user->save();
     
                event(new PasswordReset($user));
            }
        );

        return $status == Password::PASSWORD_RESET
            ? redirect(route('recover.verified'))
            : back()->withErrors(['password' => [__($status)]]);
    }
}
