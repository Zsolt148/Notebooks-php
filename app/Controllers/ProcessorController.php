<?php

namespace App\Controllers;

use App\Helpers\RouteCollection;
use App\Models\Processor;
use Exception;

class ProcessorController extends Controller
{
	protected $folder = 'processors';

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
        return $this->view('index', [
			'processors' => Processor::query()->getAll()
		]);
    }

	/**
	 * @return mixed
	 */
	public function create()
	{
		abort_if(!auth()->check());

		return $this->view('create');
	}

	/**
	 * @return mixed|void
	 */
	public function store()
	{
		abort_if(!auth()->check());

		try {
			$validated = $this->validate([
                'manufacturer' => ['required', 'string'],
				'type' => ['required', 'string']
			]);

		} catch(Exception $e) {
			return $this->view('create', [
				'errors' => $e->getMessage()
			]);
		}

		 Processor::query()->insert($validated);

		return redirect(route($this->routes->get('processors.index')), 'Successfully created');
	}

	/**
	 * @param RouteCollection $routes
	 * @param int             $id
	 * @return mixed
	 */
    public function show(int $id)
    {
		return $this->view('show', [
			'processor' => Processor::query()->findOrFail($id)
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
			'processor' => Processor::query()->findOrFail($id)
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
			$validated = $this->validate([
                'manufacturer' => ['required', 'string'],
				'type' => ['required', 'string']
			]);

		} catch(Exception $e) {
			return $this->view('edit', [
				'processor' => Processor::query()->findOrFail($id),
				'errors' => $e->getMessage()
			]);
		}

		Processor::query()->update($id, $validated);

		return redirect(route($this->routes->get('processors.index')), 'Successfully updated');
	}

	/**
	 * @param int $id
	 * @return void
	 */
	public function delete(int $id)
	{
		abort_if(!auth()->check());

		$processor = Processor::query()->delete($id);

		if($processor) {
			return redirect(route($this->routes->get('processors.index')), 'Successfully deleted');
		}
	}
}