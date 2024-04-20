<?php 
	include"../core/init.php";
	verify_login($_SESSION['admin_id']);
	
	$customers = find_all_customers();
	$count =0;
	foreach ($customers as $customer) {
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
 			<div class="text-center"><span class=" text-success h2">CUSTOMERS</span></div>
	 		<div class="d-flex justify-content-between">
	 			<div class=""><button class="btn btn-success"><?php echo $count; ?><span class=""> customers</span></button></div>
 			</div>
 		</div>

 		<div class="bg-white">
 			<div class="">
	 			<table class="table table-bordered">
	 				<thead class="">
	 					<tr>
	 						<th>Name</th>
                             <th>Email</th>
	 						<th>Phone number</th>
	 						<th>Address</th>
                             <th>Postcode</th>
	 					</tr>
	 				</thead>
	 				<tbody>
	 					<?php 
	 						foreach ($customers as $customer) {
                                $addressArray = unserialize($customer["address"]);
                                $street = $addressArray['address'];
                                $state = $addressArray['state'];
                                $country = $addressArray['country'];
                                $postal_code = $addressArray['postal'];
                                $address = $street.", ".$state.", ".$country;

	 							echo '
	 								<tr>
	 								<td>'.$customer['full_name'].'</td>
                                     <td>'.$customer['email'].'</td>
                                     <td>'.$customer['phone_number'].'</td>
                                     <td>'.$address.'</td>
                                     <td>'.$postal_code.'</td>
	 								<td><a class="text-warning"  href="#">Edit</a></td>
	 								</tr>
	 							';
	 						}
                             die();
	 					?>
	 				</tbody>
	 			</table>
 			</div>
 		</div>

 	</div>
 <?php 
	include "admin_footer.php";
 ?>