<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    public function handle($request, Closure $next, ...$guard)
    {
        if (!Auth::check()) {
            return back()->with('info', 'Please login!');
        }

        $user = Auth::user();

        $route = $request->route()->getName();

        return $next($request);
    }
}
