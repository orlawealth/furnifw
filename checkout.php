<?php 
		 include "core/init.php";
		 ini_set('display_errors', 1);
		 $empty_error = "";
		 $email_err = "";
		 //die("log in successful");
		 if (isset($_POST['action']) && $_POST['action']=="addcustomer"){
			$c_fname = $_POST['c_fname'];
			$c_email = $_POST['c_email'];
			$c_address = $_POST['c_address'];
			$c_state = $_POST['c_state'];
			$c_country = $_POST['c_country'];
			$c_postal = $_POST['c_postal'];
			$c_phone = $_POST['c_phone'];
			$c_password = $_POST['c_password'];
			
	

			
			$required_fields = ["c_fname", "c_email", "c_address", "c_state", "c_country", "c_postal", "c_phone"]; 
			foreach ($_POST as $key => $value) {
				if (empty($value) and in_array($key, $required_fields)) {
					$empty_error = 'Fill all required fields with *';
				}
			}

			// Create an array with the updated address
			$addressArray = array(
				"address" => $c_address,
				"state" => $c_state,
				"country" => $c_country,
				"postal" => $c_postal
			);

			if (empty($empty_error)) {
				if (email_exists($c_email)) {
					// Adding order for existing guest customer 
					$itemsordered = array();

					foreach ($_SESSION["shopping_cartfw"] as $product) {
						$newItem = array(
							'quantity' => $product['quantity'],
							'product_id' => $product['product_id'],
							// Add more columns as needed
						);
				
						$itemsordered[] = $newItem;
					}
					// Convert the new array to a JSON-encoded string
   					$itemsordered = json_encode($itemsordered);

					$customer = find_customer_by_email($c_email);
					$customer_id = $customer['customer_id'];
					$subtotal_price = 0;
					foreach ($_SESSION["shopping_cartfw"] as $product) {
						$subtotal_price += ($product["price"]*$product["quantity"]);
							$tax_paid = 20/100 * $subtotal_price;
							$total_price = $tax_paid + $subtotal_price;
					}

					if(add_customer_order($customer_id, $itemsordered, $total_price, $tax_paid)){
						unset($_SESSION['shopping_cart']); 
						header("location: thankyou.php");
					}

				}elseif(!empty($c_password)) {
					//New customer creating account and making order
					if (add_customer_with_password($c_fname, $c_email, $addressArray, $c_phone, $c_password)) {
						$itemsordered = array();

						foreach ($_SESSION["shopping_cartfw"] as $product) {
							$newItem = array(
								'quantity' => $product['quantity'],
								'product_id' => $product['product_id'],
								// Add more columns as needed
							);
					
							$itemsordered[] = $newItem;
						}
						// Convert the new array to a JSON-encoded string
						   $itemsordered = json_encode($itemsordered);
	
						$customer = find_customer_by_email($c_email);
						$customer_id = $customer['customer_id'];
						$subtotal_price = 0;
						foreach ($_SESSION["shopping_cartfw"] as $product) {
							$subtotal_price += ($product["price"]*$product["quantity"]);
								$tax_paid = 20/100 * $subtotal_price;
								$total_price = $tax_paid + $subtotal_price;
						}
	
						if(add_customer_order($customer_id, $itemsordered, $total_price, $tax_paid)){
							unset($_SESSION['shopping_cart']); 
							$successMessage = "Click <a href='login.php'>here</a> to Login and track your order.";
    						$_SESSION['successMessage'] = $successMessage;
							header("location: thankyou.php");
						}						
					}
					
				}else {
					//Adding new guest customer 
					if (add_customer($c_fname, $c_email, $addressArray, $c_phone)) {
						$itemsordered = array();

						foreach ($_SESSION["shopping_cartfw"] as $product) {
							$newItem = array(
								'quantity' => $product['quantity'],
								'product_id' => $product['product_id'],
								// Add more columns as needed
							);
					
							$itemsordered[] = $newItem;
						}
						// Convert the new array to a JSON-encoded string
						   $itemsordered = json_encode($itemsordered);
	
						$customer = find_customer_by_email($c_email);
						$customer_id = $customer['customer_id'];
						$subtotal_price = 0;
						foreach ($_SESSION["shopping_cartfw"] as $product) {
							$subtotal_price += ($product["price"]*$product["quantity"]);
								$tax_paid = 20/100 * $subtotal_price;
								$total_price = $tax_paid + $subtotal_price;
						}
	
						if(add_customer_order($customer_id, $itemsordered, $total_price, $tax_paid)){
							unset($_SESSION['shopping_cart']); 
							header("location: thankyou.php");
						}						
						
					}
					
				}


			}
			
		 }


		 if(isset($_POST['subm'])){
		
			die("inserted order");
			foreach ($_SESSION["shopping_cartfw"] as $product){
				$quantity = ($product['quantity']);
				$product_id = ($product['product_id']);
				add_order($product_id, $quantity);
			}
			
			
		 }

		 
        include "furni_header.php";  
 ?>

		<!-- Start Hero Section -->
				<div class="container">
					<div class="row justify-content-between">
						<div class="col-lg-5">
							<div class="intro-excerpt">
								<h1>Checkout</h1>
							</div>
						</div>
						<div class="col-lg-7">
							
						</div>
					</div>
				</div>
		<!-- End Hero Section -->

		<div class="untree_co-section_checkout">
		    <div class="container">
		      <div class="row mb-5">
		        <div class="col-md-12">
		          <div class="border p-4 rounded" role="alert">
		            Returning customer? <a href="#">Click here</a> to login
		          </div>
		        </div>
		      </div>
		      <div class="row">
		        <div class="col-md-6 mb-5 mb-md-0">
		          <h2 class="h3 mb-3 text-black">Shipping Details</h2>
		          <div class="p-3 p-lg-5 border bg-white">
				  <div><p class="text-danger"><?php echo $empty_error; ?></p></div>
					<form id= "form1" method ="post" action="">
						<div class="form-group row">
						<div class="col-md-12">
							<label for="c_fname" class="text-black">Name <span class="text-danger">*</span></label>
							<input type="text" class="form-control" id="c_fname" name="c_fname" value="<?php if(isset($c_fname)){echo $c_fname;} ?>"  placeholder="John Doe" required>
						</div>
						</div>

						<div class="form-group row">
						<div class="col-md-12">
							<label for="c_email" class="text-black">Email Address <span class="text-danger">*</span></label>
							<input type="email" class="form-control" id="c_email" name="c_email" value="<?php if(isset($c_email)){echo $c_email;} ?>" placeholder="Johndoe@gmail.com" required>
							<span class="err"><?php echo $email_err ?></span>
						</div>
						</div>

						<div class="form-group row">
						<div class="col-md-12">
							<label for="c_address" class="text-black">Address <span class="text-danger">*</span></label>
							<input type="text" class="form-control" id="c_address" name="c_address" value="<?php if(isset($c_address)){echo $c_address;} ?>"  placeholder="5 leek road, stoke-on-trent"  required >
						</div>
						</div>

						<div class="form-group row">
						<div class="col-md-6">
							<label for="c_state" class="text-black">State <span class="text-danger">*</span></label>
							<input type="text" class="form-control" id="c_state" name="c_state" value="<?php if(isset($c_state)){echo $c_state;} ?>"  placeholder="Staffordshire"  required>
						</div>
						<div class="col-md-6">
							<label for="c_country" class="text-black">Country <span class="text-danger">*</span></label>
							<input type="text" class="form-control" id="c_country" name="c_country" value="<?php if(isset($c_country)){echo $c_country;} ?>"  placeholder="United Kingdom"  required>
						</div>
						</div>

						<div class="form-group row mb-5">
						<div class="col-md-6">
							<label for="c_postal" class="text-black">Postal / Zip Code <span class="text-danger">*</span></label>
							<input type="text" class="form-control" id="c_postal" name="c_postal" value="<?php if(isset($c_postal)){echo $c_postal;} ?>"  placeholder="ST4 2DF"  required>
						</div>
						<div class="col-md-6">
							<label for="c_phone" class="text-black">Phone <span class="text-danger">*</span></label>
							<input type="text" class="form-control" id="c_phone" name="c_phone" value="<?php if(isset($c_phone)){echo $c_phone;} ?>"  placeholder="+44 1782 294400" required>
							<input type='hidden' name='action' value="addcustomer" />
						</div>
						</div>
		 				
						<div class="form-group">
						<label for="c_create_account" class="text-black" data-bs-toggle="collapse" href="#create_an_account" role="button" aria-expanded="false" aria-controls="create_an_account"><input type="checkbox" value="1" id="c_create_account"> Create an account?</label>
						<div class="collapse" id="create_an_account">
							<div class="py-2 mb-4">
							<p class="mb-3">Create an account by entering the information below. If you are a returning customer please login at the top of the page.</p>
							<div class="form-group">
								<label for="c_password" class="text-black">Account Password</label>
								<input type="text" class="form-control" id="c_account_password" name="c_password" placeholder="Enter password">
							</div>
							</div>
						</div>
						</div>
					</form>
		          </div>
		        </div>
		        <div class="col-md-6">

		          

		          <div class="row mb-5">
		            <div class="col-md-12">
		              <h2 class="h3 mb-3 text-black">Your Order</h2>
					  <?php
                if(isset($_SESSION["shopping_cartfw"])){
                      $subtotal_price = 0;
                ?>	
		              <div class="p-3 p-lg-5 border bg-white">
		                <table class="table site-block-order-table mb-5">
		                  <thead>
		                    <th>Product</th>
		                    <th>Total</th>
		                  </thead>
					<?php		
                		foreach ($_SESSION["shopping_cartfw"] as $product){
                  	?>
                      
		                  <tbody>
		                    <tr>
		                      <td><?php echo ($product['name']) ?> <strong class="mx-2">x</strong> <?php echo ($product['quantity']) ?></td>
		                      <td><?php echo "£".$product["price"]*$product["quantity"]; ?></td>
		                    </tr>
					<?php
						$subtotal_price += ($product["price"]*$product["quantity"]);
						$vat = 20/100 * $subtotal_price;
						$total = $vat + $subtotal_price;
						}
                	?>	
		                 	<tr>
		                      <td class="text-black font-weight-bold"><strong>Cart Subtotal</strong></td>
		                      <td class="text-black"><?php echo "£".$subtotal_price; ?></td>
		                    </tr>
		                    <tr>
		                      <td class="text-black font-weight-bold"><strong>VAT(20%)</strong></td>
		                      <td class="text-black"><?php echo "£".$vat; ?></td>
		                    </tr>
		                    <tr>
		                      <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
		                      <td class="text-black font-weight-bold"><strong><?php echo "£".$total; ?></strong></td>
		                    </tr>
					 </tbody>
		                </table>
				<?php
					
				}
                ?>	
		                <div class="border p-3 mb-3">
		                  <h3 class="h6 mb-0"><a class="d-block" data-bs-toggle="collapse" href="#collapsebank" role="button" aria-expanded="false" aria-controls="collapsebank">Direct Bank Transfer</a></h3>

		                  <div class="collapse" id="collapsebank">
		                    <div class="py-2">
		                      <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
		                    </div>
		                  </div>
		                </div>

		                <div class="border p-3 mb-3">
		                  <h3 class="h6 mb-0"><a class="d-block" data-bs-toggle="collapse" href="#collapsecheque" role="button" aria-expanded="false" aria-controls="collapsecheque">Cheque Payment</a></h3>

		                  <div class="collapse" id="collapsecheque">
		                    <div class="py-2">
		                      <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
		                    </div>
		                  </div>
		                </div>

		                <div class="border p-3 mb-5">
		                  <h3 class="h6 mb-0"><a class="d-block" data-bs-toggle="collapse" href="#collapsepaypal" role="button" aria-expanded="false" aria-controls="collapsepaypal">Paypal</a></h3>

		                  <div class="collapse" id="collapsepaypal">
		                    <div class="py-2">
		                      <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
		                    </div>
		                  </div>
		                </div>

		                <div class="form-group">
							
							<button class="btn btn-black btn-lg py-3 btn-block" onclick="submitForm()">Place Order</button>
							<!-- <button type="submit" name="submit" class="btn btn-black btn-lg py-3 btn-block" onclick="window.location='thankyou.html'">Place Order</button>
							 -->
						
						</div>

		              </div>
		            </div>
		          </div>

		        </div>
		      </div>
		      <!-- </form> -->
		    </div>
		  </div>

<?php 
	include "furni_footer.php";  
?>