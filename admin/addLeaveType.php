<form action="addLeaveTypeAction.php" method="post" class="row">
	<div class="row">
		<div class="input-field col s12 m8 offset-m2">
			<label for="leaveName">Leave Name</label>
			<input type="text" name="leaveName" id="leaveName" required>
		</div>
	</div>
	<div class="row">
		<div class="input-field col s12 m4 offset-m2">
			<label for="abbreviation">Abbreviation</label>
			<input type="text" name="abbreviation" id="abbreviation" required>
		</div>
		<div class="input-field col s12 m4">
			<label for="numLeaves">Number of Leaves</label>
			<input type="number" name="numLeaves" id="numLeaves" min="1" max="365" required>
		</div>
	</div>
	<div class="row">
		<div class="col s12 m8 offset-m2">
			<label>Inclusions:</label><br>
			<input type="checkbox" class="" name="check_list[]" id="monday" value="monday" checked>
				<label for="monday">Monday</label>
			<input type="checkbox" class="" name="check_list[]" id="tuesday" value="tuesday" checked>
				<label for="tuesday">Tuesday</label>
			<input type="checkbox" class="" name="check_list[]" id="wednesday" value="wednesday" checked>
				<label for="wednesday">Wednesday</label>
			<input type="checkbox" class="" name="check_list[]" id="thursday" value="thursday" checked>
				<label for="thursday">Thursday</label>
			<input type="checkbox" class="" name="check_list[]" id="friday" value="friday" checked>
				<label for="friday">Friday</label>
			<input type="checkbox" class="" name="check_list[]" id="saturday" value="saturday">
				<label for="saturday">Saturday</label>
			<input type="checkbox" class="" name="check_list[]" id="sunday" value="sunday">
				<label for="sunday">Sunday</label>
			<input type="checkbox" class="" name="check_list[]" id="holidays" value="holidays">
				<label for="holidays">Holidays</label>
		</div>
    </div>
    <div class="row">
    	<div class="col s12 m8 offset-m2">
			<button type="submit" class="col s12 orange waves-effect waves-light btn">Submit</button>	    		
    	</div>
    </div>
</form>