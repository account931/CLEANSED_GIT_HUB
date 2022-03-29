<?php
//Test middleware. Not used here
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth; 

class CheckAge
{
    /**
     * Handle an incoming request.
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        dd('Age ' . auth('api')->user());
        return $next($request);
    }
}
