<?php

namespace App\Helpers;

use App\Models\User;

class Auth
{
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
}