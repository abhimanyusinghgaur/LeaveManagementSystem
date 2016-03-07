<div class="row">
	<a class="btn-floating btn-large waves-effect waves-light red right tooltipped" data-position="right" data-delay="50" data-tooltip="Add new leve type" href="index.php?id=addLeaveType"><i class="material-icons">add</i></a>
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
						'<td>'.$objLeaveType->getInclusions().'</td>'.
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