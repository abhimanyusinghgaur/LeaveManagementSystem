<div class="row">
	<span class"left">Note: Inclusions are weekdays. <div class="btn-floating orange center">H</div> is for Holidays.</span>
	<a class="btn-floating btn-large waves-effect waves-light red right tooltipped" data-position="right" data-delay="50" data-tooltip="Add new leave type" href="index.php?id=addLeaveType"><i class="material-icons">add</i></a>
</div>
<div class="row">
	<table class="highlight bordered responsive-table hoverable">
		<thead>
		  <tr>
		      <th data-field="id">S.No.</th>
		      <th data-field="name">Leave Name</th>
		      <th data-field="abbr">Abbreviation</th>
		      <th data-field="price">Number of Leaves</th>
		      <th data-field="incl">Inclusions</th>
		  </tr>
		</thead>

		<tbody>
		<?php

		require_once '../core.php';
		require_once 'classDatabaseLeaveType.php';

		$objDatabaseLeaveType=new DatabaseLeaveType;
		$objLeaveTypeArray=$objDatabaseLeaveType->getLeaveTypes();
		if($objLeaveTypeArray) {
			$i=1;
			foreach ($objLeaveTypeArray as $objLeaveType) {
				echo '<tr>'.
						'<td>'.$i.'</td>'.
						'<td>'.$objLeaveType->getLeaveName().'</td>'.
						'<td>'.$objLeaveType->getAbbreviation().'</td>'.
						'<td>'.$objLeaveType->getNumLeaves().'</td>'.
						'<td>'.
							'<div class="btn-floating orange center'; if(strpos($objLeaveType->getInclusions(), 'Mon') === false) echo ' disabled'; echo '">M</div>'.
							'<div class="btn-floating orange center'; if(strpos($objLeaveType->getInclusions(), 'Tue') === false) echo ' disabled'; echo '">T</div>'.
							'<div class="btn-floating orange center'; if(strpos($objLeaveType->getInclusions(), 'Wed') === false) echo ' disabled'; echo '">W</div>'.
							'<div class="btn-floating orange center'; if(strpos($objLeaveType->getInclusions(), 'Thu') === false) echo ' disabled'; echo '">T</div>'.
							'<div class="btn-floating orange center'; if(strpos($objLeaveType->getInclusions(), 'Fri') === false) echo ' disabled'; echo '">F</div>'.
							'<div class="btn-floating orange center'; if(strpos($objLeaveType->getInclusions(), 'Sat') === false) echo ' disabled'; echo '">S</div>'.
							'<div class="btn-floating orange center'; if(strpos($objLeaveType->getInclusions(), 'Sun') === false) echo ' disabled'; echo '">S</div>'.
							'<div class="btn-floating orange center'; if(strpos($objLeaveType->getInclusions(), 'Holidays') === false) echo ' disabled'; echo '">H</div>'.
						'</td>'.
					'</tr>';
				$i++;
			}
		} else {
			setError('No Leave Type has been created yet.');
			setError('Create one by clicking on the add button above.');
		}

		?>
		</tbody>
	</table>
</div>