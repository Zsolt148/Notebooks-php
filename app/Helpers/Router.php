<?php

namespace App\Helpers;

class Router
{
	/**
	 * @param RouteCollection $routes
	 * @return mixed|void
	 */
	public function __invoke(RouteCollection $routes)
	{
		$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

		$id = (int)filter_var($uri, FILTER_SANITIZE_NUMBER_INT);
		$routeName = preg_replace('/[0-9]+/', '{id}', $uri);

		if($route = $routes->get(name: $routeName)) { // Route instance
			return $route->handle($routes, $id);
		}

		return abort();
	}
}