<?php

namespace App\Controllers;

use App\Helpers\RouteCollection;

abstract class Controller
{
	/**
	 * @var RouteCollection
	 */
	protected RouteCollection $routes;

	/**
	 * Folder prefix for view
	 * @var string $folder
	 */
	protected $folder = null;

	/**
	 * @param $routes
	 */
	public function __construct(RouteCollection $routes)
	{
		$this->routes = $routes;
    }

	/**
	 * @param string $view
	 * @param        $variables - key/value pairs
	 * @return mixed
	 */
	public function view(string $view, $variables = [])
	{
		$routes = $this->routes;

		// Load variables for require_once view
		foreach($variables as $name => $data) {
			$$name = $data;
		}

		if(!str_contains($view, '.php')) {
			$view .= '.php';
		}

		if($folder = $this->folder) {
			$view = $folder . DIRECTORY_SEPARATOR . $view;
		}

		return require_once view($view);
	}
}