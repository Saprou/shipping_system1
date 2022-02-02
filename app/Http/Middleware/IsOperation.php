<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsOperation
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
        if (auth()->user() && auth()->user()->role == 'operation') {
            return $next($request);
       }

       return redirect('home')->with('error','You have not opera access');
    }
}
