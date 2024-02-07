<?php

namespace App\Http\Middleware;

use App\Traits\HelpersTrait;
use Closure;
use Illuminate\Http\Request;

class CheckLanguageApi
{
    use HelpersTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $languages = $this->getLocales();

        app()->setLocale('ar');

        if ($request->header('lang') && in_array($request->header('lang'), $languages)) {
            app()->setLocale($request->header('lang'));
        }

        return $next($request);
    }
}
