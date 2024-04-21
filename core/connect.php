<?php 
	$hostname = "localhost"; //expertsworld.com.ng
	$username ="root"; //experts_experts
	$password =""; //jamb2020@
	$database ="furni"; //experts_naija

	try {
		$conn = new PDO("mysql:host=$hostname; dbname=$database", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
		echo "couldnt connect to database" .$e->getMessage();
	}
	$GLOBALS['connect_database'] = mysqli_connect($hostname, $username, $password, $database);
?>