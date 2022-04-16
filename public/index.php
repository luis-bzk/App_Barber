<?php

require_once __DIR__ . '/../includes/app.php';

use Controllers\AdminController;
use Controllers\APIController;
use Controllers\AppointmentController;
use Controllers\LoginController;
use Controllers\ServiceController;
use MVC\Router;

$router = new Router();

// URL's
// === === === === === === login & other services
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);
// logout
$router->get('/logout', [LoginController::class, 'logout']);

// Create an account
$router->get('/create-account', [LoginController::class, 'createAccount']);
$router->post('/create-account', [LoginController::class, 'createAccount']);
// account validation
$router->get('/confirm-account', [LoginController::class, 'confirm']);
$router->get('/message', [LoginController::class, 'message']);
// reset password
$router->get('/forgot-password', [LoginController::class, 'forgotPassword']);
$router->post('/forgot-password', [LoginController::class, 'forgotPassword']);
// recover password
$router->get('/recover-password', [LoginController::class, 'recoverPassword']);
$router->post('/recover-password', [LoginController::class, 'recoverPassword']);

// === === === === === === API appointments
$router->get('/api/services', [APIController::class, 'index']);
$router->post('/api/appointments', [APIController::class, 'save']);
$router->post('/api/delete', [APIController::class, 'delete']);

// === === === === === === PRIVATE AREA, only users account
$router->get('/appointment', [AppointmentController::class, 'index']);

// === === === === === === admin area
$router->get('/admin', [AdminController::class, 'index']);

// === === === === === === Services CRUD
$router->get('/services', [ServiceController::class, 'index']);
$router->get('/services/create', [ServiceController::class, 'create']);
$router->post('/services/create', [ServiceController::class, 'create']);
$router->get('/services/update', [ServiceController::class, 'update']);
$router->post('/services/update', [ServiceController::class, 'update']);
$router->post('/services/delete', [ServiceController::class, 'delete']);



// Checks and validates routes, if they exist, and assigns Controller functions to them
$router->checkRoutes();
