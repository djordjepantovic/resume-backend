<?php

namespace Resume\Database;

class QueryBuilder
{
	protected $connection;
	protected $sql;

	public function __construct(\PDO $connection, $table)
	{
		$this->connection = $connection;
		$this->table = $table;
	}

	protected function query($query, $params = array())
	{
		if ($params) {
			$stmt = $this->connection->prepare($query);
			$stmt->execute($params);
		}
		else {
			// $stmt = $this->connection->query($query);
			$stmt = $this->connection->prepare($query);
			$stmt->execute();
		}

		return $stmt->rowCount() ? $stmt : false;
	}

	public function select()
	{
		$this->sql = 'SELECT * FROM '. $this->table;

		return $this;
	}

	public function desc($key)
	{
		$this->sql .= ' ORDER BY '. $key .' DESC';
		return $this;
	}

	public function get()
	{
		return $this->query($this->sql);
	}
}