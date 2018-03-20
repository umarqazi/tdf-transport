<?php

namespace LaravelAcl\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $custom_url = null)
    {
        $redirect_url = $custom_url ?: '/';
        if (Auth::user()->type != 'Admin') {
            return $next($request);     
        }
        return redirect($redirect_url);
    }
}
