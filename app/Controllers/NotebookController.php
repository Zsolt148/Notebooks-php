<?php

namespace App\Controllers;

use App\Helpers\RouteCollection;
use App\Models\Notebook;

class NotebookController extends Controller
{
	/**
	 * @param RouteCollection $routes
	 */
	public function __construct(RouteCollection $routes)
	{
		parent::__construct($routes);
	}

	/**
	 * @return mixed
	 */
    public function index()
    {
		// Fetch all notebooks
		$notebooks = Notebook::query()->getAll();

        return $this->view('notebooks/index.php', [
			'notebooks' => $notebooks
		]);
    }

	public function create()
	{

	}

	public function store()
	{

	}

	/**
	 * @param RouteCollection $routes
	 * @param int             $id
	 * @return mixed
	 */
    public function show(int $id)
    {
		$notebook = Notebook::query()->find($id);

		return $this->view('notebooks/show.php', [
			'notebook' => $notebook
		]);
    }

	public function edit(int $id)
	{
		$notebook = Notebook::query()->find($id);

		return $this->view('notebooks/edit.php', [
			'notebook' => $notebook
		]);
	}

	public function update(int $id)
	{
		$notebook = Notebook::query()->find($id);
		//$post = file_get_contents('php://input');
		$post = $_POST;

		dd($post);
	}

	public function delete(int $id)
	{
		$notebook = Notebook::query()->find($id);

	}
}