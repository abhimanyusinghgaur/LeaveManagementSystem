<div class="row">
	<a class="btn-floating btn-large waves-effect waves-light red right tooltipped" data-position="right" data-delay="50" data-tooltip="Add new user" href="index.php?id=addUser"><i class="material-icons">add</i></a>
</div>
<div class="row">
	<table class="highlight bordered responsive-table hoverable">
		<thead>
		  <tr>
		      <th data-field="id">S.No.</th>
		      <th data-field="name">Name</th>
		      <th data-field="user_Id">User_Id</th>
		      <th data-field="email">Email</th>
		      <th data-field="pass">Password</th>
		      <th data-field="Gen">Gender</th>
		      <th data-field="Type">Type</th>
		      <th data-field="cl_left">Casual Leaves Left</th>
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
						'<td>'.$objUser->getId().'</td>'.
						'<td>'.$objUser->getEmail().'</td>'.
						'<td>'.$objUser->getPassword().'</td>'.
						'<td>'.$objUser->getGender().'</td>'.
						'<td>'.$objUser->getType().'</td>'.
						'<td>'.$objUser->getLeavesLeft().'</td>'.
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