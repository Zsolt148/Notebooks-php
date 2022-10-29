<?php

namespace App\Controllers;

use App\Helpers\Input;
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
		return $this->view('notebooks/create.php');
	}

	public function store()
	{
		$post = $_POST;

		try {
			Input::check([
				'manufacturer',
				'type',
				'display',
				'memory'
			], $post);

			Input::int($post['memory']);

			//TODO more validation

		} catch(\Exception $e) {
			return $this->view('notebooks/create.php', [
				'errors' => $e->getMessage()
			]);
		}
	}

	/**
	 * @param RouteCollection $routes
	 * @param int             $id
	 * @return mixed
	 */
    public function show(int $id)
    {
		$notebook = Notebook::query()->findOrFail($id);

		return $this->view('notebooks/show.php', [
			'notebook' => $notebook
		]);
    }

	public function edit(int $id)
	{
		$notebook = Notebook::query()->findOrFail($id);

		return $this->view('notebooks/edit.php', [
			'notebook' => $notebook
		]);
	}

	/**
	 * @param int $id
	 * @return mixed|void
	 */
	public function update(int $id)
	{
		//$post = file_get_contents('php://input');
		$post = $_POST;

		try {
			Input::check([
				'manufacturer',
				'type',
				'display',
				'memory'
			], $post);

			Input::int($post['memory']);

			//TODO more validation

		} catch(\Exception $e) {
			return $this->view('notebooks/edit.php', [
				'notebook' => Notebook::query()->findOrFail($id),
				'errors' => $e->getMessage()
			]);
		}

		Notebook::query()->update($id, $post);

		return redirect(route($this->routes->get('notebooks.index')), [
			'status' => 'Successfully updated',
		]);
	}

	public function delete(int $id)
	{
		$notebook = Notebook::query()->delete($id);

		if($notebook) {
			return redirect(route($this->routes->get('notebooks.index')), [
				'status' => 'Successfully deleted',
			]);
		}
	}
}