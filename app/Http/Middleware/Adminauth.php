<?php

namespace App\Http\Middleware;

use Closure;

class Adminauth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$guard = null) //this middleware redirect to login route if not authenticated
    {
        if(!auth()->guard($guard)->check())
        {
            return redirect(route('admin.login'))->withErrors(['You do not have permission to access!!']);
        }
        return $next($request);
    }
}
