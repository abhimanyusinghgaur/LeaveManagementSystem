<form action="newLeaveAction.php" method="post" class="row">
	<div class="row">
		<div class="input-field col s12 m8 offset-m2">
			<select class="browser-default" name="leaveType" id="leaveType" required>
				<option value="" disabled selected>Select Leave Type</option>
				<?php
				require_once 'classDatabaseUser.php';
				require_once '../core.php';
				$objDatabaseUser=new DatabaseUser;
				$objUserArray=$objDatabaseUser->getUsers();
				foreach ($objUserArray as $objUser) {
					if(getUsername()==$objUser->getUsername()) {
						$AllLeavesLeft=$objUser->getLeavesLeft();
						$LeavesLeftArray=explode(",", $AllLeavesLeft);
						foreach ($LeavesLeftArray as $LeavesLeft) {
							$LeaveDetail=explode(":", $LeavesLeft);
							if($LeaveDetail[1]>0)
								echo '<option value="'.$LeaveDetail[0].'">'.$LeaveDetail[0].'</option>';
							else
								echo '<option value="" disabled>'.$LeaveDetail[0].'</option>';
						}
						break;
					}
				}
				?>
			</select>
		</div>
	</div>
	<div class="row">
		<div class="input-field col s12 m4 offset-m2">
			<label for="startDate">Start Date</label>
			<input type="date" class="datepicker" name="startDate" id="startDate" required>
		</div>
		<div class="input-field col s12 m4">
			<label for="endDate">End Date</label>
			<input type="date" class="datepicker" name="endDate" id="endDate" required>
		</div>
	</div>

	<div class="row">
		<div class="input-field col s12 m8 offset-m2">
			<textarea name="reason" id="reason" class="materialize-textarea" required></textarea>
			<label for="reason">Why are you taking a leave?</label>
		</div>
	</div>
    <div class="row">
    	<div class="col s12 m8 offset-m2">
			<button type="submit" class="col s12 orange waves-effect waves-light btn">Submit</button>	    		
    	</div>
    </div>
</form>