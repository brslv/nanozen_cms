<?php

/**
 * A journey of a thousand miles begins with a single step.
 * Give me the first step of the journey, master.
 */

$router->get('/', 'HomeController@index');

// Authentication
$router->get('/register', 'AuthController@register');
$router->post('/register', 'AuthController@postRegister');