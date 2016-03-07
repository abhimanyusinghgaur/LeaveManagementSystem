<?php

class DatabaseUserType
{
	private $table;
	public function __construct() {
		$this->table="usertypes";
	}
	public function add($objUserType) {
		require_once '../core.php';
		$connect=connectDatabase();
		if(is_object($objUserType) && get_class($objUserType)=="UserType") {
			if(!empty($objUserType->getType()) && !empty($objUserType->getAccessibleLeaves())) {
				$query="INSERT INTO `".$this->table."` VALUES ('','".$objUserType->getType()."','".$objUserType->getAccessibleLeaves()."')";
				if($query_run=mysql_query($query)) {
					mysql_close($connect);
					return true;
				} else {
					setError(mysql_error());
				}
			} else {
				if(empty($objUserType->getType()))
					setError('Type Name is required');
				if(empty($objUserType->getAccessibleLeaves()))
					setError('At least one Inclusion is required');
			}
		}
		mysql_close($connect);
		return false;
	}
	public function getUserTypes() {
		require_once '../core.php';
		require_once 'classUserType.php';
		$connect=connectDatabase();
		$query="SELECT * FROM `".$this->table."`";
		if($query_run=mysql_query($query)) {
			$objUserTypeArray=array();
			$query_num_rows=mysql_num_rows($query_run);
			for($i=0;$i<$query_num_rows;$i++) {
				$objUserType=new UserType;
				$row=mysql_fetch_row($query_run);
				$objUserType->setType($row[1]);
				$objUserType->setAccessibleLeaves($row[2]);
				array_push($objUserTypeArray, $objUserType);
			}
			mysql_close($connect);
			return $objUserTypeArray;
		} else {
			setError(mysql_error());
		}
		mysql_close($connect);
		return false;
	}
}

?>