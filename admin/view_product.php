<?php 
	include"../core/init.php";
	ini_set('display_errors', 1);
	verify_login($_SESSION['admin_id']);

		$product_id =(int)$_GET['id'] ?? '1';
		$product = find_product_by_id($product_id);

	include "admin_header.php";

?>
	<div class="container">	
		<div class=" pb-5 mt-5">
		
			
			<?php 	
				echo '	
				<div class =""><img class ="img-fluid" src ="data:image/jpg; charset=utf8;base64,'. base64_encode($product['product_image']).'"> </div>
				<p class=""> Product name: '.$product['product_name'].' </p>
				<p class=""> Product code: '.$product['product_code'].' </p>
				<p> Product description: '.$product['product_description'].' </p>
				<p> price: £'.$product['price'].' </p>
				<p> Quantity in stock : '.$product['stock_quantity'].' </p>

				';
			 ?>
		</div>
	</div>
	
	
<?php 
	include "admin_footer.php";
?>