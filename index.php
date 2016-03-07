<?php

require 'core.php';

if(adminIsLoggedIn()) {
	header('Location: admin/');
} else {
	header('Location: user/');
}

?>