<?php

namespace App\Providers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\ServiceProvider;

class RedirectMacroServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        Redirect::macro('toClient', function (array $parameters = []) {
            $url = config('redirects.client_url');

            return Redirect::away($url . QUESTION_MARK . http_build_query($parameters));
        });
    }
}
