<?php

namespace App\Controllers;

use App\Helpers\Input;
use App\Helpers\RouteCollection;
use App\Models\User;
use Exception;

class AuthenticateController extends Controller
{
	/**
	 * @param RouteCollection $routes
	 */
	public function __construct(RouteCollection $routes)
	{
		parent::__construct($routes);
	}

	public function index()
	{
		if(isset($_SESSION['user_id'])) {
			return redirect(route($this->routes->get('home')));
		}

		return $this->view('login');
	}

	public function login()
	{
		$post = $_POST;

		try {
			Input::check([
				'email',
				'password',
			], $post);

			Input::email($post['email']);
			Input::str($post['password']);

			$user = User::query()
				->authenticate($post['email'], $post['password']);

			if(!$user) {
				Input::throwError('Email or password is incorrect');
			}

			User::setSession($user);

		} catch(Exception $e) {
			return $this->view('login', [
				'errors' => $e->getMessage()
			]);
		}

		return redirect(route($this->routes->get('home')));
	}

	public function logout()
	{
		User::unsetSession();

		return redirect(route($this->routes->get('home')));
	}
}