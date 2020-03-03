<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class ComprobarAutenticacion
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!session()->has('user') || !session()->has('usuarioid')) {
            return redirect()->route('inicio');
        }

        return $next($request);
    }
}
