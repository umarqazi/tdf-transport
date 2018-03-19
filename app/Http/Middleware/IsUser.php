<?php

namespace LaravelAcl\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Support\Facades\App;

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
        $authentication_helper = App::make('authentication_helper');
        if ($authentication_helper->LoginUser()->type != 'Admin') {
            return $next($request);     
        }
        return redirect($redirect_url);
    }
}
