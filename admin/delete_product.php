<?php 
	include"../core/init.php";
	ini_set('display_errors', 1);
	verify_login($_SESSION['admin_id']);

	$product_id = (int)$_GET['id'] ?? '1';
	$product = find_product_by_id($product_id);
	$product_name = $product['product_name'];


	if(isset($_POST['submit'])) {
		if(product_exist($product_id)){
			if (delete_product($product_id)) {
				$_SESSION['deleted'] = "The product has been deleted";
				header('location:products.php');
			}
		}else{
			$_SESSION['deleted'] = "The product does not exist";
				header('location:products.php');
		}

	}else{
		$product_id = (int)$_GET['id'] ?? '1';
			if (find_product_by_id($product_id)) {
				$product = find_product_by_id($product_id);
			}else{
				header('location:products.php');
			}
	}


	include "admin_header.php";
?>

	<div class="container">	
		<h1 class="text-danger">Delete Product</h1>
		<p>	Are you sure you want to delete this product?</p>
		<p class="bold">	<?php echo $product['product_name']; ?></p>

		<form action="#" method="post">	
			<div class="row pb-5">
				<div class="col-2"><input class=" btn btn-danger" type="submit" name="submit" value="Delete"></div>
				<a class="btn btn-success" href="products.php">NO </a>
			</div>
		</form>
	</div>

<?php 
	include "admin_footer.php";
?>