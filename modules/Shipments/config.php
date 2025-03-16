<?php

return [

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
        'cancel_url' => 'shipment-payments.cancel',
        'success_url' => 'shipment-payments.success',
    ],

    'cost' => 2000,
];
