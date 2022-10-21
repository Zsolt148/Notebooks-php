<?php

namespace App\Controllers;

use Symfony\Component\Routing\RouteCollection;

class HomeController extends Controller
{
	public function index(RouteCollection $routes)
	{
		return require_once view('home.php');
	}
}