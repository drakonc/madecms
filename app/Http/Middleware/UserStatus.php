<?php

namespace App\Http\Middleware;

use Closure,Auth;
use Illuminate\Http\Request;

class UserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->status != "100"):
            return $next($request);
        else:
            return redirect('/logout');
        endif;
    }
}
