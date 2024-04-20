<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {


        // dd(auth()->user());
        // if (!Auth::check()) {
        //     return redirect(route('login'));
        // }
        // dd(Auth::check());
        // if (!= 'admin') {
            // return redirect(route('home'));
        // }else{
            return $next($request);
        // }
       
    }
}
