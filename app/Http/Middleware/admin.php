<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (session('user_level') == 1 || session('user_level') == 2) {
            if (session('user_level') == 1) {
                return redirect()->route('home')->with('error', 'Maaf,anda tidak bisa mengakses halaman tersebut');
            }elseif(session('user_level') == 2){
                return redirect()->route('receptionist')->with('error', 'Maaf,anda tidak bisa mengakses halaman tersebut');
            }
        }


        return $next($request);
    }
}
