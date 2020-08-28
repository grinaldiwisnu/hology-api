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

$router->group(['prefix' => 'api'], function () use ($router) {
    // TODO: Sign routes

    // auth
    $router->post('register', ['uses' => 'AuthController@register']);
    $router->post('login', ['uses' => 'AuthController@auth']);

    // secure api
    $router->group(['middleware' => 'auth'], function () use ($router) {
        // Teams
        $router->get('teams', ['uses' => 'TeamController@index']);
        $router->post('teams', ['uses' => 'TeamController@store']);
        $router->post('teams/add', ['uses' => 'TeamController@addMember']);
        
        // Institutions
        $router->get('institutions', ['uses' => 'InstitutionController@institutions']);
    });
});
