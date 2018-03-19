<?php  namespace LaravelAcl\Http\Middleware; 

use Closure;
use Illuminate\Support\Facades\App;

/*
 * Check that the user has one of the permission given
 */
class HasPerm {

    public function handle($request, Closure $next, $custom_url=NULL)
    {
        $permissions = array_slice(func_get_args(), 2);
        $redirect_url = URL('/dashboard');
        $authentication_helper = App::make('authentication_helper');
        if(!$authentication_helper->hasPermission($permissions)) return redirect($redirect_url);

        return $next($request);
    }
} 