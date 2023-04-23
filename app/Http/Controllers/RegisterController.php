<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\verifications\EmailVerifyRequest;
use App\Mail\VerificationEmail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class RegisterController extends Controller
{
    public function create(): View
    {
        return view('auth.signup');
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        $attributes = $request->validated();

        $to_name = $attributes['name'];
        $to_email = $attributes['email'];

        $user = User::create($attributes);

        auth()->login($user);

        Mail::to($to_email, $to_name)->send(new VerificationEmail());

        return redirect(route('verification.notice'));
    }

    public function verifying(): View
    {
        return view('auth.verify');
    }

    public function verify(EmailVerifyRequest $request): RedirectResponse
    {
        $request->validated();

        $user = User::findOrFail($request->user);

        if($request->user != $user->id) {
            abort(401);
        }else if ($request->expires < time()) {
            abort(401);
        }

        $user->email_verified_at = now();
        $user->save();

        return redirect(route('email.verified', ['message' => 'Your account is confirmed, you can sign in']));
    }
}
