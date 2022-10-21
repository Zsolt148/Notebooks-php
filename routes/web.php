<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

// Routes system
$routes = new RouteCollection();

$routes->add('notebooks', new Route('/notebooks', ['controller' => 'NotebookController', 'method'=>'index'], []));
$routes->add('notebooks.show', new Route('/notebooks/{id}', ['controller' => 'NotebookController', 'method'=>'show'], ['id' => '[0-9]+']));