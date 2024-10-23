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


        $middleware->add('auth', \App\Http\Middleware\Authenticate::class);

        $middleware->add('auth.basic', \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class);

        $middleware->add('auth.session', \Illuminate\Session\Middleware\AuthenticateSession::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();