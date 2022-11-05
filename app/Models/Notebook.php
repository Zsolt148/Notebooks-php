<?php 

namespace App\Models;

/**
 * App\Models\Notebook
 *
 * @property string $manufacturer
 * @property string $type
 * @property string $display
 * @property int $memory
 * @property int $opsystem_id
 */
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