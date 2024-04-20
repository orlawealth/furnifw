<?php 
	include"../core/init.php";
	ini_set('display_errors', 1);
	verify_login($_SESSION['admin_id']);
	
	$products = find_all_products();
	$count =0;
	foreach ($products as $product) {
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
 			<div class="text-center"><span class=" text-success h2">PRODUCTS</span></div>
	 		<div class="d-flex justify-content-between">
	 			<div class=""><button class="btn btn-success"><?php echo $count; ?><span class=""> products</span></button></div>
 				<div class=""><a class="btn btn-success" href="add_product.php">Add new product</a></div>
 			</div>
 		</div>

 		<div class="bg-white">
 			<div class="">
	 			<table class="table table-bordered">
	 				<thead class="">
	 					<tr>
	 						<th>Product Name</th>
	 						<th></th>
	 						<th></th>
	 					</tr>
	 				</thead>
	 				<tbody>
	 					<?php 
	 						foreach ($products as $product) {
	 							echo '
	 								<tr>
	 								<td>'.$product['product_name'].'</td>
	 								<td><a class="text-success" href="'.'view_product.php?id='.$product['product_id'].'">view</a></td>
	 								<td><a class="text-warning"  href="'. 'edit_product.php?id='.$product['product_id'].'">Edit</a></td>
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