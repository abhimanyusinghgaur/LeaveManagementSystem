<?php

/**
* 
*/
class DatabaseLeaveType
{
	private $table;
	
	public function __construct() {
		$this->table="leavetypes";
	}
	
	public function add($objLeaveType) {
		require_once '../core.php';
		$connect=connectDatabase();
		if(is_object($objLeaveType) && get_class($objLeaveType)=="LeaveType") {
			if(!empty($objLeaveType->getLeaveName()) && !empty($objLeaveType->getAbbreviation()) && !empty($objLeaveType->getNumLeaves()) && !empty($objLeaveType->getInclusions())) {
				$query="INSERT INTO `".$this->table."` VALUES ('','".$objLeaveType->getLeaveName()."','".$objLeaveType->getAbbreviation()."','".$objLeaveType->getNumLeaves()."','".$objLeaveType->getInclusions()."')";
				if($query_run=mysql_query($query)) {
					mysql_close($connect);
					return true;
				} else {
					setError(mysql_error());
				}
			} else {
				if(empty($objLeaveType->getLeaveName()))
					setError('Leave Name is required');
				if(empty($objLeaveType->getAbbreviation()))
					setError('Abbreviation is required');
				if(empty($objLeaveType->getNumLeaves()))
					setError('Number of Leaves is required');
				if(empty($objLeaveType->getInclusions()))
					setError('At least one Inclusion is required');
			}
		}
		mysql_close($connect);
		return false;
	}

	public function getLeaveTypes() {
		require_once '../core.php';
		require_once 'classLeaveType.php';
		$connect=connectDatabase();
		$query="SELECT * FROM `".$this->table."`";
		if($query_run=mysql_query($query)) {
			$objLeaveTypeArray=array();
			$query_num_rows=mysql_num_rows($query_run);
			for($i=0;$i<$query_num_rows;$i++) {
				$objLeaveType=new LeaveType;
				$row=mysql_fetch_row($query_run);
				$objLeaveType->setLeaveName($row[1]);
				$objLeaveType->setAbbreviation($row[2]);
				$objLeaveType->setNumLeaves($row[3]);
				$objLeaveType->setInclusions($row[4]);
				array_push($objLeaveTypeArray, $objLeaveType);
			}
			mysql_close($connect);
			return $objLeaveTypeArray;
		} else {
			setError(mysql_error());
		}
		mysql_close($connect);
		return false;
	}

	public function getLeaveTypeWithLeaveName($LeaveName) {
		require_once '../core.php';
		require_once 'classLeaveType.php';
		$connect=connectDatabase();
		$query="SELECT * FROM `".$this->table."` WHERE `leaveName`='".$LeaveName."'";
		if($query_run=mysql_query($query)) {
			$objLeaveType=new LeaveType;
			$row=mysql_fetch_row($query_run);
			$objLeaveType->setLeaveName($row[1]);
			$objLeaveType->setAbbreviation($row[2]);
			$objLeaveType->setNumLeaves($row[3]);
			$objLeaveType->setInclusions($row[4]);
			mysql_close($connect);
			return $objLeaveType;
		} else {
			setError(mysql_error());
		}
		mysql_close($connect);
		return false;
	}
}

?>