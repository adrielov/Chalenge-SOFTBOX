<?php
namespace App\Helpers;

class Request {
	public static function get($key = null) {
		if(isset($key) && $key !== null) {
			return (isset($_REQUEST[$key]))? $_REQUEST[$key] : false;
		}
		return $_REQUEST;
	}

	public static function check(array $required , $method  = false) {
		switch ($method) {
			case 'POST':
				$method = $_POST;
			break;
			default:
				$method = $_GET;
		}

		$status = false;
		foreach($required as $field) {
			if (isset($_REQUEST[$field][1]) && !empty($_REQUEST[$field])) {
				$status = true;
			} else {
				$status = false;
			}
		}
		if(count($method) > 1 && !empty($method)) {
			$status = true;
		} else {
			$status  =false;
		}
		
		return $status;
	}
}