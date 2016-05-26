<?php

namespace Resume\Database;

use Resume\Helpers\Config;
use PDO;

class Connection
{
	private static $instance = null;

	private function __construct()
	{
		try {
			$options = [
				PDO::ATTR_DEFAULT_FETCH_MODE => Config::get('DB_FETCH', PDO::FETCH_OBJ),
				PDO::ATTR_ERRMODE => Config::get('DB_ERRMODE')
			];

			self::$instance = new PDO('mysql:host='. Config::get('DB_HOST') .';dbname='.
									  Config::get('DB_DATABASE') .';charset='. Config::get('DB_CHARSET'),
									  Config::get('DB_USERNAME'), Config::get('DB_PASSWORD'), $options);
		} catch (PDOException $e) {
			// dump('Database error: ' . $e->getMessage());
			file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
		}
	}


	public static function getConnection()
    {
		// Guarantees single instance, if no connection object exists then create one
		if (!self::$instance) {
			new Connection();
		}
		
		return self::$instance;
	}
}