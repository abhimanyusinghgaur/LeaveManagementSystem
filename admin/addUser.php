<form action="addUserAction.php" method="post" class="row">
	<div class="row">
		<div class="input-field col s12 m8 offset-m2">
			<label for="Name">Name</label>
			<input type="text" name="Name" id="Name" required>
		</div>
	</div>
	<div class="row">
		<div class="input-field col s12 m4 offset-m2">
			<label for="Id">Id</label>
			<input type="text" name="Id" id="Id" required>
		</div>
		<div class="input-field col s12 m4">
			<label for="Email">Email</label>
			<input type="email" name="Email" id="Email" required>
		</div>
	</div>

	<div class="row">
		<div class="input-field col s12 m4 offset-m2">
			<label for="Password">Password</label>
			<input type="password" name="Password" Password="Password" required>
		</div>
		<div class="input-field col s12 m4">
			 <input type="radio" name="gender" value="male"> Male<br>
             <input type="radio" name="gender" value="female"> Female<br>
		</div>
	</div>
	
	<div class="row">
		<div class="input-field col s12 m4 offset-m2">
			<label for="Type">Type</label>
			<input type="text" name="Type" Type="Type" required>
		</div>
		<div class="input-field col s12 m4">
			<label for="LeavesLeft">LeavesLeft</label>
			<input type="number" min="0" name="LeavesLeft" id="LeavesLeft" required>
		</div>
	</div>
    <div class="row">
    	<div class="col s12 m8 offset-m2">
			<button type="submit" class="col s12 orange waves-effect waves-light btn">Submit</button>	    		
    	</div>
    </div>
</form>