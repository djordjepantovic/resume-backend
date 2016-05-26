<?php

namespace Resume\Helpers;

class Config
{
	protected $data;
	protected $default;
	protected static $path;

	public static function setUp($path)
	{
		static::$path = file_get_contents($path);
	}

	public static function get($key, $default = null)
	{
		if (!isset($default)) {
			$segments = explode(PHP_EOL, str_replace("\r", '', static::$path));
			$data = [];

			foreach ($segments as $line) {
				if (empty($line)) continue;
				$tmp = explode('=', $line);
				$data[$tmp[0]] = $tmp[1];
				if (isset($data[$key])) return $data[$key];
			}
		}
		
		return $default;
	}
}