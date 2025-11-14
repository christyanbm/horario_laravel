<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('role')) {
            return redirect('/login');
        }
        return $next($request);
    }
}
