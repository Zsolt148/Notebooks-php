<?php

namespace App\Controllers;

use App\Helpers\Input;
use App\Helpers\RouteCollection;
use App\Models\Notebook;
use App\Models\Opsystem;
use App\Models\Processor;
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
				SELECT notebooks.*, opsystems.id AS op_id, opsystems.os_name, processors.id AS proc_id, processors.manufacturer AS proc_manufacturer, processors.type AS proc_type 
				FROM notebooks 
				INNER JOIN opsystems ON notebooks.opsystem_id=opsystems.id
				INNER JOIN processors ON notebooks.processor_id=processors.id
			    ORDER BY notebooks.id
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
		abort_if(!auth()->check());

		return $this->view('create', [
			'opsystems' => Opsystem::query()->getAll(),
			'processors' => Processor::query()->getAll()
		]);
	}

	/**
	 * @return mixed|void
	 */
	public function store()
	{
		abort_if(!auth()->check());

		try {
			$validated = $this->validate($this->rules());

		} catch(Exception $e) {
			return $this->view('create', [
				'errors' => $e->getMessage(),
				'opsystems' => Opsystem::query()->getAll(),
				'processors' => Processor::query()->getAll()
			]);
		}

		 Notebook::query()->insert($validated);

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
		abort_if(!auth()->check());

		return $this->view('edit', [
			'notebook' => Notebook::query()->findOrFail($id),
			'opsystems' => Opsystem::query()->getAll(),
			'processors' => Processor::query()->getAll()
		]);
	}

	/**
	 * @param int $id
	 * @return mixed|void
	 */
	public function update(int $id)
	{
		abort_if(!auth()->check());

		try {
			$validated = $this->validate($this->rules());

		} catch(Exception $e) {
			return $this->view('edit', [
				'notebook' => Notebook::query()->findOrFail($id),
				'opsystems' => Opsystem::query()->getAll(),
				'processors' => Processor::query()->getAll(),
				'errors' => $e->getMessage()
			]);
		}

		Notebook::query()->update($id, $validated);

		return redirect(route($this->routes->get('notebooks.index')), 'Successfully updated');
	}

	/**
	 * @param int $id
	 * @return void
	 */
	public function delete(int $id)
	{
		abort_if(!auth()->check());

		$notebook = Notebook::query()->delete($id);

		if($notebook) {
			return redirect(route($this->routes->get('notebooks.index')), 'Successfully deleted');
		}
	}

	/**
	 * @return array
	 */
	private function rules() : array
	{
		return [
			'manufacturer' => ['required', 'string'],
			'type' => ['required', 'string'],
			'display' => ['required', 'float'],
			'memory' => ['required', 'int'],
			'harddisk' => ['required', 'int'],
			'videocontroller' => ['required', 'string'],
			'price' => ['required', 'int'],
			'processor_id' => ['required', 'int'],
			'opsystem_id' => ['required', 'int'],
			'pieces' => ['nullable', 'int'],
		];
	}
}