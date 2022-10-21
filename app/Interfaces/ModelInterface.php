<?php 
namespace App\Interfaces;

interface ModelInterface
{
	public static function query();

    public function getId() : int;

	public function getAll(): iterable;

	public function find(int $id);

	public function insert(array $data): int;

	public function db(): \PDO;
}