<?php
if(isset($_GET['id']) && !empty($_GET['id'])) {
	require_once 'classDatabaseUserType.php';
	require_once '../user/classDatabaseUser.php';
	require_once '../user/classDatabaseLeaveRequest.php';
	
	$objDatabaseUserType = new DatabaseUserType;
	$objDatabaseUser = new DatabaseUser;
	$objDatabaseLeaveRequest = new DatabaseLeaveRequest;
	
	$query = $objDatabaseUserType->del($_GET['id']);

	$userToBeDeleted = $objDatabaseUser->getUsersWithType($_GET['id']);
    foreach ($userToBeDeleted as $user) {
    	$username = $user->getUsername();
    	$query1 = $objDatabaseLeaveRequest->delLeaveWithUser($username);
    }

	$query2 = $objDatabaseUser->delUserWithType($_GET['id']);

	header('Location: index.php?id=viewUserType');

}

?>