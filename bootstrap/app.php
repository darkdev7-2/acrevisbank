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
    ->withMiddleware(function (Middleware $middleware) {
        // Add security and locale middleware to web group
        $middleware->web(append: [
            \App\Http\Middleware\DetectPreferredLocale::class,
            \App\Http\Middleware\ForceHttps::class,
            \App\Http\Middleware\SessionTimeout::class,
            \App\Http\Middleware\DetectSuspiciousActivity::class,
        ]);

        // Register middleware aliases
        $middleware->alias([
            'two-factor' => \App\Http\Middleware\EnsureTwoFactorAuthenticated::class,
            'force-https' => \App\Http\Middleware\ForceHttps::class,
            'session-timeout' => \App\Http\Middleware\SessionTimeout::class,
            'detect-suspicious' => \App\Http\Middleware\DetectSuspiciousActivity::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
