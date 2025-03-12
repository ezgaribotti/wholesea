<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Client URL
    |--------------------------------------------------------------------------
    |
    | This URL is used when you need to redirect to the client application.
    |
    */

    'client_url' => env('CLIENT_URL'),

    'stripe' => [

        /*
        |--------------------------------------------------------------------------
        | Secret key
        |--------------------------------------------------------------------------
        |
        | This secret key provided by Stripe, used to
        | authenticate your api requests.
        |
        */

        'secret_key' => env('STRIPE_SECRET_KEY'),

        /*
        |--------------------------------------------------------------------------
        | Mode
        |--------------------------------------------------------------------------
        |
        | The mode of the checkout session.
        |
        */

        'mode' => 'payment',

        /*
        |--------------------------------------------------------------------------
        | Currency
        |--------------------------------------------------------------------------
        |
        | The currency represents the currency in which the payment will be
        | processed. Stripe supports only currencies with a valid iso 4217
        | currency code.
        |
        */

        'currency' => 'usd',

    ],

];
