<?php

use App\Http\Middleware\TokenValidationMiddleware;
use App\Providers\GuzzleServiceProvider;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withProviders([
        GuzzleServiceProvider::class,
        // Other Service Providers
    ])
    ->withRouting(
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'jwt.validate' => TokenValidationMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {})
    ->create();
