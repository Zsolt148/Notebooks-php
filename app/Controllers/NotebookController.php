<?php

namespace App\Controllers;

use App\Helpers\Input;
use App\Helpers\RouteCollection;
use App\Models\Notebook;
use Exception;

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

	/**
	 * @return mixed
	 */
	public function create()
	{
		return $this->view('notebooks/create.php');
	}

	/**
	 * @return mixed|void
	 */
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

		} catch(Exception $e) {
			return $this->view('notebooks/create.php', [
				'errors' => $e->getMessage()
			]);
		}

		// Notebook::query()->insert($post); TODO add more fields to work

		return redirect(route($this->routes->get('notebooks.index')), [
			'status' => 'Successfully created',
		]);
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

	/**
	 * @param int $id
	 * @return mixed
	 */
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

		} catch(Exception $e) {
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

	/**
	 * @param int $id
	 * @return void
	 */
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