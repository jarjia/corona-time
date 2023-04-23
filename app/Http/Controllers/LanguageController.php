<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
	public function setLocale(string $locale): RedirectResponse
	{
		session(['my_locale' => $locale]);

		session()->put('my_locale', session('my_locale'));

		App::setLocale($locale);

		return back();
	}
}