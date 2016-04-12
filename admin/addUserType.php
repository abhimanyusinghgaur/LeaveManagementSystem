<form action="addUserTypeAction.php" method="post" class="row">
	<div class="row">
		<div class="input-field col s12 m8 offset-m2">
			<label for="UserType">User Type</label>
			<input type="text" name="UserType" id="UserType" pattern="^[a-zA-Z][a-zA-Z ]*$" title="Only letters and spaces are allowed. First character must be a letter." class="validate" required>
		</div>
	</div>
	<div class="row">
		<div class="col s12 m8 offset-m2">
			<label>Accessible Leave Types:</label><br>
			<?php 
				require '../connect.php';
				$query = "SELECT * FROM leavetypes";
				$result = mysql_query($query);
				$data = array();
				while($row = mysql_fetch_row($result)){
					array_push($data, $row);
				}
				

				foreach ($data as $key => $leave) {
		            echo "<input type='checkbox' class='' name='check_list[]' id='".$leave[1]."' value='".$leave[1]."'>
							<label for='".$leave[1]."'>".$leave[1]."</label>";
		        }
		    ?>
		</div>
    </div>
    <div class="row">
    	<div class="col s12 m8 offset-m2">
			<button type="submit" class="col s12 orange waves-effect waves-light btn">Submit</button>	    		
    	</div>
    </div>
</form>