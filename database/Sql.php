<?php

namespace Database;

use PDOException;

class Sql
{
	private $sql_host;
	private $sql_port;
	private $sql_user;
	private $sql_pass;
	private $sql_datab;

	public $pdo;

	public function setConnection($sql_host, $sql_port, $sql_user, $sql_pass, $sql_datab) {
		$this->sql_host = $sql_host;
		$this->sql_port = $sql_port;
		$this->sql_user = $sql_user;
		$this->sql_pass = $sql_pass;
		$this->sql_datab = $sql_datab;
		return true;
	}

	public function makeConnection() {

		$dsn = 'mysql:host=' . $this->sql_host . ';port=' . $this->sql_port . ';dbname=' . $this->sql_datab . '';
		$username = $this->sql_user;
		$password = $this->sql_pass;

		try {
			$this->pdo = new \PDO($dsn, $username, $password);
			$this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

			return true;

		} catch(PDOException $e) {
			return false;
		}
	}
}

?>