<?php

use Illuminate\Foundation\Application;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\CustomRoleRestrictionMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => RoleMiddleware::class,
            'custom.role' => CustomRoleRestrictionMiddleware::class,
            // You can add other middleware aliases here
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
