<?php 
	session_start();
	session_destroy();
	
	session_start();
	$_SESSION['logout'] = "out";
	header("location:../admin.php");

?>