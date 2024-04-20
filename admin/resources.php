<?php 
	include"../core/init.php";
	verify_login($_SESSION['admin_id']);

	$resources = find_all_resources();
	$count =0;
	foreach ($resources as $resource) {
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
 			<div class="text-center"><span class=" text-primary h2">List of resources</span></div>
	 		<div class="d-flex justify-content-between">
	 			<div class=""><button class="btn btn-primary"><?php echo $count; ?><span class=""> resources</span></button></div>
 				<div class=""><a class="btn btn-primary" href="add_resource.php">Add new resource</a></div>
 			</div>
 		</div>

 		<div class="bg-white">
 			<div class="">
	 			<table class="table table-bordered">
	 				<thead class="">
	 					<tr>
	 						<th>Name</th>
	 						<th>Size</th>
	 						<th>Downloads</th>
	 						<th></th>
	 					</tr>
	 				</thead>
	 				<tbody>
	 					<?php 
	 						foreach ($resources as $resource) {
	 							echo '
	 								<tr>
	 								<td>'.$resource['resource_name'].'</td>
	 								<td>'.floor($resource['resource_size']/1000).'KB</td>
	 								<td>'.$resource['resource_download'].'</td>
	 								
									<td class ="text-danger"><a class ="text-danger" href="delete_resource.php?id='.$resource['resource_id'].'">Delete</a></td>
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