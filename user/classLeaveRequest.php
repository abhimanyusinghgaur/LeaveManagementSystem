<?php

/**
* class LeaveRequest handles the various types of LeaveRequests
*/
class LeaveRequest
{
	private $id;
	private $Username;
	private $LeaveType;
	private $StartDate;
	private $EndDate;
	private $Reason;
	private $Status;	
	
	public function getid()
	{
		return $this->id;
	}
	public function setid($id)
	{
		if(!empty($id)) {
			$this->id=htmlentities($id);
		}
	}
	
	public function getUsername()
	{
		return $this->Username;
	}
	public function setUsername($Username)
	{
		if(!empty($Username)) {
			$this->Username=htmlentities($Username);
		}
	}
	
	public function getLeaveType()
	{
		return $this->LeaveType;
	}
	public function setLeaveType($LeaveType)
	{
		if(!empty($LeaveType)) {
			$this->LeaveType=htmlentities($LeaveType);
		}
	}
	
	public function getStartDate()
	{
		return $this->StartDate;
	}
	public function setStartDate($StartDate)
	{
		if(!empty($StartDate)) {
			$this->StartDate=date('Y-m-d',strtotime(htmlentities($StartDate)));
		}
	}

	public function getEndDate()
	{
		return $this->EndDate;
	}
	public function setEndDate($EndDate)
	{
		if(!empty($EndDate)) {
			$this->EndDate=date('Y-m-d',strtotime(htmlentities($EndDate)));
		}
	}

	public function getReason()
	{
		return $this->Reason;
	}
	public function setReason($Reason)
	{
		if(!empty($Reason)) {
			$this->Reason=htmlentities($Reason);
		}
	}

	public function getStatus()
	{
		return $this->Status;
	}
	public function setStatus($Status)
	{
		if(!empty($Status)) {
			$this->Status=htmlentities($Status);
		}
	}

	public function getLeavesRequired()
	{
		require_once '../admin/classDatabaseLeaveType.php';
		if(strtotime($this->EndDate)-strtotime($this->StartDate) >= 0) {
			$leavesRequired = intval(date_diff(new DateTime($this->StartDate), new DateTime($this->EndDate))->days);
			if($leavesRequired>=0) {
				$leavesRequired += 1;	//if StartDate == EndDate => date_diff()=0 but leavesRequired=1
				$leavesPerDay = array_fill(0, 7, intval($leavesRequired/7));
				$modulo = $leavesRequired%7;
				$startDay = date('D',strtotime($this->StartDate));
				$indexForDay = array('Mon' => 0, 'Tue' => 1, 'Wed' => 2, 'Thu' => 3, 'Fri' => 4, 'Sat' => 5, 'Sun' => 6);
				$index = $indexForDay[$startDay];
				while ($modulo--) {
					if($index>6)
						$index = 0;
					$leavesPerDay[$index++] += 1;
				}
				$objDatabaseLeaveType = new DatabaseLeaveType;
				$objLeaveType = $objDatabaseLeaveType->getLeaveTypeWithLeaveName($this->LeaveType);
				if($objLeaveType) {
					$inclusions = $objLeaveType->getInclusions();
					foreach ($indexForDay as $key => $value) {
						if(strpos($inclusions, $key) === false) {
							$leavesRequired -= $leavesPerDay[$value];
						}
					}
					return $leavesRequired;
				}
			}
		}
		return -1;
	}
}

?>