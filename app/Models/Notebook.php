<?php 

namespace App\Models;

class Notebook extends Model
{
	protected $table = "notebooks";

	/**
	 * The model construct
	 *
	 */
	public function __construct() {

		/**
		 * The database table name.
		 */
		parent::__construct();
	}

	public function getAll(): iterable
	{
		return $this->db()
			->query("SELECT * FROM {$this->table}")
			->fetchAll(\PDO::FETCH_ASSOC);
	}
}