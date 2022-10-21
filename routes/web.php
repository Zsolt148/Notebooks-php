<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

// Routes system
$routes = new RouteCollection();

// Notebooks CRUD
$routes->add('notebooks', new Route('/notebooks', ['controller' => 'NotebookController', 'method'=>'index'], []));
$routes->add('notebooks.show', new Route('/notebooks/{id}', ['controller' => 'NotebookController', 'method'=>'show'], ['id' => '[0-9]+']));
$routes->add('notebooks.create', new Route('/notebooks/create', ['controller' => 'NotebookController', 'method'=>'create']));
$routes->add('notebooks.store', new Route('/notebooks/create', ['controller' => 'NotebookController', 'method'=>'store']));
$routes->add('notebooks.edit', new Route('/notebooks/{id}/edit', ['controller' => 'NotebookController', 'method'=>'edit'], ['id' => '[0-9]+']));
$routes->add('notebooks.update', new Route('/notebooks/update', ['controller' => 'NotebookController', 'method'=>'update']));
$routes->add('notebooks.delete', new Route('/notebooks/delete', ['controller' => 'NotebookController', 'method'=>'delete']));
