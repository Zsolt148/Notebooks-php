<?php 
namespace App\Models;

use Database\Sql;
use App\Interfaces\ModelInterface;
use Exception;

abstract class Model implements ModelInterface
{
	/**
	 * It represents a PDO instance
	 *
	 * @var object
	 */
	protected static $db = null;

	/**
	 * The name of the table in the database that the model binds
	 *
	 * @var string
	 */
	protected $table;

	/**
	 * The model construct
	 *
	 */
	public function __construct() {

		if(!$this->table) {
			throw new Exception("Model table is not set");
		}

		if (static::$db === null) {

			$db = new Sql();

			if(!$db->setConnection(DB_HOST, DB_PORT, DB_USER, DB_PASS, DB_NAME)) {
				throw new Exception("Nem sikerült beállítani az adatokat!");
			}

			if(!$db->makeConnection()) {
				throw new Exception("Sikertelen SQL kapcsolodás!");
			}

			static::$db = $db->pdo;
		}
	}

	/**
	 * @return static
	 */
	public static function query()
	{
		return (new static);
	}

	/**
	 * @return int
	 */
	public function getId(): int
	{
		return $this->id;
	}

	/**
	 * Method for getting all records from database.
	 *
	 * @return array
	 */
	public function getAll(): iterable {

		return $this->db()
			->query("SELECT * FROM {$this->table}")
			->fetchAll(\PDO::FETCH_ASSOC);
	}

	/**
	 * @param int $id
	 * @return mixed
	 */
	public function find(int $id)
	{
		return $this->db()
			->query("SELECT * FROM {$this->table} WHERE id=$id")
			->fetch(\PDO::FETCH_ASSOC);
	}

	/**
	 * The insert method.
	 *
	 * This method makes it easy to insert data into the database
	 * in a quick and easy way. The data set must be associative.
	 * Index of array represents the field in the database.
	 *
	 * For example: [ "fist_name" => "John" ]
	 *
	 * @param array $data A set of data to be added to the database.
	 *
	 * @return integer The last insert ID
	 */
	public function insert(array $data): int {

		// Question marks
		$marks = array_fill(0, count($data), '?');
		// Fields to be added.
		$fields = array_keys($data);
		// Fields values
		$values = array_values($data);

		// Prepare statement
		$stmt = $this->db()->prepare("
            INSERT INTO " . $this->table . "(" . implode(",", $fields) . ")
            VALUES(" . implode(",", $marks) . ")
        ");

		// Execute statement with values
		$stmt->execute($values);

		// Return last inserted ID.
		return $this->db()->lastInsertId();
	}

	/**
	 * The method return a PDO database connection.
	 *
	 * @return object
	 */
	public function db(): \PDO {
		return static::$db;
	}
}