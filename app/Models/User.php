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
}