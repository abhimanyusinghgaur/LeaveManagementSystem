<div class="row">
	<a class="btn-floating btn-large waves-effect waves-light red right tooltipped" data-position="right" data-delay="50" data-tooltip="Add new user type" href="index.php?id=addUserType"><i class="material-icons">add</i></a>
</div>
<div class="row">
	<table class="highlight bordered responsive-table hoverable">
		<thead>
		  <tr>
		      <th data-field="id">S.No.</th>
		      <th data-field="type">User Type</th>
		      <th data-field="Accessible">Accessible Leaves</th>
		  </tr>
		</thead>

		<tbody>
		<?php

		require_once '../core.php';
		require_once 'classDatabaseUserType.php';

		$objDatabaseUserType=new DatabaseUserType;
		$objUserTypeArray=$objDatabaseUserType->getUserTypes();
		if($objUserTypeArray) {
			$i=1;
			foreach ($objUserTypeArray as $objUserType) {
				echo '<tr>'.
						'<td>'.$i.'</td>'.
						'<td>'.$objUserType->getType().'</td>'.
						'<td>'.$objUserType->getAccessibleLeaves().'</td>'.
					'</tr>';
				$i++;
			}
		} else {
			setError('No User Type has been created yet.');
			setError('Create one by clicking on the add button above.');
		}

		?>
		</tbody>
	</table>
</div>