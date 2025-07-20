<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    // 2) Middleware globales (equivalente a $middleware en Kernel.php)
    ->withMiddleware(function (Middleware $m) {
        $m->append(\App\Http\Middleware\TrustProxies::class);
        $m->append(\App\Http\Middleware\CheckForMaintenanceMode::class);
        $m->append(\Illuminate\Foundation\Http\Middleware\ValidatePostSize::class);
        $m->append(\App\Http\Middleware\TrimStrings::class);
        $m->append(\Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class);
    })

    // 3) Grupos de middleware (equivalente a $middlewareGroups)
    ->withMiddlewareGroups(function (Middleware $m) {
        $m->web([
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]);

        $m->api([
            'throttle:60,1',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]);
    })

    // 4) Aliases de middleware (equivalente a $routeMiddleware)
    ->withMiddlewareAliases(function (Middleware $a) {
        $a->alias('auth',           \App\Http\Middleware\Authenticate::class);
        $a->alias('guest',          \App\Http\Middleware\RedirectIfAuthenticated::class);
        $a->alias('verified',       \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class);
        $a->alias('throttle',       \Illuminate\Routing\Middleware\ThrottleRequests::class);
        // tu middleware personalizado:
        $a->alias('admin',          \App\Http\Middleware\AdminMiddleware::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
