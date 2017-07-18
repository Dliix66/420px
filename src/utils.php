<?php
	function __autoload($class_name) {
		require_once $class_name . '.php';
	}

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
?>