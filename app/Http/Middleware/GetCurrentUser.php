<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class GetCurrentUser
{
    public function handle($request, Closure $next)
    {
        View::share('user', Auth::user());

        return $next($request);
    }
}
