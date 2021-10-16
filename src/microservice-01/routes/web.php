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
    return phpinfo();
    return 'servie-mail ' . $router->app->version();
});

$router->group(['prefix' => '/api/v1', 'namespace' => 'V1'], function ($router) {
    $router->post('/send', 'MailController@sendEmail');

    $router->group(['prefix' => '/auth', 'namespace' => 'Auth'], function ($router) {
        $router->post('/login', 'LoginController@login');
        $router->post('/register', 'RegisterController@register');
    });

    $router->group(['prefix' => '/posts'], function ($router) {
        $router->get('/', 'PostController@index');
        $router->get('/{slug}', 'PostController@show');
        $router->post('/', 'PostController@store');
        $router->put('/', 'PostController@update');
        $router->delete('/', 'PostController@destroy');
    });
});

$router->get('/redis', 'ExampleController@index');
