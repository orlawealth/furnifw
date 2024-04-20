<?php 
	include"../core/init.php";
	ini_set('display_errors', 1);
	verify_login($_SESSION['admin_id']);
	$title_error = "";
	$image_error = "";
	$product_id = (int)$_GET['id'] ?? '1';

	if (isset($_POST['submit'])) {
		$imag = $_FILES['e_product_image']['name'];


		$e_product_name = $_POST['e_product_name'];
		$e_product_code = $_POST['e_product_code'];
		$e_product_description = $_POST['e_product_description'];
		$e_price = $_POST['e_price'];
		$e_stock_quantity = $_POST['e_stock_quantity'];


		if(empty($imag)){
			if(product_update_name_exist($e_product_name, $product_id)){
				$title_error = '*This product name already exist';
			}
			if(empty($title_error)){
				if (update_product_without_image($e_product_name, $e_product_code, $e_product_description, $e_price, $e_stock_quantity, $product_id)) {
					$_SESSION['success_message'] = 'Product succcessfully updated';
					header('location: products.php');
				}else {
					$create_error = 'Sorry something went wrong. please try again';
				}
			}
		}else{
			if(product_update_name_exist($e_product_name, $product_id)){
				$title_error = '*This product name already exist';
			}
			if(!preg_match("!image!", $_FILES['e_product_image']['type'])){
				$image_error = "Insert a file with .jpg, .jpeg, .png extension";
			}
			if(empty($image_error)){
				$img_content = $_FILES['e_product_image']['tmp_name']; 
            	$e_product_image = addslashes(file_get_contents($img_content)); 
				if (update_product_with_image($e_product_image, $e_product_name, $e_product_code, $e_product_description, $e_price, $e_stock_quantity, $product_id)) {
					$_SESSION['success_message'] = 'Product successfully updated';
					header('location: products.php');
				}else {
					$create_error = 'Sorry something went wrong. please try again';
				}
			}
		}


	}else{
		$id = $_GET['id'] ?? '1';
		$product_id = (int)$id;
		if (find_product_by_id($product_id)) {
			$product = find_product_by_id($product_id);
		}else{
			header("Location:products.php");
		}
	}


	include "admin_header.php";
?>
	<div class="container">	
		<div class="row">
			<div class="col-6 offset-3">	
					<h3 class="text-success text-center">Edit product</h3>
					<div class="mb-3">
						<img class="img-fluid" src="data:image/jpg; charset=utf8;base64, <?php if(!isset($_POST['submit'])){echo base64_encode($product['product_image']);} ?>">
					</div>
					<form method ="post" enctype="multipart/form-data">
						<div class="form-group">
							<label class="form-control-label text-success bold">Select product image</label><br>
							<input  type="file" name="e_product_image">
							<div><p class="errors form-text"><?php echo $image_error; ?></p></div>
						</div>
						<div class="form-group">
							<label class="form-control-label text-success bold">Product name</label>
							<input class="form-control" type="text" name="e_product_name" value="<?php if(isset($e_product_name)){echo $e_product_name;}else{echo $product['product_name'];} ?>">
							<p class="form-text errors"><?php echo $title_error;  ?></p>
						</div>
						<div class="form-group">
							<label class="form-control-label text-success bold">Product code</label>
							<input class="form-control" type="text" name="e_product_code" value="<?php if(isset($e_product_code)){echo $e_product_code;}else{echo $product['product_code'];} ?>">
						</div>
						<div class="form-group">
							<label class="form-control-label text-success bold">Short description about product</label>
							<input class="form-control" type="text" name="e_product_description" value="<?php if(isset($e_product_description)){echo $e_product_description;}else{echo $product['product_description'];} ?>">
						</div>
						<div class="form-group">
							<label class="form-control-label text-success bold">Price(£)</label>
							<input class="form-control" type="text" name="e_price" value="<?php if(isset($e_price)){echo $e_price;}else{echo $product['price'];} ?>">
						</div>
						<div class="form-group">
							<label class="form-control-label text-success bold">Stock quantity</label>
							<input class="form-control" type="number" name="e_stock_quantity" value="<?php if(isset($e_stock_quantity)){echo $e_stock_quantity;}else{echo $product['stock_quantity'];} ?>">
						</div>

						<input class="btn btn-success" type="submit" name="submit" value="Update">
					</form>
			</div>	
		</div>	
	</div>	
	
<?php 
	include "admin_footer.php";
?>