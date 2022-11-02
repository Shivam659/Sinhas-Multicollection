<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use Exception;
use Auth;
class TokenMismatchException extends Exception {}

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle($request, Closure $next)
    {
        // dd(Auth::guard('admin')->check());

        if ( Auth::guard('admin')->check() == true) {
           return $next($request);
        }

        
        return  redirect()->route('admin.login');
    }
}   
