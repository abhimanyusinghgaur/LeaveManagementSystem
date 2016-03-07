<?php

/**
* 
*/
class DatabaseUser
{
	private $table;
	public function __construct() {
		$this->table="user";
	}
	public function add($objUser) {
		require_once '../core.php';
		$connect=connectDatabase();
		if(is_object($objUser) && get_class($objUser)=="User") {
			if(!empty($objUser->getName()) && !empty($objUser->getId()) && !empty($objUser->getEmail()) && !empty($objUser->getPassword()) && !empty($objUser->getGender()) && !empty($objUser->getType()) && !empty($objUser->getLeavesLeft())) {
				$query="INSERT INTO `".$this->table."` VALUES ('','".$objUser->getName()."','".$objUser->getId()."','".$objUser->getEmail()."','".$objUser->getPassword()."','".$objUser->getGender()."','".$objUser->getType()."','".$objUser->getLeavesLeft()."')";
				if($query_run=mysql_query($query)) {
					mysql_close($connect);
					return true;
				} else {
					setError(mysql_error());
				}
			} else {
				if(empty($objUser->getName()))
					setError('User Name is required');
				if(empty($objUser->getId()))
					setError('Id is required');
				if(empty($objUser->getEmail()))
					setError('Email is required');
				if(empty($objUser->getPassword()))
					setError('Password is required');
				if(empty($objUser->getGender()))
					setError('Gender is required');
				if(empty($objUser->getType()))
					setError('User Type is required');
				if(empty($objUser->getLeavesLeft()))
					setError('Leaves Left is required');
			}
		}/* else {
			setError(is_object($objUser).'<br>class:'.get_class($objUser));
		}*/
		mysql_close($connect);
		return false;
	}
	public function getUsers() {
		require_once '../core.php';
		require_once 'classUser.php';
		$connect=connectDatabase();
		$query="SELECT * FROM `".$this->table."`";
		if($query_run=mysql_query($query)) {
			$objUserArray=array();
			$query_num_rows=mysql_num_rows($query_run);
			for($i=0;$i<$query_num_rows;$i++) {
				$objUser=new User;
				$row=mysql_fetch_row($query_run);
				$objUser->setName($row[1]);
				$objUser->setId($row[2]);
				$objUser->setEmail($row[3]);
				$objUser->setPassword($row[4]);
				$objUser->setGender($row[5]);
				$objUser->setType($row[6]);
				$objUser->setLeavesLeft($row[7]);
				array_push($objUserArray, $objUser);
			}
			mysql_close($connect);
			return $objUserArray;
		} else {
			setError(mysql_error());
		}
		mysql_close($connect);
		return false;
	}
}

?>