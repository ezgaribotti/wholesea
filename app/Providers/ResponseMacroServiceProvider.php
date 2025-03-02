<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ResponseMacroServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        Response::macro('justMessage', function (string $message) {
            return Response::json([
                'message' => __($message),
                'data' => null,
            ]);
        });

        Response::macro('success', function (object $data, ?string $message = null) {
            return Response::json([
                'message' => __($message),
                'data' => $data,
            ]);
        });

        Response::macro('error', function (int $statusCode = 500, ?string $message = null) {
            if (!in_array($statusCode, [400, 401, 403, 404, 422, 500])) {
                $statusCode = 500;
            }
            return Response::json([
                'message' => __($message),
                'data' => null,
            ], $statusCode);
        });
    }
}
