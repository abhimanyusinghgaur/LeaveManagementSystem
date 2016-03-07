<?php

require '../core.php';

if(userIsLoggedIn()) {
	header('Location: ../user/');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta name="viewport" content="width=device-width,initial-scale=1"/>
	<title>Leave Management System</title>

	<!-- CSS  -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="../css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
	<link href="../css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
	<style type="text/css">
		.brand-logo {
			height: 150px !important;
			padding-top: 25px !important;
			padding-bottom: 25px !important;
			line-height: 100px !important;
			font-size: 100px !important;
			border-bottom: 2px solid black;
		}
		@media only screen and (min-width:993px) {
			html,body,main {
				height: 100%;
			}
			main {
				margin-left: 240px;
			}
		}
	</style>
</head>
<body>

	<header>
		<ul class="side-nav fixed red lighten-2" id="mobile-menu">
			<a href="#!" class="brand-logo center">LMS</a>
			<?php
			if(adminIsLoggedIn()) {
			?>
				<li><a href="?id=leaveRequests">Leave Requests</a></li>
				<li><a href="?id=userTypes">User Types</a></li>
				<li><a href="?id=viewLeaveType">Leave Types</a></li>
				<li><a href="?id=users">Users</a></li>
			<?php
			}
			?>
		</ul>
	</header>

	<main class="grey lighten-2">
		<div class="section teal">
			<div class="row">
				<a href="#" data-activates="mobile-menu" class="button-collapse hide-on-large-only col s1"><i class="material-icons white-text">menu</i></a>
				<?php
				if(adminIsLoggedIn()) {
				?>
				<div class="col s5 l6">Statistics</div>
				<div class="col s4">Welcome <a href="?id=profile" class="white-text"><?php echo getUsername(); ?></a></div>
				<div class="col s2 right-align"><a href="../logout.php" class="white-text">Logout</a></div>
				<?php
				} else {
				?>
				<div class="col s11 l12 center white-text">Login</div>
				<?php
				}
				?>
			</div>
		</div>
		<div class="divider red"></div>
		<div class="section container">
			<?php
			if(adminIsLoggedIn()) {
				if(!isset($_GET['id']))
					include 'viewLeaveRequests.php';
				else if($_GET['id']=='addLeaveType')
					include 'addLeaveType.php';
				else if($_GET['id']=='viewLeaveType')
					include 'viewLeaveType.php';
				else if($_GET['id']=='userTypes')
					include 'addUserType.php';
				else
					include 'viewLeaveRequests.php';
			} else {
				include 'login.php';
			}
			?>
		</div>
		<div class="section center red-text" id="errorBox">
			<?php
			if(getError()) {
				echo getError();
				resetError();
			}
			?>
		</div>
	</main>

	<!--  Scripts-->
	<script src="../js/jquery.js"></script>
	<script src="../js/materialize.js"></script>
	<script src="../js/init.js"></script>

</body>
</html>