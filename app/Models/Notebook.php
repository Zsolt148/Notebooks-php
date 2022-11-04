<?php 

namespace App\Models;

class Notebook extends Model
{
	protected $table = "notebooks";

	protected $fillable = [
		'manufacturer',
		'type',
		'display',
		'memory',
		'opsystem_id'
	];

	/**
	 * The model construct
	 */
	public function __construct() {
		parent::__construct();
	}
}