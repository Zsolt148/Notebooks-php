<?php

namespace App\Helpers;

class Route
{
	public string $path = '/';
	private $controller = null;
	private $method = null;

	/**
	 * @param string $path
	 * @param array  $action
	 */
	public function __construct(string $path = '/', array $action = [])
	{
		$this->path = $path;
		$this->controller = $action[0];
		$this->method = $action[1];
	}

	/**
	 * @param RouteCollection $routes
	 * @param                 ...$args
	 * @return void
	 */
	public function handle(RouteCollection $routes, ...$args)
	{
		$controller = new ($this->controller)($routes);

		//call_user_func([$controller, $this->method], $args);
		call_user_func_array([$controller, $this->method], $args);
	}

	/**
	 * @return string
	 */
	public function getPath() : string
	{
		return $this->path;
	}

	/**
	 * @param string $path
	 * @return $this
	 */
	public function setPath(string $path) : self
	{
		$this->path = $path;

		return $this;
	}
}