<?php 
		 include "core/init.php";
		 ini_set('display_errors', 1);
		 //die("log in successful");
        include "furni_header.php";  
 ?>

		<!-- Start Hero Section -->
				<div class="container">
					<div class="row justify-content-between">
						<div class="col-lg-5">
							<div class="intro-excerpt">
								<h1>Shop</h1>
							</div>
						</div>
						<div class="col-lg-7">
							
						</div>
					</div>
				</div>
		<!-- End Hero Section -->



		

		<div class="untree_co-section product-section before-footer-section">
		    <div class="container">
		      	<div class="row">
				  <?php 
					
					$sql = "SELECT * FROM product ORDER BY product_id DESC";

					$res = mysqli_query($GLOBALS['connect_database'], $sql) or die(mysqli_error());

					$products = '';

					if (mysqli_num_rows($res) > 0) {
						while($row = mysqli_fetch_assoc($res)){
							$product_id = $row['product_id'];
							$product_image = $row['product_image'];
							$product_name = $row['product_name'];
							$product_description = $row['product_description'];
							$price = $row['price'];

									
							$products .='

								<div class="col-12 col-md-4 col-lg-3 mb-5">
									<a class="product-item"href="'.'add_to_cart.php?id='.$product_id.'" >
										<img src="data:image/jpg; charset=utf8;base64,'. base64_encode($product_image).'" class="img-fluid product-thumbnail">
										<h3 class="product-title">'.$product_name.'</h3>
										<p class="">'.$product_description.'</p>
										<strong class="product-price">'.$price.'</strong>
			
										<span class="icon-cross" >
											<img src="images/cross.svg" class="img-fluid">
										</span>
									</a>
								</div> 

							';
						}
					}

					echo $products
			 ?>

		      		<!-- Start Column 1 -->
					
					<!-- End Column 1 -->
						
					
					

		      	</div>
		    </div>
		</div>

<?php 
        include "furni_footer.php";  
 ?>