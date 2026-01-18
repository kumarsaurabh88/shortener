<?php

namespace App\Http\Middleware;

class HandleInertiaRequests
{
    public function handle($request, $next)
    {
        return $next($request);
    }
}
