<?php

$conn_error = "Database Connection Error!!!";

$mysql_host = 'localhost';
$mysql_user = 'root';
$mysql_pass	= '';
$mysql_db = 'lms';

if (!mysql_connect($mysql_host, $mysql_user, $mysql_pass) or !mysql_select_db($mysql_db)) {
	die($conn_error);
}


?>