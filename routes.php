<?php

/**
 * A journey of a thousand miles begins with a single step.
 * Give me the first step of the journey, master.
 */

$router->addPattern(':b', '#form|content-box|grid#');

$router->get('/', 'HomeController@index');

// Authentication
$router->get('register', 'AuthController@register');
$router->post('register', 'AuthController@postRegister');
$router->get('login', 'AuthController@login');
$router->post('login', 'AuthController@postLogin');
$router->get('logout', 'AuthController@logout');

// Backend
$router->get('back', 'BackendController@index');

// Pages
$router->get('/pages/{id:i}', 'PagesController@show'); // TODO: use slug or title?
$router->get('pages/create', 'PagesController@create');
$router->post('pages', 'PagesController@store');
$router->get('pages/{id:i}/edit', 'PagesController@edit');
$router->put('pages/{id:i}', 'PagesController@update');
$router->delete('pages/{id:i}/delete', 'PagesController@delete');
$router->get('pages/homepage', 'PagesController@setupHomepage');
$router->post('pages/homepage', 'PagesController@postSetupHomepage');

// Blocks
$router->get('blocks/{type:b}/create', 'BlocksController@create');
$router->post('blocks/store/{type:b}', 'BlocksController@store');
$router->get('blocks/{id:i}/edit', 'BlocksController@edit');
$router->put('blocks/{id:i}', 'BlocksController@update');
$router->delete('blocks/{id:i}/delete', 'BlocksController@delete');

// Settings
$router->get('settings/general', 'SettingsController@general');
$router->post('settings/general', 'SettingsController@postGeneral');
$router->get('settings/background', 'SettingsController@background');
$router->post('settings/background/image', 'SettingsController@postBackgroundImage');
$router->post('settings/background/color', 'SettingsController@postBackgroundColor');
$router->post('settings/background/image/remove', 'SettingsController@postBackgroundImageRemove');