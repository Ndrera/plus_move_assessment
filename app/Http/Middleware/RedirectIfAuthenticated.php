<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {

            if (Auth::guard($guard)->check() && Auth::user()->role_id == 1 ) {  //admin

                //return redirect(RouteServiceProvider::HOME);
                return redirect()->route('admin.home');

            }else if( Auth::guard($guard)->check() && Auth::user()->role_id == 2 ){   //warehouse

                return redirect()->route('warehouse.home');

            }else if(  Auth::guard($guard)->check() && Auth::user()->role_id == 3 ){   //driver

                return redirect()->route('driver.home');

            }else{

                return $next($request);
            }
        

        }

        //return $next($request);
    }
}
