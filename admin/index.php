<?php

require '../core.php';

if(userIsLoggedIn()) {
	header('Location: ../user/');
}

$pageId = "viewLeaveRequests";
if(isset($_GET['id']) && !empty($_GET['id'])) {
	$pageId = $_GET['id'];
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
			height: 115px !important;
			padding-top: 25px !important;
			padding-bottom: 5px !important;
			line-height: 100px !important;
			font-size: 100px !important;
			
		}
		.full-form {
			height: 40px !important;
			line-height: 18px !important;
			font-size: 15px !important;
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

	<!--  Scripts-->
	<script src="../js/jquery.js"></script>
</head>
<body>

	<header>
		<ul class="side-nav fixed red lighten-2" id="mobile-menu">
			<a href="index.php" class="brand-logo center">LMS</a>
			<a href="index.php" class="full-form center">Leave Management System</a>
			<?php
			if(adminIsLoggedIn()) {
			?>
				<li class="<?php if($pageId=="viewLeaveRequests") echo "active"; ?>"><a href="?id=viewLeaveRequests">Leave Requests</a></li>
				<li class="<?php if($pageId=="viewLeaveType") echo "active"; ?>"><a href="?id=viewLeaveType">Leave Types</a></li>
				<li class="<?php if($pageId=="viewUserType") echo "active"; ?>"><a href="?id=viewUserType">User Types</a></li>
				<li class="<?php if($pageId=="viewUser") echo "active"; ?>"><a href="?id=viewUser">Users</a></li>
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
				<div class="col s5 l6"><span class="teal lighten-5 z-depth-1 teal-text" style="padding:5px;">
				<?php
					require_once '../user/classDatabaseLeaveRequest.php';
					$objDatabaseLeaveRequest = new DatabaseLeaveRequest;
					echo $objDatabaseLeaveRequest->countPending().' new';
				?>
				</span></div>
				<div class="col s4">Welcome <a href="?id=profile" class="white-text"><?php echo getUsername(); ?></a></div>
				<div class="col s2 right-align"><a href="../logout.php" class="white-text">Logout</a></div>
				<?php
				} else {
				?>
				<div class="col s11 l12 center white-text">Admin Login</div>
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
				else if($_GET['id']=='viewUserType')
					include 'viewUserType.php';
				else if($_GET['id']=='addUserType')
					include 'addUserType.php';
				else if($_GET['id']=='viewUser')
					include 'viewUser.php';
				else if($_GET['id']=='addUser')
					include 'addUser.php';
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
	<script src="../js/materialize.js"></script>
	<script src="../js/init.js"></script>

</body>
</html>