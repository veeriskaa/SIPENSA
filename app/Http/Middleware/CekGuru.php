<?php

namespace App\Http\Middleware;

use Closure;


class CekGuru
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
{
    if (auth()->user()->role != 'guru_bk') {
        abort(403);
    }
    return $next($request);
}
}
