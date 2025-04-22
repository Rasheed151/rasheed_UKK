<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (session()->has('user_id')) {
            if ($request->routeIs('login.form')) {
                $level = session('user_level');
                switch ($level) {
                    case 1:
                        return redirect()->route('home');
                    case 2:
                        return redirect()->route('receptionist.index');
                    default:
                        return redirect()->route('admin.index');
                }
            }
    
        }
        
        return $next($request);
    }
    
}
