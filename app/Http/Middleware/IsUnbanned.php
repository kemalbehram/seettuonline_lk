<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsUnbanned
{
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->banned) {        

            $redirect_to = "";
            if(auth()->user()->user_type == 'admin' || auth()->user()->user_type == 'staff'){
                $redirect_to = "seettu.login";
            }else{
                $redirect_to = "seettu.user.login";
            }

            auth()->logout();

            

            $message = translate("You are banned");
            flash($message);
        
            
                return redirect()->route($redirect_to);
            
            
        }

        return $next($request);
    }
}
