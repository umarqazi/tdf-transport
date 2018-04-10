<?php  namespace LaravelAcl\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

/*
 * Check that the current user is logged and active and redirect to client login or
 * to custom url if given
 */
class AdminLogged {

    public function handle($request, Closure $next, $custom_url = null)
    {
        // $redirect_url = $custom_url ?: '/login';
        // if(!App::make('authenticator')->check()) return redirect($redirect_url);
        $redirect_url = $custom_url ?: '/';
        $admin=Auth::user();
        if($admin)
        {
          $admin=Auth::user()->type;
        }
        if($admin!='Admin') return redirect($redirect_url);
        return $next($request);
    }
}
