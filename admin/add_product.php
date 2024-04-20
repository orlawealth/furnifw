<?php 
chmod("/admin/add_product.php", 0644);

	include "../core/init.php";
	ini_set('display_errors', 1);
	verify_login($_SESSION['admin_id']);
		$empty_error = "";
		$success_message = "";
		$create_error = "";
		$title_error = "";
		$image_error = "";

	if (isset($_POST['submit'])) {
		$admin_id = $_SESSION['admin_id'];
    	$product_image_name = $_FILES['product_image']['name'];
		$product_name = $_POST['product_name'];
		$product_code = $_POST['product_code'];
		$product_description = $_POST['product_description'];
		$price = $_POST['price'];
		$stock_quantity = $_POST['stock_quantity'];

		$required_fields = ["product_image_name", "product_name", "product_code", "description", "price", "stock_quantity"]; 
		foreach ($_POST as $key => $value) {
			if (empty($value) and in_array($key, $required_fields)) {
				$empty_error = '*Fill all the fields';
			}
		}
		if (empty($empty_error)){
			if(product_name_exist($product_name)){
				$title_error = '*This product name already exist';
			}
			if(!preg_match("!image!", $_FILES['product_image']['type'])){
				$image_error = "Insert a file with .jpg, .jpeg, .png extension";
			}
			if(empty($image_error)){
				$img_content = $_FILES['product_image']['tmp_name']; 
            	$product_image = addslashes(file_get_contents($img_content)); 
				if (add_product($product_image, $product_name, $product_code, $product_description, $price, $stock_quantity, $admin_id)) {
					$_SESSION['success_message'] = 'Product added successfully';
				
					header('location: products.php');
				}else {
					$create_error = 'Sorry something went wrong. please try again';
				}
			}
		}
	}

include "admin_header.php";
?>
<div class="container">	
	<div class="row">
		<div class="col-6 offset-3">	
					<h3 class="text-success text-center">Add new product</h3>
					<div><p class="errors"><?php echo $empty_error; ?></p></div>
					<form method ="post" enctype="multipart/form-data">
						<div class="form-group">
							<label class="form-control-label text-success bold">Select product image</label><br>
							<input  type="file" name="product_image">
							<div><p class="errors form-text"><?php echo $image_error; ?></p></div>
						</div>
						<div class="form-group">
							<label class="form-control-label text-success bold">Product name</label>
							<input class="form-control" type="text" name="product_name" value="<?php if(isset($product_name)){echo $product_name;} ?>">
							<p class="form-text errors"><?php echo $title_error;  ?></p>
						</div>
						<div class="form-group">
							<label class="form-control-label text-success bold">Product code</label>
							<input class="form-control" type="text" name="product_code" value="<?php if(isset($product_code)){echo $product_code;} ?>">
						</div>
						<div class="form-group">
							<label class="form-control-label text-success bold">Short description about product</label>
							<input class="form-control" type="text" name="product_description" value="<?php if(isset($product_description)){echo $product_description;} ?>">
						</div>
						<div class="form-group">
							<label class="form-control-label text-success bold">Price(£)</label>
							<input class="form-control" type="text" name="price" value="<?php if(isset($price)){echo $price;} ?>">
						</div>
						<div class="form-group">
							<label class="form-control-label text-success bold">Stock quantity</label>
							<input class="form-control" type="number" name="stock_quantity" value="<?php if(isset($stock_quantity)){echo $stock_quantity;} ?>">
						</div>
						
						<input class="btn btn-success" type="submit" name="submit" value="Add product">
					</form>
		</div>	
	</div>	
</div>	
<?php
include "admin_footer.php";
?>
