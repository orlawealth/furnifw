<?php 
	include"../core/init.php";
	verify_login($_SESSION['admin_id']);

	$resource_id = (int)$_GET['id'] ?? '1';
	$resource = find_resource_by_id($resource_id);
	$resource_name = $resource['resource_name'];


	if(isset($_POST['submit'])) {
		if(resource_exist($resource_id)){
			if (delete_resource($resource_id)) {
				$_SESSION['deleted'] = "The resource has been deleted";
				header('location:resources.php');
			}
		}else{
			$_SESSION['deleted'] = "The resource does not exist";
				header('location:resources.php');
		}

	}else{
		$resource_id = (int)$_GET['id'] ?? '1';
			if (find_resource_by_id($resource_id)) {
				$resource = find_resource_by_id($resource_id);
			}else{
				header('location:resources.php');
			}
	}


	include "admin_header.php";
?>

	<div class="container">	
		<h1 class="text-danger">Delete resource</h1>
		<p>	Are you sure you want to delete this resource?</p>
		<p class="bold">	<?php echo $resource['resource_name']; ?></p>

		<form action="#" method="post">	
			<div class="row pb-5">
				<div class="col-2"><input class=" btn btn-danger" type="submit" name="submit" value="Delete"></div>
				<a class="btn btn-primary" href="resources.php">NO </a>
			</div>
		</form>
	</div>

<?php 
	include "admin_footer.php";
?>