<div class="row">
	<a class="btn-floating btn-large waves-effect waves-light red right tooltipped" data-position="right" data-delay="50" data-tooltip="Add new user" href="index.php?id=addUser"><i class="material-icons">add</i></a>
</div>
<div class="row">
	<table class="highlight bordered responsive-table hoverable">
		<thead>
		  <tr>
		      <th data-field="id">S.No.</th>
		      <th data-field="name">Name</th>
		      <th data-field="user_Id">Username</th>
		      <th data-field="email">Email</th>
		      <th data-field="Gen">Gender</th>
		      <th data-field="Type">Type</th>
		      <th data-field="cl_left">Leaves Left</th>
		  </tr>
		</thead>

		<tbody>
		<?php

		require_once '../core.php';
		require_once '../user/classDatabaseUser.php';

		$objDatabaseUser=new DatabaseUser;
		$objUserArray=$objDatabaseUser->getUsers();
		if($objUserArray) {
			$i=1;
			foreach ($objUserArray as $objUser) {
				echo '<tr>'.
						'<td>'.$i.'</td>'.
						'<td>'.$objUser->getName().'</td>'.
						'<td>'.$objUser->getUsername().'</td>'.
						'<td>'.$objUser->getEmail().'</td>'.
						'<td>'.$objUser->getGender().'</td>'.
						'<td>'.$objUser->getType().'</td>'.
						'<td>'.$objUser->getLeavesLeft().'</td>'.
					'</tr>';
				$i++;
			}
		} else {
			setError('No User has been created yet.');
			setError('Create one by clicking on the add button above.');
		}

		?>
		</tbody>
	</table>
</div>