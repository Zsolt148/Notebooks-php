<?php

use App\Controllers\HomeController;
use App\Controllers\NotebookController;
use App\Helpers\Route;
use App\Helpers\RouteCollection;

$routes = new RouteCollection();

$routes->add('home', Route::get('/', [HomeController::class, 'index']));
$routes->add('notebooks.index', Route::get('/notebooks', [NotebookController::class, 'index']));
$routes->add('notebooks.create', Route::get('/notebooks/create', [NotebookController::class, 'create']));
$routes->add('notebooks.store', Route::post('/notebooks/store', [NotebookController::class, 'store']));
$routes->add('notebooks.show', Route::get('/notebooks/{id}', [NotebookController::class, 'show']));
$routes->add('notebooks.edit', Route::get('/notebooks/{id}/edit', [NotebookController::class, 'edit']));
$routes->add('notebooks.update', Route::post('/notebooks/{id}/update', [NotebookController::class, 'update']));
$routes->add('notebooks.delete', Route::get('/notebooks/{id}/delete', [NotebookController::class, 'delete']));