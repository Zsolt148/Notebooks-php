<?php

namespace App\Controllers;

use App\Models\Notebook;
use Symfony\Component\Routing\RouteCollection;

class NotebookController extends Controller
{
	/**
	 * @param RouteCollection $routes
	 * @return mixed
	 */
    public function index(RouteCollection $routes)
    {
		// routes
		$show = $routes->get('notebooks.show')->getPath();
		$edit = $routes->get('notebooks.edit')->getPath();

		$notebooks = Notebook::query()->getAll();

        return require_once view('notebooks/index.php');
    }

	public function create(RouteCollection $routes)
	{

	}

	public function store(RouteCollection $routes)
	{

	}

	/**
	 * @param RouteCollection $routes
	 * @param int             $id
	 * @return mixed
	 */
    public function show(RouteCollection $routes, int $id)
    {
		$notebook = Notebook::query()->find($id);

		return require_once view('notebooks/show.php');
    }

	public function edit(RouteCollection $routes, int $id)
	{
		$notebook = Notebook::query()->find($id);

		return require_once view('notebooks/edit.php');
	}

	public function update(RouteCollection $routes, int $id)
	{
		$notebook = Notebook::query()->find($id);

	}

	public function delete(RouteCollection $routes, int $id)
	{
		$notebook = Notebook::query()->find($id);

	}
}