<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    // //this method will be triggered before your controller constructor
    // public function handle($request, Closure $next, )
    // {
    //     //check here if the user is authenticated
    //     if ( ! $this->auth->user() )
    //     {
    //         // here you should redirect to login
    //         return redirect()->route('customer.login');
    //     }

    //     return $next($request);
    // }
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('customer.login');
        }
    }
}
