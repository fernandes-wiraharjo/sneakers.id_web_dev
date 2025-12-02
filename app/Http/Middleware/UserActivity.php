<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class UserActivity
{
    public $activityTimeout = 600; // 10 minutes (600 seconds)

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $userId = Auth::user()->id;
            $key = "user_last_activity:{$userId}";
            Cache::put($key, now()->timestamp, $this->activityTimeout);
        }

        return $next($request);
    }
}
