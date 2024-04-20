<?php 

function email_exists($email){
	$email = sanitize($email);

	$query = "SELECT customer_id FROM customer WHERE email = '$email' ";
	$result = $GLOBALS['connect_database']->query($query);

	if (mysqli_num_rows($result)>0) {
		return true;
	} else{
		return false;
	}

}
function add_customer($c_fname, $c_email, $addressArray, $c_phone){
	$c_fname = escape(sanitize($c_fname));
	$c_email = escape(sanitize($c_email));
	$c_phone = escape(sanitize($c_phone));
	$addressArray = serialize($addressArray);
	
	$query = "INSERT INTO customer (full_name, email, address, phone_number) VALUES('$c_fname', '$c_email', '$addressArray', '$c_phone')";

	if(mysqli_query($GLOBALS['connect_database'], $query)){
		return true;
	}else{
		return false;
	}
}

function add_customer_with_password($c_fname, $c_email, $addressArray, $c_phone, $c_password){
	$c_fname = escape(sanitize($c_fname));
	$c_email = escape(sanitize($c_email));
	$c_phone = escape(sanitize($c_phone));
	$addressArray = serialize($addressArray);
	
	$query = "INSERT INTO customer (full_name, email, address, phone_number, password) VALUES('$c_fname', '$c_email', '$addressArray', '$c_phone', '$c_password')";

	if(mysqli_query($GLOBALS['connect_database'], $query)){
		return true;
	}else{
		return false;
	}
}

function add_token_data($email, $key, $expDate){
	$email = escape(sanitize($email));
	$key = escape(sanitize($key));
	$expDate = escape(sanitize($expDate));
	$query = "INSERT INTO `password_reset_temp` (`email`, `key`, `expDate`)
	VALUES ('".$email."', '".$key."', '".$expDate."')";

	if(mysqli_query($GLOBALS['connect_database'], $query)){
			return true;
	}else{
			return false;
	}
}
function verify_token($email, $key){
	$email = escape(sanitize($email));
	$key = escape(sanitize($key));
	$query = "SELECT * FROM `password_reset_temp` WHERE `key`='".$key."' and `email`='".$email."'";
	$result = $GLOBALS['connect_database']->query($query);
 	$row = mysqli_fetch_assoc($result);

	if (mysqli_num_rows($result)>0) {
		return true;
	}else{
		return false;
	}
}

function select_token($email, $key){
	$email = escape(sanitize($email));
	$key = escape(sanitize($key));
	$query = "SELECT * FROM `password_reset_temp` WHERE `key`='".$key."' and `email`='".$email."'";
	$result = $GLOBALS['connect_database']->query($query);
 	$row = mysqli_fetch_assoc($result);
 	return $row;

 }
 function reset_password($password, $email){
		$email = escape(sanitize($email));
		$password = escape(sanitize($password));
		$password = md5($password);

		$query = "UPDATE customer SET ";
		$query .= "password = '$password' ";
		$query .= "WHERE email = '$email'";

		$result = mysqli_query($GLOBALS['connect_database'], $query);

		if($result){
			return true;
		}else{
			echo mysqli_error($GLOBALS['connect_database']);

		}
}
function delete_token($email){
	$email = escape(sanitize($email));
	$query = "DELETE FROM password_reset_temp WHERE `email`='".$email."'";
	if(mysqli_query($GLOBALS['connect_database'], $query)){
			return true;
	}else{
			return false;
	}

}

function add_user($full_name, $email, $phone_number, $gender, $country, $password, $token){
		$full_name = escape(sanitize($full_name));
		$email = escape(sanitize($email));
		$phone_number = escape(sanitize($phone_number));
		$gender = escape(sanitize($gender));
		$country = escape(sanitize($country));
		$password = escape(sanitize($password));
		$password = md5($password);
		$query = "INSERT INTO customer (full_name, email, phone_number, gender, country, password, token) VALUES('$full_name', '$email', '$phone_number', '$gender', '$country', '$password', '$token')";

		if(mysqli_query($GLOBALS['connect_database'], $query)){
			return true;
		}else{
			return false;
		}
}
function find_all_customers(){
		$query = "SELECT * FROM customer";
		// $query
		$result = mysqli_query($GLOBALS['connect_database'], $query);
		return $result;
 		mysqli_free_result($result);
}
function find_customer_by_id($customer_id){
		$query = "SELECT * FROM customer WHERE customer_id = $customer_id";
		$result = mysqli_query($GLOBALS['connect_database'], $query);

 		$customer = mysqli_fetch_assoc($result);
 		mysqli_free_result($result);
 		return $customer;
}
function find_customer_by_email($email){
		$query = "SELECT * FROM customer WHERE email = '$email'";
		$result = mysqli_query($GLOBALS['connect_database'], $query);
 		$customer = mysqli_fetch_assoc($result);
 		return $customer;
}
function admin_exist($admin_id){
	$query = "SELECT admin_id FROM admin WHERE admin_id = '$admin_id'";
	$result = $GLOBALS['connect_database']->query($query);

	if(mysqli_num_rows($result) > 0){
		return true;
	}else{
		return false;
	}
}
function delete_customer($customer_id){

	$query = "DELETE FROM customer WHERE customer_id = $customer_id LIMIT 1";

	$result = mysqli_query($GLOBALS['connect_database'], $query);

	if($result){
		return true;
	}else{
		echo "not deleted";
	}
}
function email_exists_update($email, $customer_id){
		$email = escape(sanitize($email));
		$customer_id = escape(sanitize($customer_id));

		$query = "SELECT customer_id FROM customer WHERE email = '$email' && customer_id != $customer_id ";
		// $result = $GLOBALS['connect_database']->query($query); OR
		$result =  mysqli_query($GLOBALS['connect_database'], $query); 

		if (mysqli_num_rows($result)>0) {
			return true;
		} else{
			return false;
		}
	}
function update_customer($full_name, $email, $phone_number, $gender, $country, $customer_id){
		$full_name = escape(sanitize($full_name));
		$email = escape(sanitize($email));
		$phone_number = escape(sanitize($phone_number));
		$gender = escape(sanitize($gender));
		$country = escape(sanitize($country));

		$query = "UPDATE customer SET ";
		$query .= "full_name = '$full_name', ";
		$query .= "email = 'email', ";
		$query .= "phone_number = '$phone_number', ";
		$query .= "gender = '$gender', ";
		$query .= "country = '$country' ";
		$query .= "WHERE customer_id = $customer_id";

		$result = mysqli_query($GLOBALS['connect_database'], $query);

		if($result){
			return true;
		}else{
			echo mysqli_error($GLOBALS['connect_database']);

		}
}
function verify_customer($email, $password){
		$username = escape(sanitize($email));
		$password = escape(sanitize($password));
		$query = "SELECT customer_id FROM customer WHERE email = '$email' AND password = '$password'";	

		$result = $GLOBALS['connect_database']->query($query);
		if (mysqli_num_rows($result)>0){
			if ( mysqli_num_rows($result) < 2) {
				return true;
			}
		}else{
			return false;
		}	

}
function get_customer_id($email){
		$email = escape(sanitize($email));
		$query = mysqli_query($GLOBALS['connect_database'], "SELECT customer_id FROM customer WHERE email = '$email' ");

		$result = mysqli_fetch_row($query);
		return $result[0]; 
}
function verify_log($id){ // checks if customer is logged in
		if(isset($id)){
    	}else{ 
        header('location: login.php');
    	}
}
function sendVerificationEmail($customerEmail, $token){
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
        <p>Thank you for signing up on our site. Please click on the link below to verify your account:.</p>
        <a href="verify_email.php?token=' . $token . '">Verify Email!</a>
      </div>
    </body>

    </html>';

    // Create a message
    $message = (new Swift_Message('Verify your email'))
        ->setFrom('tunadollar@gmail.com')
        ->setTo($customerEmail)
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