<?php

require_once 'classLeaveRequest.php';
require_once 'classDatabaseLeaveRequest.php';
require_once '../core.php';

if(isset($_POST['leaveType']) && isset($_POST['startDate']) && isset($_POST['endDate']) && isset($_POST['reason'])) {
	if(empty($_POST['endDate']) || empty($_POST['startDate'])) {
		setError("Start date and End date both are required.");
		header('Location: index.php?id=newLeave');
		exit();
	} else if(strtotime($_POST['endDate'])-strtotime($_POST['startDate'])<0) {
		setError("Start date should be less than End date.");
		header('Location: index.php?id=newLeave');
		exit();
	}

	$objLeaveRequest=new LeaveRequest;
	$objLeaveRequest->setUsername(getUsername());
	$objLeaveRequest->setLeaveType($_POST['leaveType']);
	$objLeaveRequest->setStartDate($_POST['startDate']);
	$objLeaveRequest->setEndDate($_POST['endDate']);
	$objLeaveRequest->setReason($_POST['reason']);
	$objLeaveRequest->setStatus('Pending');

	//echo $objLeaveRequest->getUsername().'<br>'.$objLeaveRequest->getLeaveType().'<br>'.$objLeaveRequest->getStartDate().'<br>'.$objLeaveRequest->getEndDate().'<br>';

	$objDatabaseLeaveRequest=new DatabaseLeaveRequest;
	if($objDatabaseLeaveRequest->countPendingWithUsername($objLeaveRequest->getUsername())>=1) {
		setError('You can\'t apply for a leave.');
		setError('You already have a leave which is pending');
		header('Location: index.php?id=newLeave');
	} else if($objDatabaseLeaveRequest->add($objLeaveRequest))	//if LeaveRequest added successfully to database
		header('Location: index.php?id=viewLeaveHistory');	//then redirect to view page
	else											//else, there was an error
		header('Location: index.php?id=newLeave');	//so, stay on same page to show error
	exit();
}

//header('Location: index.php');

?>