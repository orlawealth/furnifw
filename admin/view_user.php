<?php 
	include"../core/init.php";
	verify_login($_SESSION['admin_id']);

		$user_id =(int)$_GET['id'] ?? '1';
		$user = find_user_by_id($user_id);

	include "admin_header.php";

?>
	<div class="container">	
		<h1 class="text-primary">User Information</h1>
		<p class="bold">Full Name : <?php echo $user['full_name']; ?></p>
		<p class="bold">Email : <?php echo $user['email']; ?></p>
		<p class="bold">Phone number : <?php echo $user['phone_number']; ?></p>
		<p class="bold">Gender : <?php echo $user['gender']; ?></p>
		<p class="bold">Country : <?php echo $user['country']; ?></p>
		<a class="btn btn-primary" href="users.php">Back </a>
	</div>
	
	
<?php 
	include "admin_footer.php";
?>