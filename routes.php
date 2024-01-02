<?php

use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Router;

/** @var $router Router */

$router->name('home')->get('/', function () {
    echo 'login';
});

$router->group(['namespace' => 'PersonalFinance\Controllers', 'prefix' => 'entries'], function (Router $router) {
    $router->get('/', ['name' => 'entries.index', 'uses' => 'EntryController@index']);
});

$router->group(['namespace' => 'PersonalFinance\Controllers', 'prefix' => 'outputs'], function (Router $router) {
    $router->get('/', ['name' => 'outputs.index', 'uses' => 'OutputController@index']);
});

$router->group(['namespace' => 'PersonalFinance\Controllers', 'prefix' => 'movements'], function (Router $router) {
    $router->get('/', ['name' => 'movements.index', 'uses' => 'MovementController@index']);
});

$router->group(['namespace' => 'PersonalFinance\Controllers', 'prefix' => 'persons'], function (Router $router) {
    $router->get('/', ['name' => 'persons.index', 'uses' => 'PersonController@index']);
});

// Redirect
$router->get('/menu', function () use ($router) {
    return new RedirectResponse($router->getRoutes()->getByName('home')->uri());
});

// catch-all route
$router->any('{any}', function () {
    return 'four oh four';
})->where('any', '(.*)');