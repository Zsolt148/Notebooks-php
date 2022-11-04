<?php

namespace App\Controllers;

use App\Helpers\Input;
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
		return $this->view('create');
	}

	/**
	 * @return mixed|void
	 */
	public function store()
	{
		$post = $_POST;

		try {
			Input::check([
				'os_name',
			], $post);

			Input::str($post['os_name']);

		} catch(Exception $e) {
			return $this->view('create', [
				'errors' => $e->getMessage()
			]);
		}

		 Opsystem::query()->insert($post);

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
		$post = $_POST;

		try {
			Input::check([
				'os_name',
			], $post);

			Input::str($post['os_name']);

		} catch(Exception $e) {
			return $this->view('edit', [
				'opsystem' => Opsystem::query()->findOrFail($id),
				'errors' => $e->getMessage()
			]);
		}

		Opsystem::query()->update($id, $post);

		return redirect(route($this->routes->get('opsystems.index')), 'Successfully updated');
	}

	/**
	 * @param int $id
	 * @return void
	 */
	public function delete(int $id)
	{
		$opsystem = Opsystem::query()->delete($id);

		if($opsystem) {
			return redirect(route($this->routes->get('opsystems.index')), 'Successfully deleted');
		}
	}
}