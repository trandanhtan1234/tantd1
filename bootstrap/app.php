<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'CheckLogin' => \App\Http\Middleware\CheckLogin::class,
            'CheckLogout' => \App\Http\Middleware\CheckLogout::class,
            'CustomerLogout' => \App\Http\Middleware\CustomerLogout::class,
            'SessionTimeout' => \App\Http\Middleware\SessionTimeout::class,
            'apiauth' => \App\Http\Middleware\ApiAuthMiddleware::class,
            'multipleAuthMiddleware' => \App\Http\Middleware\MultiAuthMiddleware::class
        ]);
        $middleware->group('api', [
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
