<?php

use App\Http\Resources\AllowedRouteResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\PersonalAccessToken;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/allowed-routes', function (Request $request) {

    $token = $request->bearerToken() ? PersonalAccessToken::findToken($request->bearerToken()) : null;
    $allowedRoutes = [];
    foreach (Route::getRoutes() as $route) {
        $splitName = explode(chr(46), $route->getName());
        if (!in_array(count($splitName), [2, 3])) {
            continue;
        }
        $name = str_replace(chr(45), chr(95), $splitName[1]);

        if (count($splitName) === 2) {
            $allowedRoutes[$name] = $route->uri();
            continue;
        }
        if (!isset($allowedRoutes[$name]) && $token) {
            $allowedRoutes[$name] = $route->uri();
        }
    }
    return response()->success(new AllowedRouteResource($allowedRoutes));
});
