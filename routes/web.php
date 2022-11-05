<?php

use App\Controllers\HomeController;
use App\Controllers\AuthenticateController;
use App\Controllers\MNBController;
use App\Controllers\NotebookController;
use App\Controllers\OpsystemController;
use App\Controllers\RegisterController;
use App\Helpers\Route;
use App\Helpers\RouteCollection;

$routes = new RouteCollection();

$routes->add('home', Route::get('/', [HomeController::class, 'index']));

$routes->add('login', Route::get('/login', [AuthenticateController::class, 'index']));
$routes->add('login.post', Route::post('/login/post', [AuthenticateController::class, 'login']));
$routes->add('logout', Route::get('/logout', [AuthenticateController::class, 'logout']));

$routes->add('register', Route::get('/register', [RegisterController::class, 'index']));
$routes->add('register.post', Route::post('/register/post', [RegisterController::class, 'register']));

$routes->add('notebooks.index', Route::get('/notebooks', [NotebookController::class, 'index']));
$routes->add('notebooks.create', Route::get('/notebooks/create', [NotebookController::class, 'create']));
$routes->add('notebooks.store', Route::post('/notebooks/store', [NotebookController::class, 'store']));
$routes->add('notebooks.show', Route::get('/notebooks/{id}', [NotebookController::class, 'show']));
$routes->add('notebooks.edit', Route::get('/notebooks/{id}/edit', [NotebookController::class, 'edit']));
$routes->add('notebooks.update', Route::post('/notebooks/{id}/update', [NotebookController::class, 'update']));
$routes->add('notebooks.delete', Route::get('/notebooks/{id}/delete', [NotebookController::class, 'delete']));

$routes->add('opsystems.index', Route::get('/opsystems', [OpsystemController::class, 'index']));
$routes->add('opsystems.create', Route::get('/opsystems/create', [OpsystemController::class, 'create']));
$routes->add('opsystems.store', Route::post('/opsystems/store', [OpsystemController::class, 'store']));
$routes->add('opsystems.show', Route::get('/opsystems/{id}', [OpsystemController::class, 'show']));
$routes->add('opsystems.edit', Route::get('/opsystems/{id}/edit', [OpsystemController::class, 'edit']));
$routes->add('opsystems.update', Route::post('/opsystems/{id}/update', [OpsystemController::class, 'update']));
$routes->add('opsystems.delete', Route::get('/opsystems/{id}/delete', [OpsystemController::class, 'delete']));

$routes->add('mnb', Route::get('/mnb', [MNBController::class, 'index']));