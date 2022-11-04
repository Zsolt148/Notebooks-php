<?php
namespace App\Interfaces;

interface CrudInterface
{
	public function get(): iterable;

	public function find(int $id);

	public function findOrFail(int $id);

	public function insert(array $data): int;

	public function update(int $id, array $data): int;

	public function delete(int $id): bool;
}