<?php

return [

    'stripe' => [

        /*
        |--------------------------------------------------------------------------
        | Route Names
        |--------------------------------------------------------------------------
        |
        | These route names are used to redirect from Stripe to
        | this server, whether the payment is canceled or successfully
        | completed.
        |
        */

        'route_names' => [
            'cancel_url' => 'api.process-payments.cancel',
            'success_url' => 'api.process-payments.success',
        ],

    ],
];
