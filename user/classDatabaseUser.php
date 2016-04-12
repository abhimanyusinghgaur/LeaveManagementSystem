<?php

/**
* 
*/
class DatabaseUser
{
	private $table;
	private $queryParameters;
	public function __construct() {
		$this->table="users";
		$this->queryParameters = "";
	}

	public function add($objUser) {
		require_once '../core.php';
		if(is_object($objUser) && get_class($objUser)=="User") {
			if(!empty($objUser->getName()) && !empty($objUser->getUsername()) && !empty($objUser->getEmail()) && !empty($objUser->getPassword()) && !empty($objUser->getGender()) && !empty($objUser->getType()) && !empty($objUser->getLeavesLeft())) {
				if($this->getUsersWithUsername($objUser->getUsername()) === false) {	//Making sure this user doesn't already exists
					$connect=connectDatabase();
					$query="INSERT INTO `".$this->table."` VALUES ('','".$objUser->getName()."','".$objUser->getUsername()."','".$objUser->getEmail()."','".$objUser->getPassword()."','".$objUser->getGender()."','".$objUser->getType()."','".$objUser->getLeavesLeft()."')";
					if($query_run=mysql_query($query)) {
						mysql_close($connect);
						return true;
					} else {
						mysql_close($connect);
						setError(mysql_error());
					}
				} else {
					setError('User already exists.');
				}
			} else {
				if(empty($objUser->getName()))
					setError('User Name is required');
				if(empty($objUser->getUsername()))
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
		return false;
	}
	public function getUsers() {
		require_once '../core.php';
		require_once 'classUser.php';
		$connect=connectDatabase();
		$query="SELECT * FROM `".$this->table."` ".$this->queryParameters;
		$this->queryParameters = "";
		if($query_run=mysql_query($query)) {
			$query_num_rows=mysql_num_rows($query_run);
			if($query_num_rows>0) {
				$objUserArray=array();
				for($i=0;$i<$query_num_rows;$i++) {
					$objUser=new User;
					$row=mysql_fetch_row($query_run);
					$objUser->setName($row[1]);
					$objUser->setUsername($row[2]);
					$objUser->setEmail($row[3]);
					$objUser->setPassword($row[4]);
					$objUser->setGender($row[5]);
					$objUser->setType($row[6]);
					$objUser->setLeavesLeft($row[7]);
					array_push($objUserArray, $objUser);
				}
				mysql_close($connect);
				return $objUserArray;
			}
		} else {
			setError(mysql_error());
		}
		mysql_close($connect);
		return false;
	}

	public function getUsersWithUsername($Username) {
		if(!empty($Username) && is_string($Username)) {
			$this->queryParameters="WHERE `Username`='".$Username."'";
			return $this->getUsers();
		}
	}
	public function getUsersWithType($Type) {
		if(!empty($Type) && is_string($Type)) {
			$this->queryParameters="WHERE `type`='".$Type."'";
			return $this->getUsers();
		}
	}


	public function modifyLeavesLeft($Username, $LeavesLeft) {
		require_once '../core.php';
		$connect=connectDatabase();
		if(!empty($Username) && !empty($LeavesLeft)) {
			$query="UPDATE `".$this->table."` SET `Leaves_Left`='".$LeavesLeft."' WHERE `Username`='".$Username."'";
			if($query_run=mysql_query($query)) {
				mysql_close($connect);
				return true;
			} else {
				setError(mysql_error());
			}
		} else {
			setError('Improper request to modify LeavesLeft.');
		}
		mysql_close($connect);
		return false;
	}
	public function delUserWithType($type) {
		require_once '../core.php';
		$connect=connectDatabase();
	
		 	$query="DELETE FROM $this->table WHERE Type = '$type'";
				if($query_run=mysql_query($query)) {
					mysql_close($connect);
					return true;
				} else {
					setError(mysql_error());
				}

		mysql_close($connect);
		return false;
	}
}

?>