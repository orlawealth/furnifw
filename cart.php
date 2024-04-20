<?php 
		 include "core/init.php";
		 ini_set('display_errors', 1);
  //    session_start();
  //     session_destroy();
      
  //     session_start();

	// header("location: shop.php");
		 //die("log in successful");
     $status="";
     if (isset($_POST['action']) && $_POST['action']=="remove"){
      if(!empty($_SESSION["shopping_cart"])) {
        foreach($_SESSION["shopping_cart"] as $key => $value) {
          if($_POST["code"] == $key){
          unset($_SESSION["shopping_cart"][$key]);
          $status = "<div class='box' style='color:red;'>
          Product is removed from your cart!</div>";
          }
          if(empty($_SESSION["shopping_cart"]))
            unset($_SESSION["shopping_cart"]);
          
        }		
      }
    }

    if (isset($_POST['submit'])){
      foreach($_SESSION["shopping_cart"] as &$value){
        if($value['code'] === $_POST["code"]){
            $value['quantity'] = $_POST["quantity"];
            break; // Stop the loop after we've found the product
        }
        }
    }
        include "furni_header.php";  
 ?>

		<!-- Start Hero Section -->
		
				<div class="container">
					<div class="row justify-content-between">
						<div class="col-lg-5">
							<div class="intro-excerpt">
								<h1>Cart</h1>
							</div>
						</div>
						<div class="col-lg-7">
							
						</div>
					</div>
				</div>
			
		<!-- End Hero Section -->

		

		<div class="untree_co-section before-footer-section">
            <div class="container">
              <div class="row mb-5">
                <form class="col-md-12" method="post" action="">
                  <div class="message_box" style="margin:10px 0px;">
                    <?php echo $status; ?>
                  </div>
                  <div class="site-blocks-table">
                <?php
                  if(isset($_SESSION["shopping_cart"])){
                      $total_price = 0;
                ?>	
                    <table class="table">
                      <thead>
                        <tr>
                          <th class="product-thumbnail">Image</th>
                          <th class="product-name">Product</th>
                          <th class="product-price">Price</th>
                          <th class="product-quantity">Quantity</th>
                          <th class="product-total">Total</th>
                          <th class="product-remove">Remove</th>
                        </tr>
                      </thead>
                  <?php		
                    foreach ($_SESSION["shopping_cart"] as $product){
                  ?>
                      <tbody>
                        <tr>
                          <td class="product-thumbnail">
                          <?php echo ' <img class="img-fluid" src="data:image/jpg; charset=utf8;base64,'. base64_encode($product['image']) .'" alt="Image" > ';  ?>
                          </td>
                          <td class="product-name">
                            <h2 class="h5 text-black"><?php echo ($product['name']) ?></h2>
                          </td>
                          <td>$<?php echo ($product['price']) ?></td>
                          <td>
                            <form method="post" action="" >
                              <div class="input-group mb-3 d-flex align-items-center quantity-container" style="max-width: 120px;">
                                <div class="input-group-prepend">
                                  <button class="btn btn-outline-black decrease" type="button">&minus;</button>
                                </div>
                                <input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
                                <input type='hidden' name='action' value="change" />
                                <input type="text" class="form-control text-center quantity-amount" name="quantity" value="<?php echo ($product['quantity']) ?>" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                                <div class="input-group-append">
                                  <button class="btn btn-outline-black increase" type="button">&plus;</button>
                                </div>
                                <button type="submit" name="submit" class="btn btn-outline-black ">Update item total</button>
                              </div>
                            </form>
                          </td>
                          <td><?php echo $product["price"]*$product["quantity"]; ?></td>
                          <td>
                            <form method='post' action=''>
                                <input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
                                <input type='hidden' name='action' value="remove" />
                                <button type='submit' class='btn btn-black text-danger btn-sm'>Remove Item</button>
                            </form>
                          </td>
                  <?php
                
                      $total_price += ($product["price"]*$product["quantity"]);
                  
                    }
                  ?>
                        </tr>
                      </tbody>
                    </table>
                    
              <?php
                }else{
                  echo "<h3>Your cart is empty!</h3>";
                  
                  }
              ?>
                    
                  </div>
                </form>
              </div>

          <?php
              if(isset($_SESSION["shopping_cart"])){
          ?>	
              <div class="row">
                <div class="col-md-6">
                  <div class="row mb-5">
                    <div class="col-md-6">
                      <a href="shop.php" class="btn btn-outline-black btn-sm btn-block">Continue Shopping</a>
                    </div>
                  </div>
                </div>
               
                <div class="col-md-6 pl-5">
                  <div class="row justify-content-end">
                    <div class="col-md-7">
                      <div class="row">
                        <div class="col-md-12 text-right border-bottom mb-5">
                          <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <div class="col-md-6">
                          <span class="text-black">Subtotal</span>
                        </div>
                        <div class="col-md-6 text-right">
                          <strong class="text-black">£ <?php echo $total_price; ?></strong>
                        </div>
                      </div>
                      <div class="row mb-5">
                        <div class="col-md-6">
                          <span class="text-black">Total</span>
                        </div>
                        <div class="col-md-6 text-right">
                          <strong class="text-black">£ <?php echo $total_price; ?></strong>
                        </div>
                      </div>
        
                      <div class="row">
                        <div class="col-md-12">
                          <button class="btn btn-black btn-lg py-3 btn-block" onclick="window.location='checkout.php'">Proceed To Checkout</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
        <?php
            }else{
              echo '
              <div class="row">
                <div class="col-md-6">
                  <div class="row mb-5">
                    <div class="col-md-6">
                      <a href="shop.php" class="btn btn-outline-black btn-sm btn-block">Add items to your cart</a>
                    </div>
                  </div>
                </div>
               </div> 
              
              ';
              
              }
           ?>

            </div>
          </div>
		

<?php 
	include "furni_footer.php";  
?>