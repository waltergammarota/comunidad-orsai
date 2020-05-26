<?php

namespace App\Http\Middleware;

use Closure;

class CheckEmailVerified
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->user()->hasVerifiedEmail()) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
