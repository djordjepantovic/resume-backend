<?php

namespace Resume\Helpers;

class Ajax
{
	public static function isXHR()
	{
		return (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
	}

	public static function jsonSuccess($data)
	{
		self::jsonStatus($data);
	}

	public static function jsonError($data)
	{
		self::jsonStatus($data, false);
	}

	private static function jsonStatus($data, $success = true)
	{
		header('Content-Type: application/json');
	    echo json_encode(['success' => $success, 'data' => $data]);
	    exit();
	}
}