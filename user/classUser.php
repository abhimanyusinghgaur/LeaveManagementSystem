<?php

/**
* class User handles the various types of Users
*/
class User
{
	private $Name;
	private $Username;
	private $Email;
	private $Password;
	private $Gender;
	private $Type;
	private $LeavesLeft;
	public function getName()
	{
		return $this->Name;
	}
	public function setName($Name)
	{
		$this->Name=htmlentities($Name);
	}
	public function getUsername()
	{
		return $this->Username;
	}
	public function setUsername($Username)
	{
		$this->Username=htmlentities($Username);
	}
	public function getEmail()
	{
		return $this->Email;
	}
	public function setEmail($Email)
	{
		$this->Email=htmlentities($Email);
	}
	public function getPassword()
	{
		return $this->Password;
	}
	public function setPassword($Password)
	{
		if(!empty($Password)) {
			$this->Password=htmlentities($Password);
		}
	}

	public function getGender()
	{
		return $this->Gender;
	}
	public function setGender($Gender)
	{
		if(!empty($Gender)) {
			$this->Gender=htmlentities($Gender);
		}
	}
	public function getType()
	{
		return $this->Type;
	}
	public function setType($Type)
	{
		if(!empty($Type)) {
			$this->Type=htmlentities($Type);
		}
	}

	public function getLeavesLeft()
	{
		return $this->LeavesLeft;
	}
	public function setLeavesLeft($LeavesLeft)
	{
		if(!empty($LeavesLeft)) {
			$this->LeavesLeft=htmlentities($LeavesLeft);
		}
	}
	public function addLeavesLeft($LeavesLeft)
	{
		if(!empty($LeavesLeft)) {
			if(isset($this->LeavesLeft) && !empty($this->LeavesLeft))
				$this->LeavesLeft.=','.htmlentities($LeavesLeft);
			else
				$this->LeavesLeft=htmlentities($LeavesLeft);
		}
	}
}


?>