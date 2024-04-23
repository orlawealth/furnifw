<?php 
		 include "core/init.php";
		 ini_set('display_errors', 1);
		 //die("log in successful");
         $status="";
        
         // Check if product is coming or not
        if (isset($_POST['code']) && $_POST['code']!="") {
            $code = $_POST['code'];
           // die($code . "is code");
            
            $result = mysqli_query($GLOBALS['connect_database'], "SELECT * FROM `product` WHERE `product_code` = '$code' ");
           // $result = mysqli_query($con,"SELECT * FROM 'product' WHERE 'product_id'='$code'");
            $row = mysqli_fetch_assoc($result);
            $product_id = $row['product_id'];
            $name = $row['product_name'];
            $code = $row['product_code'];
            $price = $row['price'];
            $image = $row['product_image'];
            $description = $row['product_description'];
            // die($product_id);
            
            $cartArray = array(
                $code=>array(
                'name'=>$name,
                'product_id'=>$product_id,
                'code'=>$code,
                'price'=>$price,
                'quantity'=>1,
                'image'=>$image)
            );
           
            if(empty($_SESSION["shopping_cartfw"])) {
                $_SESSION["shopping_cartfw"] = $cartArray;
                $status = "<div class='box' style='color: green;'>Product is added to your cart!</div>";
                
            }else{
                $array_keys = array_keys($_SESSION["shopping_cartfw"]);
                if(in_array($code,$array_keys)) {
                    $status = "<div class='box' style='color:red;'>
                    Product is already added to your cart!</div>";	
                    
                }else {
                $_SESSION["shopping_cartfw"] = array_merge($_SESSION["shopping_cartfw"],$cartArray);
                $status = "<div class='box' style='color:green;'>Product is added to your cart!</div>";
                }
            
                }
            
        }else{
            $id = $_GET['id'] ?? '1';
            $product_id = (int)$id;
            if (find_product_by_id($product_id)) {
                $product = find_product_by_id($product_id);
                 //s die($product['product_code'] . "is code");
            }else{
                header("Location:shop.php");
            }
        }

        include "furni_header.php";  
 ?>

		<!-- Start Hero Section -->
			<!-- <div class="hero">
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
			</div> -->
		<!-- End Hero Section -->


		

		<div class="untree_co-section product-section before-footer-section">
		    <div class="container">
		      	<div class="row">
       
                    <div class="col-6 col-md-2 col-lg-3 mb-5">
                    <img class ="img-fluid" src ="data:image/jpg; charset=utf8;base64, <?php if(isset($_POST['code'])){echo base64_encode($image);}else{echo base64_encode($product['product_image']);}?>">
                    </div>

                    <div class="col-6 col-md-2 col-lg-3 mb-5">
                        <form method ="post" action="">
                        <div class="message_box" style="margin:10px 0px;"><?php echo $status; ?></div>
                            <h3 class="product-title"><?php if(isset($_POST['code'])){echo $name;}else{echo $product['product_name'];}?></h3>
                            <input type="hidden" name="code" value="<?php if(isset($_POST['code'])){echo $product_code;}else{echo $product['product_code'];}?>" />
                            <p class=""><?php if(isset($_POST['code'])){echo $description;}else{echo $product['product_description'];}?> </p>
                            <strong class="product-price"> £ <?php if(isset($_POST['code'])){echo $price;}else{echo $product['price'];}?> </strong>
                            <div class = 'mt-2'> <button type='submit' class='btn btn-success'>Add to cart</button></div>
                            <a href="shop.php" class="mt-2 btn btn-outline-black btn-sm btn-block">Continue Shopping</a>
                        </form>
                    </div>
                   

					
			      

        
				

		      		<!-- Start Column 1 -->
					
					<!-- End Column 1 -->
						
					
					

		      	</div>
		    </div>
		</div>

<?php 
        include "furni_footer.php";  
 ?>