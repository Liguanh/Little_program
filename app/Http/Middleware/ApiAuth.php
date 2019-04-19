<?php

namespace App\Http\Middleware;

use Closure;

class ApiAuth
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
        //ajax跨域问题解决,header
        header("Access-Control-Allow-Origin:*");

        //dd($request->all());
        return $next($request);
    }
}
