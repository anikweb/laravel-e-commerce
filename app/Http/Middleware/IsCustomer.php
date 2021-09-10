<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsCustomer
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
        if( auth()->user()->roles->first()->name != 'Customer'){
            return back()->with('fail','only customer can checkout!');
        }
        return $next($request);
    }
}
