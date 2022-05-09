<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->is('admin/*'))//If user is creating a post
        {
            if (Auth::user()->jabatan == 'Desk Collection') //If user jabatan user is Desk Collection
            {
                if(Auth::user()->resume == '' || Auth::user()->resume == null && Auth::user()->f_ktp == '' || Auth::user()->f_ktp == null && Auth::user()->f_kk == '' || Auth::user()->f_kk == null && Auth::user()->f_ijazah == '' || Auth::user()->f_ijazah == null){
                    abort('401');
                }
            }
        }

        return $next($request);
    }
}
