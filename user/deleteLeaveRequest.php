<?php
if(isset($_GET['id']) && !empty($_GET['id'])) {
	require_once '../user/classLeaveRequest.php';
	require_once '../user/classDatabaseLeaveRequest.php';
	
	$objDatabaseLeaveRequest = new DatabaseLeaveRequest;
	$LeaveRequest = new LeaveRequest;
	
	
	$query = $objDatabaseLeaveRequest->delLeaveWithId($_GET['id']);

	
	header('Location: index.php?id=viewLeaveHistory');

}

?>