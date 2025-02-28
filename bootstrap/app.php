<?php

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (AuthenticationException $exception) {
            return response()->error(401, $exception->getMessage());
        });
        $exceptions->render(function (ValidationException $exception) {
            return response()->error(422, $exception->getMessage());
        });
        $exceptions->render(function (HttpException $exception) {
            return response()->error($exception->getStatusCode(), $exception->getMessage());
        });
        $exceptions->render(function (Throwable $throwable) {
            return response()->error(500, $throwable->getMessage());
        });
    })->create();
