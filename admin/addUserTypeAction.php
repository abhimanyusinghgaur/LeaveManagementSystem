<?php

require_once 'classUserType.php';
require_once 'classDatabaseUserType.php';

if(isset($_POST['UserType']) && isset($_POST['check_list'])) {
	$objUserType=new UserType;
	$objUserType->setType($_POST['UserType']);
	foreach ($_POST['check_list'] as $checkbox) {
		$objUserType->addAccessibleLeaves($checkbox);
	}

	$objDatabaseUserType=new DatabaseUserType;
	if($objDatabaseUserType->add($objUserType))	//if UserType added successfully to database
		header('Location: index.php?id=viewUserType');	//then redirect to view page
	else											//else, there was an error
		header('Location: index.php?id=addUserType');	//so, stay on same page to show error
	exit();
} else {
	if(!isset($_POST['check_list'])) {
		require_once  '../core.php';
		setError('At least one Leave Type should be accesible.');
		header('Location: index.php?id=addUserType');
		exit();
	}
}

header('Location: index.php');

?>