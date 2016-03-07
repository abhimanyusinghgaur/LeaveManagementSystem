<?php

ob_start();
session_start();
$current_file=$_SERVER['SCRIPT_NAME'];

function connectDatabase() {
	$conn_error = "Database Connection Error!!!";

	$mysql_host = 'localhost';
	$mysql_user = 'root';
	$mysql_pass	= '';
	$mysql_db = 'lms';

	$connect=mysql_connect($mysql_host, $mysql_user, $mysql_pass);
	if (!$connect or !mysql_select_db($mysql_db)) {
		die($conn_error);
	}
	return $connect;
}
function userIsLoggedIn() {
	if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
		return true;
	}
	else {
		return false;
	}
}

function adminIsLoggedIn() {
	if(isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id'])) {
		return true;
	}
	else {
		return false;
	}
}

function getUsername() {
	if(isset($_SESSION['username']) && !empty($_SESSION['username'])) {
		return $_SESSION['username'];
	}
	else {
		return NULL;
	}
}

function getError() {
	if(isset($_SESSION['error']) && !empty($_SESSION['error'])) {
		return $_SESSION['error'];
	}
	else {
		return NULL;
	}
}

function setError($error) {
	if(isset($_SESSION['error']) && !empty($_SESSION['error'])) {
		$_SESSION['error'].='<br>'.$error;
	}
	else {
		$_SESSION['error']=$error;
	}
}

function resetError() {
	unset($_SESSION['error']);
}

?>