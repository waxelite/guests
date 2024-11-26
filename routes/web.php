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

/**
 * Гости (Guests)
 */
$router->group(['prefix' => 'api/guests'], function () use ($router) {
    $router->get('/', 'GuestController@index');
    $router->get('{id}', 'GuestController@show');
    $router->post('/', 'GuestController@store');
    $router->put('{id}', 'GuestController@update');
    $router->delete('{id}', 'GuestController@destroy');
});
