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
                if(Auth::user()->resume == '' || Auth::user()->resume == null){
                    abort('401');
                }
            }
        }

        return $next($request);
    }
}
