<?php

use App\Helpers\Route;

function app($class)
{
	//TODO make reflection class to resolve dependecies
}

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
function redirect($url, $params = []) : void
{
	if(!empty($params)) {
		// TODO make these POST params not GET
		$url .= '?' . http_build_query($params);
	}

	header('Location: ' . $url, true, 303);
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

	die();

	// TODO fix me: return 404.php with routes
	// return require_once abort() where used
	//return view($code . ".php");
}

/**
 * @param $boolean
 * @param $code
 * @return string|void
 */
function abort_if($boolean, $code = 404)
{
	if($boolean) {
		return abort($code);
	}
}

function isUrl($url)
{

}

/**
 * @param array $a
 * @param array $b
 * @return bool
 */
function arrays_equals(array $a, array $b) {
	return (
		count($a) == count($b)
		&& array_diff($a, $b) === array_diff($b, $a)
	);
}