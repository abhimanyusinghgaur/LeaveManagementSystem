<?php

/**
* 
*/
class DatabaseLeaveRequest
{
	private $table;
	private $queryParameters;
	
	public function __construct() {
		$this->table="leaveRequests";
		$this->queryParameters="";
	}

	public function add($objLeaveRequest) {
		require_once '../core.php';
		$connect=connectDatabase();
		if(is_object($objLeaveRequest) && get_class($objLeaveRequest)=="LeaveRequest") {
			if(!empty($objLeaveRequest->getUsername()) && !empty($objLeaveRequest->getLeaveType()) && !empty($objLeaveRequest->getStartDate()) && !empty($objLeaveRequest->getEndDate()) && !empty($objLeaveRequest->getReason()) && !empty($objLeaveRequest->getStatus())) {
				$query="INSERT INTO `".$this->table."` VALUES ('','".$objLeaveRequest->getUsername()."','".$objLeaveRequest->getLeaveType()."','".$objLeaveRequest->getStartDate()."','".$objLeaveRequest->getEndDate()."','".$objLeaveRequest->getReason()."','".$objLeaveRequest->getStatus()."')";
				if($query_run=mysql_query($query)) {
					mysql_close($connect);
					return true;
				} else {
					setError(mysql_error());
				}
			} else {
				if(empty($objLeaveRequest->getUsername()))
					setError('Username is required');
				if(empty($objLeaveRequest->getLeaveType()))
					setError('Leave Type is required');
				if(empty($objLeaveRequest->getStartDate()))
					setError('Start date is required');
				if(empty($objLeaveRequest->getEndDate()))
					setError('End date is required');
				if(empty($objLeaveRequest->getReason()))
					setError('Reason is required');
				if(empty($objLeaveRequest->getStatus()))
					setError('Status is required');
			}
		}/* else {
			setError(is_object($objLeaveRequest).'<br>class:'.get_class($objLeaveRequest));
		}*/
		mysql_close($connect);
		return false;
	}

	public function getLeaveRequests() {
		require_once '../core.php';
		require_once 'classLeaveRequest.php';
		$connect=connectDatabase();
		$query="SELECT * FROM `".$this->table."` ".$this->queryParameters;
		if($query_run=mysql_query($query)) {
			$objLeaveRequestArray=array();
			$query_num_rows=mysql_num_rows($query_run);
			for($i=0;$i<$query_num_rows;$i++) {
				$objLeaveRequest=new LeaveRequest;
				$row=mysql_fetch_row($query_run);				
				$objLeaveRequest->setid($row[0]);
				$objLeaveRequest->setUsername($row[1]);
				$objLeaveRequest->setLeaveType($row[2]);
				$objLeaveRequest->setStartDate($row[3]);
				$objLeaveRequest->setEndDate($row[4]);
				$objLeaveRequest->setReason($row[5]);
				$objLeaveRequest->setStatus($row[6]);
				array_push($objLeaveRequestArray, $objLeaveRequest);
			}
			$this->queryParameters="";
			mysql_close($connect);
			return $objLeaveRequestArray;
		} else {
			setError(mysql_error());
		}
		mysql_close($connect);
		return false;
	}

	public function getLeaveRequestsWithId($id) {
		if(!empty($id) && is_numeric($id)) {
			$this->queryParameters="WHERE `id`='".$id."'";
			return $this->getLeaveRequests();
		}
	}

	public function getLeaveRequestsWithStatus($status) {
		if(!empty($status) && is_string($status)) {
			$this->queryParameters="WHERE `Status`='".$status."'";
			return $this->getLeaveRequests();
		}
	}

	public function modifyStatus($id, $status) {
		require_once '../core.php';
		$connect=connectDatabase();
		if(!empty($id) && !empty($status)) {
			$query="UPDATE `".$this->table."` SET `Status`='".$status."' WHERE `id`='".$id."'";
			if($query_run=mysql_query($query)) {
				mysql_close($connect);
				return true;
			} else {
				setError(mysql_error());
			}
		} else {
			setError('Improper request to modify leave status.');
		}
		mysql_close($connect);
		return false;
	}

	public function countPending() {
		require_once '../core.php';
		$connect = connectDatabase();
		$query = "SELECT COUNT(*) FROM `leaverequests` WHERE `Status`='Pending'";
		if($query_run = mysql_query($query)) {
			$row=mysql_fetch_row($query_run);
			mysql_close($connect);
			return $row[0];
		} else {
			setError(mysql_error());
		}
		mysql_close($connect);
		return false;
	}
}

?>