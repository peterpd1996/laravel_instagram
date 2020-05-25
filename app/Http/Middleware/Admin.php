<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
class Admin
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
        if(auth()->user()->is_admin != User::ADMIN)
        {
            return redirect('/');
        }
        return $next($request);
    }
}
