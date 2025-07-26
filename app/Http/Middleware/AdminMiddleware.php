<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */


    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->rol === 'administrador') {
            return $next($request);
        }

        abort(403, 'No tienes permiso para acceder.');
    }
    // Antigua función handle
    /*
    public function handle($request, Closure $next)
    {
        if(!isset(Auth::user()->rol) || Auth::user()->rol != 'administrador') {
            abort(404);
        }
        return $next($request);
    }
    */
}
