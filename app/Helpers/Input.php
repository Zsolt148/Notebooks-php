<?php

namespace App\Helpers;

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

	static function int($val)
	{
		$val = filter_var($val, FILTER_VALIDATE_INT);
		if($val === false) {
			self::throwError('Invalid Integer', 901);
		}

		return $val;
	}

	static function str($val)
	{
		if(!is_string($val)) {
			self::throwError('Invalid String', 902);
		}

		return trim(htmlspecialchars($val));
	}

	static function bool($val)
	{
		return filter_var($val, FILTER_VALIDATE_BOOLEAN);
	}

	static function email($val)
	{
		$val = filter_var($val, FILTER_VALIDATE_EMAIL);
		if($val === false) {
			self::throwError('Invalid Email', 903);
		}

		return $val;
	}

	static function url($val)
	{
		$val = filter_var($val, FILTER_VALIDATE_URL);
		if($val === false) {
			self::throwError('Invalid URL', 904);
		}

		return $val;
	}

	static function tooshort($fieldname, $val, $minimum)
	{
		$length = strlen($val);
		if($length < $minimum) {
			// do error handling
		}
	}

	static function toolong($fieldname, $val, $maximum)
	{
		$length = strlen($val);
		if($length > $maximum) {
			// do error handling
		}
	}

	static function badcontent($fieldname, $val)
	{
		if(!preg_match("/^[a-zA-Z0-9 '-]*$/", $val)) {
			// do error handling
		}
	}

	static function throwError($error = 'Error In Processing', $errorCode = 0)
	{
		if(self::$errors === true) {
			throw new Exception($error, $errorCode);
		}
	}
}