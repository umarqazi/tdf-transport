<?php

namespace LaravelAcl\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Config;
class TdfManager
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
      $getUser=Auth::user();
      if($getUser){
        if (Auth::user()->type == Config::get('constants.Users.Driver')) {
            return $next($request);
        }
      }

      return redirect($redirect_url);
    }
}
