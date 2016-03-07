<?php

require_once '../core.php';

if(isset($_POST['username']) && isset($_POST['password'])) {
	$username=htmlentities($_POST['username']);
	$password=htmlentities($_POST['password']);

	//$password=md5($password);

	$connect=connectDatabase();

	if(!empty($username) && !empty($password)) {
		$query="SELECT `id` FROM `admins` WHERE `username`='$username' AND `password`='$password'";
		if($query_run=mysql_query($query)) {
			$query_num_rows=mysql_num_rows($query_run);

			if($query_num_rows==0) {
				setError('Invalid Username or Password.');
			} else if($query_num_rows==1) {
				$admin_id=mysql_result($query_run,0,'id');
				$_SESSION['admin_id']=$admin_id;
				$_SESSION['username']=$username;
			} else {
				setError('Ambiguity in Login.');
			}
		} else {
			setError(mysql_error());
		}
	} else {
		setError('You must enter both Username and Password.');
	}
	mysql_close($connect);
}

header('Location: index.php');

?>