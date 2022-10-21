<?php 
namespace App\Interfaces;

interface ModelInterface
{
    public function getId() : int;

	public function getAll(): iterable;

	public function insert(array $data): int;

	public function db(): \PDO;
}