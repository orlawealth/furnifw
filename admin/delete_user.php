<?php 
	include"../core/init.php";
	verify_login($_SESSION['admin_id']);

	$user_id = (int)$_GET['id'] ?? '1';
	$user = find_user_by_id($user_id);

	$admin_id = $_SESSION['admin_id'];


	if(isset($_POST['submit'])) {
		if(admin_exist($admin_id)){
			if (delete_user($user_id)) {
				$_SESSION['deleted'] = "The user has been deleted";
				header('location:users.php');
			}
		}else{
			$_SESSION['deleted'] = "The user does not exist";
				header('location:users.php');
		}

	}else{
		$user_id = (int)$_GET['id'] ?? '1';
			if (find_user_by_id($user_id)) {
				$user = find_user_by_id($user_id);
			}else{
				header('location:users.php');
			}
	}


	include "admin_header.php";
?>

	<div class="container">	
		<h1 class="text-danger">Delete user</h1>
		<p>	Are you sure you want to delete this user?</p>
		<p class="bold">Full Name : <?php echo $user['full_name']; ?></p>
		<p class="bold">Email : <?php echo $user['email']; ?></p>
		<p class="bold">Phone number : <?php echo $user['phone_number']; ?></p>
		<p class="bold">Gender : <?php echo $user['gender']; ?></p>
		<p class="bold">Country : <?php echo $user['country']; ?></p>

		<form action="#" method="post">	
			<div class="row pb-5">
				<div class="col-2"><input class=" btn btn-danger" type="submit" name="submit" value="Delete"></div>
				<a class="btn btn-success" href="users.php">NO </a>
			</div>
		</form>
	</div>

<?php 
	include "admin_footer.php";
?>