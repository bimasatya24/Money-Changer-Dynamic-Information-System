<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->routeIs('home')) {
            $locale = Session::get('locale', config('app.locale', 'id'));
            App::setLocale(in_array($locale, ['id', 'en']) ? $locale : 'id');
        } else {
            App::setLocale('id');
        }

        return $next($request);
    }
}
