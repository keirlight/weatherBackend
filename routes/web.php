<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'weather'], function () use ($router) {
    $router->get('/', 'WeatherController@index');
    return $router;
});
$router->group(['prefix' => 'forecast'], function () use ($router) {
    $router->get('/', 'WeatherController@forecast');
    return $router;
});

$router->group(['prefix' => 'search'], function () use ($router) {
    $router->get('/', 'PlaceController@index');
    return $router;
});