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
	];

	/**
	 * The model construct
	 *
	 */
	public function __construct() {
		parent::__construct();
	}
}