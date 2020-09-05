<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use Illuminate\Http\Request;

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
    $router->post('refresh', ['uses' => 'AuthController@refresh']);
    $router->post('forgot-password', ['uses' => 'UserController@forgetPassword']);
    $router->post('forgot-token', ['uses' => 'UserController@forgetToken']);
    $router->post('new-password', ['uses' => 'UserController@newPassword']);

    // institutions
    $router->get('institutions', ['uses' => 'InstitutionController@institutions']);

    // secure api
    $router->group(['middleware' => 'auth'], function () use ($router) {

        // Users
        $router->get('profiles', ['uses' => 'UserController@profile']);
        $router->put('update-profile', ['uses' => 'UserController@update']);

        // Teams
        $router->get('teams/{id}', ['uses' => 'TeamController@show']);
        $router->post('teams/add', ['uses' => 'TeamController@addMember']);

        // For team member only
        $router->group(['middleware' => 'team'], function () use ($router) {
            $router->get('teams/{id}/payment-proof', ['uses' => 'TeamController@getPaymentProof']);
            $router->post('teams/{id}/payment-proof', ['uses' => 'TeamController@uploadPaymentProof']);
            $router->get('teams/{id}/identity-pics', ['uses' => 'TeamController@getIdentities']);
            $router->get('teams/{id}/identity-pics/{filename}', ['uses' => 'TeamController@getIdentity']);
            $router->post('teams/{id}/identity-pics', ['uses' => 'TeamController@uploadIdentity']);
            $router->get('teams/{id}/proofs', ['uses' => 'TeamController@getProofs']);
            $router->get('teams/{id}/proofs/{filename}', ['uses' => 'TeamController@getProof']);
            $router->post('teams/{id}/proofs', ['uses' => 'TeamController@uploadProof']);
        });
    });

    $router->group(['prefix' => 'admin'], function () use ($router) {
        $router->post('auth', ['uses' => 'AdminController@auth']);

        $router->group(['middleware' => 'admin', 'prefix' => 'dashboard'], function () use ($router) {
            // Teams
            $router->get('teams', ['uses' => 'TeamController@index']);
            $router->get('teams/{id}', ['uses' => 'TeamController@show']);
            $router->put('teams/{id}', ['uses' => 'TeamController@updateStatus']);
            $router->get('teams/{id}/payment-proof', ['uses' => 'TeamController@getPaymentProof']);
            $router->get('teams/{id}/identity-pics', ['uses' => 'TeamController@getIdentities']);
            $router->get('teams/{id}/identity-pics/{filename}', ['uses' => 'TeamController@getIdentity']);
            $router->get('teams/{id}/proofs', ['uses' => 'TeamController@getProofs']);
            $router->get('teams/{id}/proofs/{filename}', ['uses' => 'TeamController@getProof']);

            // Users
            $router->get('users', ['uses' => 'UserController@index']);
            $router->get('users/{id}', ['uses' => 'UserController@show']);

            // Competitions
            $router->get('competitions', ['uses' => 'DashboardController@getAllCompetition']);
            $router->get('competitions/{id}/teams', ['uses' => 'CompetitionController@showTeams']);

            $router->post('register', ['uses' => 'AdminController@register']);
        });
    });
});
