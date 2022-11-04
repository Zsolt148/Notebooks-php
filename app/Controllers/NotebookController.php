<?php

namespace App\Controllers;

use App\Helpers\Input;
use App\Helpers\RouteCollection;
use App\Models\Notebook;
use App\Models\Opsystem;
use Exception;

class NotebookController extends Controller
{
	protected $folder = 'notebooks';

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
		$notebooks = Notebook::query()
			->raw("
				SELECT notebooks.*, opsystems.id AS op_id, opsystems.os_name FROM notebooks 
				INNER JOIN opsystems ON notebooks.opsystem_id=opsystems.id ORDER BY notebooks.id
			");

        return $this->view('index', [
			'notebooks' => $notebooks
		]);
    }

	/**
	 * @return mixed
	 */
	public function create()
	{
		return $this->view('create', [
			'opsystems' => Opsystem::query()->getAll()
		]);
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
				'memory',
				'opsystem_id'
			], $post);

			Input::int($post['memory']);
			Input::int($post['opsystem_id']);

			//TODO more validation

		} catch(Exception $e) {
			return $this->view('create', [
				'errors' => $e->getMessage(),
				'opsystems' => Opsystem::query()->getAll()
			]);
		}

		// Notebook::query()->insert($post); TODO add more fields to work

		return redirect(route($this->routes->get('notebooks.index')), 'Successfully created');
	}

	/**
	 * @param RouteCollection $routes
	 * @param int             $id
	 * @return mixed
	 */
    public function show(int $id)
    {
		return $this->view('show', [
			'notebook' => Notebook::query()->findOrFail($id)
		]);
    }

	/**
	 * @param int $id
	 * @return mixed
	 */
	public function edit(int $id)
	{
		return $this->view('edit', [
			'notebook' => Notebook::query()->findOrFail($id),
			'opsystems' => Opsystem::query()->getAll(),
		]);
	}

	/**
	 * @param int $id
	 * @return mixed|void
	 */
	public function update(int $id)
	{
		$post = $_POST;

		try {
			Input::check([
				'manufacturer',
				'type',
				'display',
				'memory',
				'opsystem_id'
			], $post);

			Input::int($post['memory']);
			Input::int($post['opsystem_id']);

			//TODO more validation

		} catch(Exception $e) {
			return $this->view('edit', [
				'notebook' => Notebook::query()->findOrFail($id),
				'opsystems' => Opsystem::query()->getAll(),
				'errors' => $e->getMessage()
			]);
		}

		Notebook::query()->update($id, $post);

		return redirect(route($this->routes->get('notebooks.index')), 'Successfully updated');
	}

	/**
	 * @param int $id
	 * @return void
	 */
	public function delete(int $id)
	{
		$notebook = Notebook::query()->delete($id);

		if($notebook) {
			return redirect(route($this->routes->get('notebooks.index')), 'Successfully deleted');
		}
	}
}