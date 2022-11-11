<?php
// Do not push changes to git

//Site name
define('SITE_NAME', 'Notebooks-php');

$documentRoot = null;

if (isset($_SERVER['DOCUMENT_ROOT'])) {
	$documentRoot = $_SERVER['DOCUMENT_ROOT'];

	if (strstr($documentRoot, '/') || strstr($documentRoot, '\\')) {
		if (strstr($documentRoot, '/')) {
			$documentRoot = str_replace('/', DIRECTORY_SEPARATOR, $documentRoot);
		}
		elseif (strstr($documentRoot, '\\')) {
			$documentRoot = str_replace('\\', DIRECTORY_SEPARATOR, $documentRoot);
		}
	}

	if (preg_match('/[^\\/]{1}\\[^\\/]{1}/', $documentRoot)) {
		$documentRoot = preg_replace('/([^\\/]{1})\\([^\\/]{1})/', '\\1DIR_SEP\\2', $documentRoot);
		$documentRoot = str_replace('DIR_SEP', '\\\\', $documentRoot);
	}

	// For windows
	if(str_contains($documentRoot, '\\public')) {
		$documentRoot = str_replace('\\public', '', $documentRoot);
	}
}
dd($documentRoot);

define('SERVER_DOC_ROOT', $documentRoot);
//App Root
define('APP_ROOT', dirname(dirname(__FILE__)));
define('URL_ROOT', '/');
define('URL_SUBFOLDER', '');

//DB Params
define('DB_HOST', 'localhost');
define('DB_PORT', '8080');
define('DB_NAME', 'notebooks');
define('DB_USER', 'admin');
define('DB_PASS', '');