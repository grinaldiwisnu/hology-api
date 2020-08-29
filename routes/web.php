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

$router->post('/{id}/lol/{lol}', function (Request $request, $id, $lol) use ($router) {
    echo $id, $lol;
    die();

    $file = $request->file('payment_proof');

    $originalName = $file->getClientOriginalName();
    $mimeType = $file->getClientMimeType();

    move_uploaded_file($file->getPathname(), storage_path("/app/$originalName"));

    $newFile = file_get_contents(storage_path("/app/$originalName"));

    return response($newFile, 200, ['Content-Type' => $mimeType]);
});

$router->group(['prefix' => 'api'], function () use ($router) {
    // TODO: Sign routes

    // auth
    $router->post('register', ['uses' => 'AuthController@register']);
    $router->post('login', ['uses' => 'AuthController@auth']);
    $router->post('refresh', ['uses' => 'AuthController@refresh']);

    // institutions
    $router->get('institutions', ['uses' => 'InstitutionController@institutions']);

    // secure api
    $router->group(['middleware' => 'auth'], function () use ($router) {

        // Teams
        $router->get('teams', ['uses' => 'TeamController@index']);
        $router->post('teams', ['uses' => 'TeamController@store']);
        $router->post('teams/{id}/add', ['uses' => 'TeamController@addMember']);

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
});
