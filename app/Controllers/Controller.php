<?php

namespace App\Controllers;

use App\Helpers\RouteCollection;

abstract class Controller
{
	protected RouteCollection $routes;

	/**
	 * @param $routes
	 */
	public function __construct(RouteCollection $routes)
	{
		$this->routes = $routes;
    }

	/**
	 * @param string $view
	 * @param        $variables
	 * @return mixed
	 */
	public function view(string $view, $variables = [])
	{
		$routes = $this->routes;

		// Load variables for require_once view
		foreach($variables as $name => $data) {
			$$name = $data;
		}

		return require_once view($view);
	}
}