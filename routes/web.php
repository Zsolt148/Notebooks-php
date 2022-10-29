<?php

use App\Controllers\HomeController;
use App\Controllers\NotebookController;
use App\Helpers\Route;
use App\Helpers\RouteCollection;

$routes = new RouteCollection();

$routes->add('home', new Route('/', [HomeController::class, 'index']));
$routes->add('notebooks.index', new Route('/notebooks', [NotebookController::class, 'index']));
$routes->add('notebooks.create', new Route('/notebooks/create', [NotebookController::class, 'create']));
$routes->add('notebooks.store', new Route('/notebooks/store', [NotebookController::class, 'store']));
$routes->add('notebooks.show', new Route('/notebooks/{id}', [NotebookController::class, 'show']));
$routes->add('notebooks.edit', new Route('/notebooks/{id}/edit', [NotebookController::class, 'edit']));
$routes->add('notebooks.update', new Route('/notebooks/{id}/update', [NotebookController::class, 'update']));
$routes->add('notebooks.delete', new Route('/notebooks/{id}/delete', [NotebookController::class, 'delete']));