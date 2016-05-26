<?php

namespace Resume\Core;

use Resume\Database\Connection;
use Resume\Database\QueryBuilder;

abstract class Model
{
 	protected $table;
 	private $db;

 	public function __construct($table)
 	{
 		$this->table = $table;
 	}

 	public function getConnection()
	{
		return Connection::getConnection();
	}

	public static function all($table)
	{
		return (new static($table))->newQuery()->select();
	}

	public function newQuery()
	{
		$conn = $this->getConnection();
		$table = $this->getTable();

		return new QueryBuilder($conn, $table);
	}

 	public function getTable()
	{
		if (isset($this->table)) return $this->table;
	}
}