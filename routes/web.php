<?php

$router->get('/', function () use ($router) {
    return 'Welcome to TLM API Network';
});

$router->post('list_doctors', 'AdminController@list_doctors');

$router->post('/admin/login', 'AdminController@login');
$router->post('/doctors/add', 'AdminController@add');
$router->post('/doctors/delete', 'AdminController@delete');
$router->post('/doctors/update', 'AdminController@update');

$router->post('/token/add', 'AdminController@token_add');
$router->post('/token/get', 'AdminController@token_get');

$router->post('/display/doctors', 'DisplayController@display_doctors');
$router->post('/display/pharmacy', 'DisplayController@display_pharmacy');


$router->post('/ptoken/add', 'PharmacyController@ptoken_add');
$router->post('/ptoken/get', 'PharmacyController@ptoken_get');
