<?php

/**
* class LeaveType handles the various types of leaves
*/
class LeaveType
{
	private $LeaveName;
	private $Abbreviation;
	private $NumLeaves;
	private $Inclusions;
	public function getLeaveName()
	{
		return $this->LeaveName;
	}
	public function setLeaveName($LeaveName)
	{
		$this->LeaveName=htmlentities($LeaveName);
	}
	public function getAbbreviation()
	{
		return $this->Abbreviation;
	}
	public function setAbbreviation($Abbreviation)
	{
		$this->Abbreviation=htmlentities($Abbreviation);
	}
	public function getNumLeaves()
	{
		return $this->NumLeaves;
	}
	public function setNumLeaves($NumLeaves)
	{
		$this->NumLeaves=htmlentities($NumLeaves);
	}
	public function getInclusions()
	{
		return $this->Inclusions;
	}
	public function setInclusions($Inclusion)
	{
		if(!empty($Inclusion)) {
			$this->Inclusions=htmlentities($Inclusion);
		}
	}
	public function addInclusions($Inclusion)
	{
		if(!empty($Inclusion)) {
			if(isset($this->Inclusions) && !empty($this->Inclusions))
				$this->Inclusions.=','.htmlentities($Inclusion);
			else
				$this->Inclusions=htmlentities($Inclusion);
		}
	}
}

// $tmp= new LeaveType;
// $tmp->setType('Casual Leave');
// $tmp->setNumLeaves(15);
// $tmp->setExclusions('1,2,3');
// echo $tmp->getType().'<br>'.$tmp->getNumLeaves().'<br>'.$tmp->getExclusions();

?>