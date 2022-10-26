<?php

use App\Helpers\Route;

/**
 * @param Route $route
 * @param       $id
 * @return string
 */
function route(Route $route, $id = null) : string
{
 	if(str_contains($route->getPath(), '{id}') !== false) {
 		return str_replace('{id}', $id, $route->getPath());
	}

	return $route->getPath();
}

/**
 * @param $url
 * @param $statusCode
 * @return void
 */
function redirect($url, $statusCode = 303) : void
{
	header('Location: ' . $url, true, $statusCode);
}

/**
 * @param $view
 * @return string
 */
function view($view = null) {
    return APP_ROOT . '/resources/views/' . $view;
}

/**
 * Dump and die
 *
 * @param $data
 * @return void
 */
function dd($data)
{
	echo"<pre>";
	var_dump($data);
	echo"</pre>";

	die();
}

/**
 * @param $code
 * @return string
 */
function abort($code = 404)
{
	http_response_code($code);

	return view($code . ".php");
}