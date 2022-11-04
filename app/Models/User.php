<?php

namespace App\Models;

use PDO;

class User extends Model
{
	protected $table = 'users';

	protected $fillable = [
		'name',
		'email',
		'password'
	];

	/**
	 * The model construct
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * @param string $email
	 * @param string $password
	 * @return mixed
	 * @throws \Exception
	 */
	public function authenticate(string $email, string $password)
	{
		$email = trim($email);
		$password = trim($password);

		$user = $this->db()
			->query("SELECT * FROM users WHERE email = '$email' AND password = '$password'")
			->fetch(PDO::FETCH_ASSOC);

		return $user;
	}

	/**
	 * @param array $user
	 * @return void
	 */
	public static function setSession(array $user)
	{
		$_SESSION['user_id'] = $user['id'];
		$_SESSION['user_name'] = $user['name'];
		$_SESSION['user_email'] = $user['email'];
	}

	/**
	 * @return void
	 */
	public static function unsetSession()
	{
		unset($_SESSION['user_id']);
		unset($_SESSION['user_name']);
		unset($_SESSION['user_name']);
		session_destroy();
	}
}