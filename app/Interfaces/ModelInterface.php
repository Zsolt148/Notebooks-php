<?php 
namespace App\Interfaces;

use PDO;

interface ModelInterface
{
	public static function query();

    public function getId() : int;

	public function db(): PDO;
}