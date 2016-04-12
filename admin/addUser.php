<form action="addUserAction.php" method="post" class="row">
	<div class="row">
		<div class="input-field col s12 m8 offset-m2">
			<label for="Name">Name</label>
			<input type="text" name="Name" id="Name" pattern="^[a-zA-Z][a-zA-Z ]*$" title="Only letters and spaces are allowed. First character must be a letter." class="validate" required>
		</div>
	</div>
	<div class="row">
		<div class="input-field col s12 m4 offset-m2">
			<label for="Username">Username</label>
			<input type="text" name="Username" id="Username" pattern="^[a-zA-Z0-9]*$" title="Only letters and numbers are allowed." class="validate" required>
		</div>
		<div class="input-field col s12 m4">
			<label for="Email">Email</label>
			<input type="email" name="Email" id="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="Please check the format: characters@characters.domain" class="validate" required>
		</div>
	</div>

	<div class="row">
		<div class="input-field col s12 m4 offset-m2">
			<label>Gender:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" class="with-gap" name="Gender" id="male" value="male" checked>
			<label for="male">Male</label>
            <input type="radio" class="with-gap" name="Gender" id="female" value="female">
			<label for="female">Female</label>
		</div>
		<div class="input-field col s12 m4">
			<select class="browser-default" name="UserType" id="UserType" required>
				<option value="" disabled selected>Select User Type</option>
				<?php
				require_once 'classDatabaseUserType.php';
				$objDatabaseUserType=new DatabaseUserType;
				$objUserTypeArray=$objDatabaseUserType->getUserTypes();
				foreach ($objUserTypeArray as $objUserType) {
					echo '<option value="'.$objUserType->getType().'">'.$objUserType->getType().'</option>';
				}
				?>
			</select>
		</div>
	</div>
    <div class="row">
    	<div class="col s12 m8 offset-m2">
			<button type="submit" class="col s12 orange waves-effect waves-light btn">Submit</button>	    		
    	</div>
    </div>
</form>