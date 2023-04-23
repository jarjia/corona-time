<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class Language
{
	/**
	 * Handle an incoming request.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param \Closure                 $next
	 *
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if (session('my_locale') === null)
		{
			dd(session('my_locale'));
			App::setLocale(config('app.locale'));
		}
		elseif (session('my_locale') !== null)
		{
			App::setLocale(session('my_locale'));
		}

		return $next($request);
	}
}