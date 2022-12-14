<?php

namespace App\Helpers;

use App\Models\User;

class Auth
{
	/**
	 * @return static
	 */
	public static function make()
	{
		return (new static);
	}

	/**
	 * @return bool
	 */
	public static function check()
	{
		return isset($_SESSION['user_id']);
	}

	/**
	 * @return int
	 */
	public static function id()
	{
		if(self::check()) {
			return (int) $_SESSION['user_id'];
		}

		return null;
	}

	/**
	 * @return object|null
	 */
	public static function user() : ?object
	{
		if(self::check()) {
			return (object) User::query()->find(self::id());
		}

		return null;
	}

	/**
	 * @param array $user
	 * @return void
	 */
	public static function setSession(array $user) : void
	{
		$_SESSION['user_id'] = $user['id'];
		$_SESSION['user_name'] = $user['name'];
		$_SESSION['user_email'] = $user['email'];
	}

	/**
	 * @return void
	 */
	public static function unsetSession() : void
	{
		unset($_SESSION['user_id']);
		unset($_SESSION['user_name']);
		unset($_SESSION['user_name']);
		session_destroy();
	}
}