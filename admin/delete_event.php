<?php 
	include"../core/init.php";
	verify_login($_SESSION['admin_id']);

	$event_id = (int)$_GET['id'] ?? '1';
	$event = find_event_by_id($event_id);
	$event_title = $event['event_title'];


	if(isset($_POST['submit'])) {
		if(event_exist($event_id)){
			if (delete_event($event_id)) {
				$_SESSION['deleted'] = "The event has been deleted";
				header('location:events.php');
			}
		}else{
			$_SESSION['deleted'] = "The event does not exist";
				header('location:events.php');
		}

	}else{
		$event_id = (int)$_GET['id'] ?? '1';
			if (find_event_by_id($event_id)) {
				$event = find_event_by_id($event_id);
			}else{
				header('location:events.php');
			}
	}


	include "admin_header.php";
?>

	<div class="container">	
		<h1 class="text-danger">Delete Event</h1>
		<p>	Are you sure you want to delete this event?</p>
		<p class="bold">	<?php echo $event['event_title']; ?></p>

		<form action="#" method="post">	
			<div class="row pb-5">
				<div class="col-2"><input class=" btn btn-danger" type="submit" name="submit" value="Delete"></div>
				<a class="btn btn-success" href="events.php">NO </a>
			</div>
		</form>
	</div>

<?php 
	include "admin_footer.php";
?>