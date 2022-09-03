<?php
	session_start();
	session_destroy();
	unset ($_SESSION['checker']);
	unset ($_SESSION['username']);
	unset ($_SESSION['role']);
	session_regenerate_id();
	header("Location: login.html");
	exit();
?>