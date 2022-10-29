<?php 
namespace App\Interfaces;

interface ModelInterface
{
	public static function query() : static;

    public function getId() : int;

	public function getAll(): iterable;

	public function find(int $id);

	public function findOrFail(int $id);

	public function insert(array $data): int;

	public function update(int $id, array $data): int;

	public function delete(int $id): bool;

	public function db(): \PDO;
}