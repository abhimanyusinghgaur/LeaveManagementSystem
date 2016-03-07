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
}

?>