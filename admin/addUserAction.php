<?php

require_once '../user/classUser.php';
require_once '../user/classDatabaseUser.php';
require_once 'classDatabaseUserType.php';
require_once 'classDatabaseLeaveType.php';


if(isset($_POST['Name']) && isset($_POST['Username']) && isset($_POST['Email']) && isset($_POST['Gender']) && isset($_POST['UserType'])) {
	$objUser=new User;
	$objUser->setName($_POST['Name']);
	$objUser->setUsername($_POST['Username']);
	$objUser->setEmail($_POST['Email']);
	$objUser->setPassword($_POST['Username']);	//Password for new user is Username by default
	$objUser->setGender($_POST['Gender']);
	$objUser->setType($_POST['UserType']);

	$objDatabaseUserType=new DatabaseUserType;
	$objUserTypeArray=$objDatabaseUserType->getUserTypes();
	foreach ($objUserTypeArray as $objUserType) {
		if($objUser->getType()==$objUserType->getType()) {
			$AccessibleLeavesArray=explode(",",$objUserType->getAccessibleLeaves());
			$objDatabaseLeaveType=new DatabaseLeaveType;
			$objLeaveTypeArray=$objDatabaseLeaveType->getLeaveTypes();
			foreach ($AccessibleLeavesArray as $AccessibleLeave) {
				foreach ($objLeaveTypeArray as $objLeaveType) {
					if($AccessibleLeave==$objLeaveType->getLeaveName())
						$objUser->addLeavesLeft($AccessibleLeave.':'.$objLeaveType->getNumLeaves());
				}
			}
			break;
		}
	}
	
	$objDatabaseUser=new DatabaseUser;
	if($objDatabaseUser->add($objUser))	//if User added successfully to database
		header('Location: index.php?id=viewUser');	//then redirect to view page
	else											//else, there was an error
		header('Location: index.php?id=addUser');	//so, stay on same page to show error
	exit();
}

header('Location: index.php');

?>