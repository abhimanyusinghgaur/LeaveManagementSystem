<?php

require_once 'classUser.php';
require_once 'classDatabaseUser.php';

if(isset($_POST['Name']) && isset($_POST['Id']) && isset($_POST['Email']) && isset($_POST['Password']) && isset($_POST['Gender']) && isset($_POST['Type']) && isset($_POST['LeavesLeft'])) {
	$objUser=new User;
	$objUser->setName($_POST['Name']);
	$objUser->setId($_POST['Id']);
	$objUser->setEmail($_POST['Email']);
	$objUser->setPassword($_POST['Password']);
	$objUser->setGender($_POST['Gender']);
	$objUser->setType($_POST['Type']);
	$objUser->setLeavesLeft($_POST['LeavesLeft']);
	
	$objDatabaseUser=new DatabaseUser;
	if($objDatabaseUser->add($objUser))	//if User added successfully to database
		header('Location: index.php?id=viewUser');	//then redirect to view page
	else											//else, there was an error
		header('Location: index.php?id=addUser');	//so, stay on same page to show error
	exit();
}

header('Location: index.php');

?>