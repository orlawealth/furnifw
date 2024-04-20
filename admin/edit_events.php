<?php 
	include"../core/init.php";
	verify_login($_SESSION['admin_id']);

	$events = find_all_events();
	$count =0;
	foreach ($events as $event) {
		$count++;
	}

	include "admin_header.php";
 ?>
 	<div>
 		<p class="update_message">	
			<?php 	
				if (isset($_SESSION['success_message'])) {
					if (!empty($_SESSION['success_message'])) {
						echo $_SESSION['success_message'];
						$_SESSION['success_message'] = null;

					}
				}
			?>
		</p>
		<p class="errors">	
			<?php 	
				if (isset($_SESSION['deleted'])) {
					if (!empty($_SESSION['deleted'])) {
						echo $_SESSION['deleted'];
						$_SESSION['deleted'] = null;

					}
				}
			?>
		</p>
 	</div>
 	<div class="container mb-5">
 		<div class="mb-3">
 			<div class="text-center"><span class=" text-primary h2">List of Events</span></div>
	 		<div class="d-flex justify-content-between">
	 			<div class=""><button class="btn btn-primary"><?php echo $count; ?><span class=""> events</span></button></div>
 				<div class=""><a class="btn btn-primary" href="add_event.php">Add new event</a></div>
 			</div>
 		</div>

 		<div class="bg-white">
 			<div class="">
	 			<table class="table table-bordered">
	 				<thead class="">
	 					<tr>
	 						<th class="text-center">Event Title</th>
	 						<th></th>
	 					</tr>
	 				</thead>
	 				<tbody>
	 					<?php 
	 						foreach ($events as $event) {
	 							echo '
	 								<tr>
	 								<td>'.$event['event_title'].'</td>
	 								<td class="text-center"><a class="text-center" href="'. 'edit_event.php?id='.$event['event_id'].'">Edit</a></td>
	 								</tr>
	 							';
	 						}
	 					?>
	 				</tbody>
	 			</table>
 			</div>
 		</div>

 	</div>
 <?php 
	include "admin_footer.php";
 ?>