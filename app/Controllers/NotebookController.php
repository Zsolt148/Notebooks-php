<?php

namespace App\Controllers;

use App\Models\Notebook;
use Symfony\Component\Routing\RouteCollection;

class NotebookController extends Controller
{
    public function index(RouteCollection $routes)
    {
		$route = $routes->get('notebooks.show')->getPath();
		$notebook = new Notebook();
		$notebooks = $notebook->getAll();

        //$route = str_replace('{id}', 1, $routes->get('notebooks-show')->getPath());

        require_once view('/notebooks/index.php');
    }

    public function show(RouteCollection $routes, $id)
    {
        require_once view('/notebooks/show.php');
    }
}