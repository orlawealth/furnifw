<?php 

	function product_name_exist($product_name){
		$product_name = escape(sanitize($product_name));

		$query = "SELECT product_id FROM product WHERE product_name = '$product_name'";
		$result = $GLOBALS['connect_database']->query($query);

		if(mysqli_num_rows($result) > 0){
			return true;
		}else{
			return false;
		}
	}

	function add_product($product_image, $product_name, $product_code, $product_description, $price, $stock_quantity, $admin_id){
		$product_name = escape(sanitize($product_name));
		$product_code = escape(sanitize($product_code));
		$product_description = escape(sanitize($product_description));
		$price = escape(sanitize($price));
		$stock_quantity = escape(sanitize($stock_quantity));
		$query = "INSERT INTO product (product_image, product_name, product_code, product_description, price, stock_quantity, admin_id) VALUES('$product_image','$product_name','$product_code','$product_description', '$price', '$stock_quantity', '$admin_id')";

		if(mysqli_query($GLOBALS['connect_database'], $query)){
			return true;
		}else{
			return false;
		}
	}
	function find_all_products(){
		$query = "SELECT * FROM product";
		// $query
		$result = mysqli_query($GLOBALS['connect_database'], $query);
		return $result;
 		mysqli_free_result($result);
	} 
	function find_product_by_id($product_id){
    		$query = "SELECT * FROM product WHERE product_id = $product_id";
    		$result = mysqli_query($GLOBALS['connect_database'], $query);

     		$product = mysqli_fetch_assoc($result);
     		mysqli_free_result($result);
     		return $product;
	}
	function product_exist($product_id){
		$query = "SELECT product_id FROM product WHERE product_id = '$product_id'";
		$result = $GLOBALS['connect_database']->query($query);

		if(mysqli_num_rows($result) > 0){
			return true;
		}else{
			return false;
		}
	}
	function delete_product($product_id){

		$query = "DELETE FROM product WHERE product_id = $product_id LIMIT 1";

		$result = mysqli_query($GLOBALS['connect_database'], $query);

		if($result){
			return true;
		}else{
			echo "not deleted";
		}
	}
	function product_update_name_exist($e_product_name, $product_id){
		$e_product_name = escape(sanitize($e_product_name));

		$query = "SELECT product_id FROM product WHERE product_name = '$e_product_name'  && product_id != $product_id  ";
		$result = mysqli_query($GLOBALS['connect_database'], $query);	
		if(mysqli_num_rows($result)> 0) {
			return true;
		}else{
			return false;
		}
	}

	function update_product_without_image($e_product_name, $e_product_code, $e_product_description, $e_price, $e_stock_quantity, $product_id){
		$e_product_name = escape(sanitize($e_product_name));
		$e_product_code = escape(sanitize($e_product_code));
		$e_product_description = escape(sanitize($e_product_description));

		$query = "UPDATE product SET ";
		$query .= "product_name = '$e_product_name', ";
		$query .= "product_code = '$e_product_code', ";
		$query .= "product_description = '$e_product_description', ";
		$query .= "price = '$e_price', ";
		$query .= "stock_quantity = '$e_stock_quantity' ";
		$query .= "WHERE product_id = $product_id";

		$result = mysqli_query($GLOBALS['connect_database'], $query);

		if($result){
			return true;
		}else{
			echo mysqli_error($GLOBALS['connect_database']);

		}

	}
	function update_product_with_image($e_product_image, $e_product_name, $e_product_code, $e_product_description, $e_price, $e_stock_quantity, $product_id){
		$e_product_name = escape(sanitize($e_product_name));
		$e_product_code = escape(sanitize($e_product_code));
		$e_product_description = escape(sanitize($e_product_description));

		$query = "UPDATE product SET ";
		$query .= "product_image = '$e_product_image', ";
		$query .= "product_name = '$e_product_name', ";
		$query .= "product_code = '$e_product_code', ";
		$query .= "product_description = '$e_product_description', ";
		$query .= "price = '$e_price' ,";
		$query .= "stock_quantity = '$e_stock_quantity' ";
		$query .= "WHERE product_id = $product_id";

		$result = mysqli_query($GLOBALS['connect_database'], $query);

		if($result){
			return true;
		}else{
			echo mysqli_error($GLOBALS['connect_database']);

		}

	}
?>