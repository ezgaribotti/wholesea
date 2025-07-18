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
        'cancel_url' => 'shipments.shipment-payments.cancel',
        'success_url' => 'shipments.shipment-payments.success',
    ],

    /*
    |--------------------------------------------------------------------------
    | Cost
    |--------------------------------------------------------------------------
    |
    | Fixed value for shipping cost.
    |
    */

    'cost' => 2000,

];
