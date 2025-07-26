<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Middlewares
    |--------------------------------------------------------------------------
    |
    | These middlewares will be applied to all api routes within each module.
    | You can add more middleware to this array as needed to protect or modify
    | the behavior of the routes.
    |
    */

    'middlewares' => ['api', 'throttle:api'],

    /*
    |--------------------------------------------------------------------------
    | Name
    |--------------------------------------------------------------------------
    |
    | This value will be added to the name of every route registered within
    | each module. It helps keep route names organized and prevents naming
    | conflicts.
    |
    */

    'name' => 'api.'

];
