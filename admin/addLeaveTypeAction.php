<?php

require_once 'classLeaveType.php';
require_once 'classDatabaseLeaveType.php';

if(isset($_POST['leaveName']) && isset($_POST['abbreviation']) && isset($_POST['numLeaves']) && isset($_POST['check_list'])) {
	$objLeaveType=new LeaveType;
	$objLeaveType->setLeaveName($_POST['leaveName']);
	$objLeaveType->setAbbreviation($_POST['abbreviation']);
	$objLeaveType->setNumLeaves($_POST['numLeaves']);
	foreach ($_POST['check_list'] as $checkbox) {
		$objLeaveType->addInclusions($checkbox);
	}

	$objDatabaseLeaveType=new DatabaseLeaveType;
	if($objDatabaseLeaveType->add($objLeaveType))	//if LeaveType added successfully to database
		header('Location: index.php?id=viewLeaveType');	//then redirect to view page
	else											//else, there was an error
		header('Location: index.php?id=addLeaveType');	//so, stay on same page to show error
	exit();
}

header('Location: index.php');

?>