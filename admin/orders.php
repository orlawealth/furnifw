<?php 
	include"../core/init.php";
	ini_set('display_errors', 1);
	verify_login($_SESSION['admin_id']);
	
	$orders = find_all_customerorders();
	$count =0;
	foreach ($orders as $order) {
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
 			<div class="text-center"><span class=" text-success h2">ORDERS</span></div>
	 		<div class="d-flex justify-content-between">
	 			<div class=""><button class="btn btn-success"><?php echo $count; ?><span class=""> orders</span></button></div>
 			</div>
 		</div>

 		<div class="bg-white">
 			<div class="">
	 			<table class="table table-bordered">
	 				<thead class="">
	 					<tr>
						 <th>Order id</th>
	 						<th>Name</th>
                             <th>Product</th>
							<th>Quantity</th>
							<th>Total Price</th>
							<th></th>
	 						
	 					</tr>
	 				</thead>
	 				<tbody>
	 					<?php 
						$query = "SELECT customerOrder.*, customer.full_name
						FROM customerOrder
						JOIN customer ON customerOrder.customer_id = customer.customer_id
						ORDER BY customerOrder.order_date DESC";

			  			$result = mysqli_query($GLOBALS['connect_database'], $query);

	 						while ($row = mysqli_fetch_assoc($result)) {
									echo "<tr>";
									echo "<td>" . $row['customerorder_id'] . "</td>";
									echo "<td>" . $row['full_name'] . "</td>";
								$items = json_decode($row['itemsordered'], true);
								$subtotalPrice = 0; // Initialize total price for the order
								$productPrices = []; // Array to store individual product prices
								
								foreach ($items as $item){
									$product_id = $item['product_id'];
									$quantity = $item['quantity'];
									$price_query = "SELECT product_name, price FROM product WHERE product_id = $product_id";
									$price_result = mysqli_query($GLOBALS['connect_database'], $price_query);
									$product_row = mysqli_fetch_assoc($price_result);
									$product_name = $product_row['product_name'];
									$price = $product_row['price'];
									// Store individual product prices
        							$productPrices[] = $price * $quantity;
									echo "<td>" . $product_name . "</td>";
									echo "<td>" . $quantity . "</td>";
									
								}
								    // Calculate the total price for the order
									$subtotalPrice = array_sum($productPrices);
									$tax_paid = 20/100 * $subtotalPrice;
									$totalPrice = $tax_paid + $subtotalPrice;

									echo "<td> Subtotal Price: £" . $subtotalPrice . "</td>";
									echo "<td> VAT: £" . $tax_paid . "</td>";
									echo "<td> Total Order Price: £" . $totalPrice . "</td>";
									echo "</tr>";
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