<?php
if(isset($_GET['id']) && !empty($_GET['id'])) {
	require_once '../user/classDatabaseLeaveRequest.php';
	$objDatabaseLeaveRequest = new DatabaseLeaveRequest;
	$objDatabaseLeaveRequest->modifyStatus($_GET['id'], 'Rejected');
}
header('Location: index.php');
?>