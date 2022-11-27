<?php

namespace App\Controllers;

use App\Helpers\RouteCollection;
use App\Models\Opsystem;
use Exception;

class OpsystemController extends Controller
{
	protected $folder = 'opsystems';

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
			'opsystems' => Opsystem::query()->getAll()
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
				'os_name' => ['required', 'string']
			]);

		} catch(Exception $e) {
			return $this->view('create', [
				'errors' => $e->getMessage()
			]);
		}

		 Opsystem::query()->insert($validated);

		return redirect(route($this->routes->get('opsystems.index')), 'Successfully created');
	}

	/**
	 * @param RouteCollection $routes
	 * @param int             $id
	 * @return mixed
	 */
    public function show(int $id)
    {
		return $this->view('show', [
			'opsystem' => Opsystem::query()->findOrFail($id)
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
			'opsystem' => Opsystem::query()->findOrFail($id)
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
				'os_name' => ['required', 'string']
			]);

		} catch(Exception $e) {
			return $this->view('edit', [
				'opsystem' => Opsystem::query()->findOrFail($id),
				'errors' => $e->getMessage()
			]);
		}

		Opsystem::query()->update($id, $validated);

		return redirect(route($this->routes->get('opsystems.index')), 'Successfully updated');
	}

	/**
	 * @param int $id
	 * @return void
	 */
	public function delete(int $id)
	{
		abort_if(!auth()->check());

		$opsystem = Opsystem::query()->delete($id);

		if($opsystem) {
			return redirect(route($this->routes->get('opsystems.index')), 'Successfully deleted');
		}
	}
}