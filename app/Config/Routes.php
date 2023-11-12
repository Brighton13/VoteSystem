<?php

use App\Controllers\Home;
use App\Controllers\VotersController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get("/", [Home::class, "index"], ['filter' => 'NoAuth']);
$routes->match(['get', 'post'], 'login', 'VotersController::login', ['filter' => 'NoAuth']); //page

$routes->group('Admin', ['filter' => 'Auth'], function ($routes) {
    $routes->get('/', 'AdminController::home'); //page
    $routes->get('AllUsers', 'AdminController::AllUsers');
    $routes->get('AllNominees', 'AdminController::Nominees');
    $routes->get('Results', 'AdminController::voteResults');
    $routes->match(['get', 'post'], 'Nominate/User/(:num)', 'AdminController::usernomination/$1'); //function
    $routes->get('DeleteUser/(:num)', 'AdminController::deleteuser/$1');
    $routes->match(['get', 'post'], 'EditUser/(:num)', 'AdminController::edituser/$1');
    $routes->match(['get', 'post'], 'Registration', 'AdminController::createUser');
    $routes->match(['get', 'post'], 'Vote', 'VotersController::vote');

});
$routes->group('User', ['filter' => 'Auth'], function ($routes) {
    $routes->match(['get', 'post'], '/', 'VotersController::vote');

});

$routes->get('generatepdf', 'AdminController::generatepdf', ['filter' => 'Auth']);

$routes->get('admin', 'AdminController::home', ['filter' => 'Auth']);

$routes->get('logout', 'VotersController::logout', ['filter' => 'Auth']);

$routes->match(['get', 'post'], 'Vote', 'VotersController::vote', ['filter' => 'Auth']);
$routes->get('Vote/Nominee/(:num)', 'VotersController::vote/$1', ['filter' => 'Auth']);



//
//$routes->get('/', 'Home::index');

//public Routes
//$routes->post('Voter/login', 'VotersController::loginuser'); //function
//pages



