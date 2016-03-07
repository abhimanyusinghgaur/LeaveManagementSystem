<?php

/**
* class LeaveType handles the various types of leaves
*/
class UserType
{
	private $Type;
	private $AccessibleLeaves;
	public function getType()
	{
		return $this->Type;
	}
	public function setType($Type)
	{
		$this->Type=htmlentities($Type);
	}
	public function getAccessibleLeaves()
	{
		return $this->AccessibleLeaves;
	}
	public function setAccessibleLeaves($AccessibleLeaves)
	{
		if(!empty($AccessibleLeaves)) {
			$this->AccessibleLeaves=htmlentities($AccessibleLeaves);
		}
	}
	public function addAccessibleLeaves($AccessibleLeaves)
	{
		if(!empty($AccessibleLeaves)) {
			if(isset($this->AccessibleLeaves) && !empty($this->AccessibleLeaves))
				$this->AccessibleLeaves.=','.htmlentities($AccessibleLeaves);
			else
				$this->AccessibleLeaves=htmlentities($AccessibleLeaves);
		}
	}
}


?>