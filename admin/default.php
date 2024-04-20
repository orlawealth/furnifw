<?php 
	include"../core/init.php";
	verify_login($_SESSION['admin_id']);
	include "admin_header.php";
?>

<?php 
	include "admin_footer.php";
?>