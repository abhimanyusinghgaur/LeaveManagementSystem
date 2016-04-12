<form action="loginAction.php" method="post" class="row">
	<div class="row">
		<div class="input-field col s12 m4 l4 offset-m4 offset-l4">
			<label for="username">Username</label>
			<input type="text" name="username" id="username" required>
		</div>
	</div>
	<div class="row">
		<div class="input-field col s12 m4 l4 offset-m4 offset-l4">
			<label for="password">Password</label>
			<input type="password" name="password" id="password" required>
		</div>
	</div>
    <div class="row">
    	<div class="col s12 m4 l4 offset-m4 offset-l4">
			<button type="submit" class="col s12 orange waves-effect waves-light btn">Login<i class="material-icons right">send</i></button>	    		
    	</div>
    </div>
</form>
<div class="row center">
	<a href="../user">Not the admin? Click here.</a>
</div>