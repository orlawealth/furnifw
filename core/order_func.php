<?php 
function add_customer_order($customer_id, $itemsordered, $total_price, $tax_paid){
	
	$query = "INSERT INTO customerOrder (customer_id, itemsordered, total_price, tax_paid) VALUES('$customer_id', '$itemsordered', '$total_price', '$tax_paid')";

	if(mysqli_query($GLOBALS['connect_database'], $query)){
		return true;
	}else{
		return false;
	}
}

function find_all_customerorders(){
	$query = "SELECT * FROM customerOrder";
	// $query
	$result = mysqli_query($GLOBALS['connect_database'], $query);
	return $result;
	 mysqli_free_result($result);
} 

function add_order( $product_id, $quantity){

	$query = "INSERT INTO theorder (product_id, quantity) VALUES('$product_id', '$quantity')";

	if(mysqli_query($GLOBALS['connect_database'], $query)){
		return true;
	}else{
		return false;
	}
}

	function order_title_exist($title){
		$title = escape(sanitize($title));

		$query = "SELECT order_id FROM orders WHERE order_title = '$title'";
		$result = $GLOBALS['connect_database']->query($query);

		if(mysqli_num_rows($result) > 0){
			return true;
		}else{
			return false;
		}
	}
	function create_order($landing_image, $title, $description, $content){
		$title = escape(sanitize($title));
		$description = escape(sanitize($description));
		$query = "INSERT INTO orders (order_image, order_title, order_description, order_content) VALUES('$landing_image','$title','$description', '$content')";

		if(mysqli_query($GLOBALS['connect_database'], $query)){
			return true;
		}else{
			return false;
		}
	}
	function subscribe($id, $subscribe){
		$id = escape(sanitize($id));
		$query = "INSERT INTO orders (subscribe) VALUES('$subscribe')";

		$query = "UPDATE order SET ";
		$query .= "subscribe = '$subscribe' ";
		$query .= "WHERE order_id = $id";

		if(mysqli_query($GLOBALS['connect_database'], $query)){
			return true;
		}else{
			return false;
		}
	}
	function create_order_web($landing_image, $title, $description, $content, $meet_link, $meet_id, $meet_pass){
		$title = escape(sanitize($title));
		$description = escape(sanitize($description));
		$meet_link = escape(sanitize($meet_link));
		$meet_id = escape(sanitize($meet_id));
		$meet_pass = escape(sanitize($meet_pass));
		$query = "INSERT INTO orders (order_image, order_title, order_description, order_content, meet_link, meet_id, meet_pass) VALUES('$landing_image','$title','$description', '$content', '$meet_link', '$meet_id', '$meet_pass')";

		if(mysqli_query($GLOBALS['connect_database'], $query)){
			return true;
		}else{
			mysqli_error($GLOBALS['connect_database']);
		}
	}
	function find_all_orders(){
		$query = "SELECT * FROM theorder";
		// $query
		$result = mysqli_query($GLOBALS['connect_database'], $query);
		return $result;
 		mysqli_free_result($result);
	} 



	function find_order_by_id($order_id){
    		$query = "SELECT * FROM orders WHERE order_id = $order_id";
    		$result = mysqli_query($GLOBALS['connect_database'], $query);

     		$order = mysqli_fetch_assoc($result);
     		mysqli_free_result($result);
     		return $order;
	}
	function order_update_title_exist($e_title, $order_id){
		$e_title = escape(sanitize($e_title));

		$query = "SELECT order_id FROM orders WHERE order_title = '$e_title'  && order_id != $order_id  ";
		$result = mysqli_query($GLOBALS['connect_database'], $query);	
		if(mysqli_num_rows($result)> 0) {
			return true;
		}else{
			return false;
		}
	}
	function update_order_without_image($e_title, $e_description, $e_content, $post_id){
		$title = escape(sanitize($e_title));
		$description = escape(sanitize($e_description));

		$query = "UPDATE orders SET ";
		$query .= "order_title = '$e_title', ";
		$query .= "order_description = '$e_description', ";
		$query .= "order_content = '$e_content' ";
		$query .= "WHERE order_id = $post_id";

		$result = mysqli_query($GLOBALS['connect_database'], $query);

		if($result){
			return true;
		}else{
			echo mysqli_error($GLOBALS['connect_database']);

		}

	}
	function update_order_with_image($e_landing_image, $e_title, $e_description, $e_content, $post_id){
		$title = escape(sanitize($e_title));
		$description = escape(sanitize($e_description));

		$query = "UPDATE orders SET ";
		$query .= "order_image = '$e_landing_image', ";
		$query .= "order_title = '$title', ";
		$query .= "order_description = '$description', ";
		$query .= "order_content = '$e_content' ";
		$query .= "WHERE order_id = $post_id";

		$result = mysqli_query($GLOBALS['connect_database'], $query);

		if($result){
			return true;
		}else{
			echo mysqli_error($GLOBALS['connect_database']);

		}

	}
	function order_exist($order_id){
		$query = "SELECT order_id FROM orders WHERE order_id = '$order_id'";
		$result = $GLOBALS['connect_database']->query($query);

		if(mysqli_num_rows($result) > 0){
			return true;
		}else{
			return false;
		}
	}
	function delete_order($order_id){

		$query = "DELETE FROM orders WHERE order_id = $order_id LIMIT 1";

		$result = mysqli_query($GLOBALS['connect_database'], $query);

		if($result){
			return true;
		}else{
			echo "not deleted";
		}
	}

	function sendSubscriptionEmail($userEmail, $order_title, $meet_link, $meet_id, $meet_pass){
    global $mailer;
    $body = '<!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="UTF-8">
      <title>Test mail</title>
      <style>
        .wrapper {
          padding: 20px;
          color: #444;
          font-size: 1.3em;
        }
        a {
          background: #592f80;
          text-decoration: none;
          padding: 8px 15px;
          border-radius: 5px;
          color: #fff;
        }
      </style>
    </head>

    <body>
      <div class="wrapper">
        <p>Naijatestcrowd is inviting you to a scheduled Zoom meeting.</p>
        <p>Topic: '.$order_title.'</p>
        <p> Join Zoom Meeting</p> 
        <p><a href="'.$meet_link.'">'.$meet_link.'</a></p>
        <p>Meeting ID: '.$meet_id.'</p>
        <p>Password: '.$meet_pass.'</p>
      </div>
    </body>

    </html>';

    // Create a message
    $message = (new Swift_Message('Verify your email'))
        ->setFrom('tunadollar@gmail.com')
        ->setTo($userEmail)
        ->setBody($body, 'text/html');

    // Send the message
    $result = $mailer->send($message);

    if ($result > 0) {
        return true;
    } else {
        return false;
    }
}
?>