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

$router->group(['prefix' => 'api', 'middleware' => 'auth'], function () use ($router) {
    // TODO: Sign routes

    // Teams
    $router->get('teams', ['uses' =>'TeamController@index']);
    $router->post('teams', ['uses' =>'TeamController@store']);
    $router->post('teams/add', ['uses' =>'TeamController@addMember']);
});
