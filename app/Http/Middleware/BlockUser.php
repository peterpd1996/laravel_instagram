<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class BlockUser
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
        if(auth()->user()->is_block == 1)
        {
            return redirect('/block');
        }

        return $next($request);
    }
}
