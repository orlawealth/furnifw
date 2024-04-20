<?php
	// General 
	function sanitize($input){
		$input = htmlspecialchars($input);
		$input = stripslashes($input);
		$input = trim($input);
		$input = htmlentities($input);

		// $input = mysqli_real_escape_string($GLOBALS['connect_database'], $input);


		return $input;
	}
	function escape($value){ 
		$value = mysqli_real_escape_string($GLOBALS['connect_database'], $value);
		return $value;

	}

	function verify_login($id){ // checks if user is logged in
		if(isset($id)){
    	}else{ 
        header('location: ../admin.php');
    	}
	}
	// user
	function admin_exists($username){
		$username = escape(sanitize($username));

		$query = "SELECT admin_id FROM admin WHERE username = '$username' ";
		// $result = $GLOBALS['connect_database']->query($query); OR
		$result =  mysqli_query($GLOBALS['connect_database'], $query);

		if (mysqli_num_rows($result)>0) {
			return true;
		} else{
			return false;
		}
	}

function verify_admin($username, $password){
		$username = sanitize($username);
		$username = escape($username);
		$password = sanitize($password);
		$password = escape($password);

		$query = "SELECT admin_id FROM admin WHERE username = '$username' AND password = '$password'";	

		$result = $GLOBALS['connect_database']->query($query);
		if (mysqli_num_rows($result)>0){
			if ( mysqli_num_rows($result) < 2) {
				return true;
			}
		}else{
			return false;
		}	

}

		function get_admin_id($username){
			$username = escape(sanitize($username));
			$query = mysqli_query($GLOBALS['connect_database'], "SELECT admin_id FROM admin WHERE username = '$username' ");

			$result = mysqli_fetch_row($query);
			return $result[0]; 
		}
?>