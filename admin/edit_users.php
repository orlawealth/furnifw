<?php 
	include"../core/init.php";
	verify_login($_SESSION['admin_id']);

	$users = find_all_users();
	$count =0;
	foreach ($users as $user) {
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
 			<div class="text-center"><span class=" text-primary h2">USERS</span></div>
	 		<div class="d-flex justify-content-between">
 				<div class=""><a class="btn btn-primary" href="add_user.php">Add new user</a></div>
	 			<div class=""><button class="btn btn-primary"><?php echo $count; ?><span class=""> users</span></button></div>
 			</div>
 		</div>

 		<div class="bg-white">
 			<div class="">
	 			<table class="table table-bordered">
	 				<thead class="">
	 					<tr>
	 						<th>S/N</th>
	 						<th>Full name</th>
	 						<th>Email</th>
	 						<th>Phone number</th>
	 						<th>Gender</th>
	 						<th>Country</th>
	 						<th></th>
	 					</tr>
	 				</thead>
	 				<tbody>
	 					<?php 
	 						$count = 1;
	 						foreach ($users as $user) {
	 							echo '
	 								<tr>
	 								<td>'.$count.'</td>
	 								<td>'.$user['full_name'].'</td>
	 								<td>'.$user['email'].'</td>
	 								<td>'.$user['phone_number'].'</td>
	 								<td>'.$user['gender'].'</td>
	 								<td>'.$user['country'].'</td>
	 								<td><a href="'. 'edit_user.php?id='.$user['user_id'].'">Edit</a></td>
	 								</tr>
	 							';
	 							$count++;
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