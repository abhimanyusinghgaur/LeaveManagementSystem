<?php
if(isset($_GET['id']) && !empty($_GET['id'])) {
	require_once '../user/classDatabaseLeaveRequest.php';
	require_once '../user/classDatabaseUser.php';

	$objDatabaseLeaveRequest = new DatabaseLeaveRequest;
	$objDatabaseUser = new DatabaseUser;
	$objLeaveRequestArray = $objDatabaseLeaveRequest->getLeaveRequestsWithId($_GET['id']);
	if($objLeaveRequestArray) {
		foreach ($objLeaveRequestArray as $objLeaveRequest) {
			$leavesRequired = $objLeaveRequest->getLeavesRequired();
			if ($leavesRequired === -1) {
				setError('Invalid Leaves Required.');
			} else if($leavesRequired === 0) {	// if someone asks for a leave only on excluded days from LeaveType
				setError('It was a false request. Didn\'t consume User\'s leaves.');
				if($objDatabaseLeaveRequest->modifyStatus($_GET['id'], 'Granted'))
					setError('Granted the leave request.');
			} else {
				$objUserArray = $objDatabaseUser->getUsersWithUsername($objLeaveRequest->getUsername());
				if($objUserArray) {
					$objUser = $objUserArray[0];	//since username is unique so only one user will be there in result array
					$leavesLeftArray = preg_split('/:|,/', $objUser->getLeavesLeft());
					$length = count($leavesLeftArray);
					$leavesLeft = -1;
					$index = -1;
					for ($i=0; $i <$length ; $i+=2) { 
						if($leavesLeftArray[$i] == $objLeaveRequest->getLeaveType()) {
							$leavesLeft = intval($leavesLeftArray[$i+1]);
							$index = $i+1;
							break;
						}
					}
					if($leavesLeft < 0) {
						setError('User: '.$userName.' does not have access to '.$objLeaveRequest->getLeaveType());
					} else if($leavesLeft < $leavesRequired){
						setError('User: '.$userName.' does not have enough leaves to accomodate his request!');
						if($objDatabaseLeaveRequest->modifyStatus($_GET['id'], 'Rejected')) {
							setError('Rejected the leave request.');
						}
					} else {
						$leavesLeft -= $leavesRequired;
						$leavesLeftArray[$index] = $leavesLeft;
						$userLeaves = "";
						for ($i=0; $i <$length ; $i++) { 
							$userLeaves.=$leavesLeftArray[$i];
							if($i%2==0) {
								$userLeaves.=':';
							} else if ($i!=$length-1) {
								$userLeaves.=',';
							}
						}
						if($objDatabaseLeaveRequest->modifyStatus($_GET['id'], 'Granted')) {
							$objDatabaseUser->modifyLeavesLeft($objUser->getUsername(), $userLeaves);
						}
					}
				} else {
					setError('User: '.$userName.' does not exist!');
				}
			}
		}
	} else {
		setError('There was no such Leave Request!');
	}
}
header('Location: index.php');
?>