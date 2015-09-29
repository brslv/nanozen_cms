<?php

/**
 * A journey of a thousand miles begins with a single step.
 * Give me the first step of the journey, master.
 */

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
$router->get('pages/create', 'PagesController@create');
$router->post('pages', 'PagesController@store');