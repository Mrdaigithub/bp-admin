<?php namespace App\Http\Middleware;

use Closure;

class VerifyCsrf
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($_SERVER['HTTP_ORIGIN'] !== $_SERVER['HTTP_HOST']) return response(json_encode(['error' => 401002]), 401);
        return $next($request);
    }

}
