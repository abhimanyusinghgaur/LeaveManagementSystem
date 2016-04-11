<?php

class DatabaseUserType
{
	private $table;
	public function __construct() {
		$this->table="usertypes";
	}
	public function add($objUserType) {
		require_once '../core.php';
		if(is_object($objUserType) && get_class($objUserType)=="UserType") {
			if(!empty($objUserType->getType()) && !empty($objUserType->getAccessibleLeaves())) {
				if($this->getUserTypeWithType($objUserType->getType()) === false) {	//Making sure this leavetype desn't alrady exist
					$connect=connectDatabase();
					$query="INSERT INTO `".$this->table."` VALUES ('','".$objUserType->getType()."','".$objUserType->getAccessibleLeaves()."')";
					if($query_run=mysql_query($query)) {
						mysql_close($connect);
						return true;
					} else {
						mysql_close($connect);
						setError(mysql_error());
					}
				} else {
					setError('UserType already exists');
				}
			} else {
				if(empty($objUserType->getType()))
					setError('Type Name is required');
				if(empty($objUserType->getAccessibleLeaves()))
					setError('At least one Inclusion is required');
			}
		}
		return false;
	}

	public function getUserTypes() {
		require_once '../core.php';
		require_once 'classUserType.php';
		$connect=connectDatabase();
		$query="SELECT * FROM `".$this->table."`";
		if($query_run=mysql_query($query)) {
			$query_num_rows=mysql_num_rows($query_run);
			if($query_num_rows>0) {
				$objUserTypeArray=array();
				for($i=0;$i<$query_num_rows;$i++) {
					$objUserType=new UserType;
					$row=mysql_fetch_row($query_run);
					$objUserType->setType($row[1]);
					$objUserType->setAccessibleLeaves($row[2]);
					array_push($objUserTypeArray, $objUserType);
				}
				mysql_close($connect);
				return $objUserTypeArray;
			}
		} else {
			setError(mysql_error());
		}
		mysql_close($connect);
		return false;
	}

	public function getUserTypeWithType($Type) {
		require_once '../core.php';
		require_once 'classUserType.php';
		$connect=connectDatabase();
		$query="SELECT * FROM `".$this->table."` WHERE `type`='".$Type."'";
		if($query_run=mysql_query($query)) {
			$query_num_rows=mysql_num_rows($query_run);
			if($query_num_rows>0) {
				$objUserType=new UserType;
				$row=mysql_fetch_row($query_run);
				$objUserType->setType($row[1]);
				$objUserType->setAccessibleLeaves($row[2]);
				mysql_close($connect);
				return $objUserType;
			}
		} else {
			setError(mysql_error());
		}
		mysql_close($connect);
		return false;
	}
}

?>