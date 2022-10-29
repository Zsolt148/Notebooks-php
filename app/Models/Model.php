<?php 
namespace App\Models;

use Database\Sql;
use App\Interfaces\ModelInterface;
use Exception;

abstract class Model implements ModelInterface
{
	/**
	 * Fillable fields in the database
	 *
	 * @var array
	 */
	protected $fillable = [];

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
	protected $table = null;

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
	public static function query() : static
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
			->query("SELECT * FROM {$this->table} WHERE id = $id")
			->fetch(\PDO::FETCH_ASSOC);
	}

	/**
	 * @param int $id
	 * @return mixed
	 */
	public function findOrFail(int $id)
	{
		$data = $this->find($id);

		abort_if(!$data);

		return $data;
	}

	/**
	 * The insert method.
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
		$this->checkFillableFields($fields);
		// Fields values
		$values = array_values($data);

		// Prepare statement
		$stmt = $this->db()
			->prepare("
				INSERT INTO {$this->table} (" . implode(",", $fields) . ")
				VALUES(" . implode(",", $marks) . ")
			");

		// Execute statement with values
		$stmt->execute($values);

		// Return last inserted ID.
		return $this->db()->lastInsertId();
	}

	/**
	 * The update method.
	 *
	 * @param int $id The ID of the model to be updated.
	 * @param array $data A set of data to be updated to the database.
	 *
	 * @return integer The updated ID
	 */
	public function update(int $id, array $data): int {

		// Fields to be added.
		$set = [];
		$fields = array_keys($data);

		$this->checkFillableFields($fields);

		foreach($fields as $field) {
			$set[] = "$field = :$field";
		}

		// Prepare statement
		$stmt = $this->db()
			->prepare("
				UPDATE {$this->table} SET " . implode(", ", $set) . "
				WHERE id = $id;
			");

		// Execute statement with values
		$stmt->execute($data);

		// Return last updated ID.
		return $this->db()->lastInsertId();
	}

	/**
	 * @param int $id
	 * @return bool
	 */
	public function delete(int $id) : bool
	{
		// Prepare statement
		$stmt = $this->db()
			->prepare("
				DELETE FROM {$this->table}
				WHERE id = $id;
			");

		// Execute statement
		$stmt->execute();

		return true;
	}

	/**
	 * The method return a PDO database connection.
	 *
	 * @return object
	 */
	public function db(): \PDO {
		return static::$db;
	}

	/**
	 * @param array $fields
	 * @return void
	 * @throws Exception
	 */
	private function checkFillableFields(array $fields)
	{
		if(!arrays_equals($this->fillable, $fields)) {
			throw new Exception(
				"Fillable model fields are not same as create/update SQL fields. (Fillable fields: " . implode(', ', $this->fillable) . ")."
			);
		}
	}
}