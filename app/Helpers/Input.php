<?php

namespace App\Helpers;

use Exception;

class Input
{
	static $errors = true;

	public static function check($arr, $on = false)
	{
		if($on === false) {
			$on = $_REQUEST;
		}
		foreach($arr as $value) {
			if(empty($on[$value])) {
				self::throwError('Data is missing', 900);
			}
		}
	}

	public static function int($val)
	{
		$val = filter_var($val, FILTER_VALIDATE_INT);
		if($val === false) {
			self::throwError('Invalid Integer', 901);
		}

		return $val;
	}

	public static function str($val)
	{
		if(!is_string($val)) {
			self::throwError('Invalid String', 902);
		}

		return trim(htmlspecialchars($val));
	}

	public static function bool($val)
	{
		return filter_var($val, FILTER_VALIDATE_BOOLEAN);
	}

	public static function email($val)
	{
		$val = filter_var($val, FILTER_VALIDATE_EMAIL);
		if($val === false) {
			self::throwError('Invalid Email', 903);
		}

		return $val;
	}

	public static function url($val)
	{
		$val = filter_var($val, FILTER_VALIDATE_URL);
		if($val === false) {
			self::throwError('Invalid URL', 904);
		}

		return $val;
	}

	public static function tooshort($fieldname, $val, $minimum)
	{
		$length = strlen($val);
		if($length < $minimum) {
			// do error handling
		}
	}

	public static function toolong($fieldname, $val, $maximum)
	{
		$length = strlen($val);
		if($length > $maximum) {
			// do error handling
		}
	}

	public static function badcontent($fieldname, $val)
	{
		if(!preg_match("/^[a-zA-Z0-9 '-]*$/", $val)) {
			// do error handling
		}
	}

	public static function throwError($error = 'Error In Processing', $errorCode = 0)
	{
		if(self::$errors === true) {
			throw new Exception($error, $errorCode);
		}
	}
}