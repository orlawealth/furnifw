<?php 
	function resource_title_exist($title){
		$title = escape(sanitize($title));

		$query = "SELECT resource_id FROM resources WHERE resource_name = '$title'";
		$result = $GLOBALS['connect_database']->query($query);

		if(mysqli_num_rows($result) > 0){
			return true;
		}else{
			return false;
		}
	}
	
	function create_resource($resource_name, $resource_size, $resource_download ){
		$resource_name = escape(sanitize($resource_name));
		$resource_size = escape(sanitize($resource_size));
		$query = "INSERT INTO resources (resource_name, resource_size, resource_download) VALUES('$resource_name','$resource_size','$resource_download')";

		if(mysqli_query($GLOBALS['connect_database'], $query)){
			return true;
		}else{
			return false;
		}
	}

	function find_all_resources(){
		$query = "SELECT * FROM resources";
		// $query
		$result = mysqli_query($GLOBALS['connect_database'], $query);
		return $result;
 		mysqli_free_result($result);
	} 
	function find_resource_by_id($resource_id){
    		$query = "SELECT * FROM resources WHERE resource_id = $resource_id";
    		$result = mysqli_query($GLOBALS['connect_database'], $query);

     		$resource = mysqli_fetch_assoc($result);
     		mysqli_free_result($result);
     		return $resource;
	}
	function resource_update_title_exist($e_title, $resource_id){
		$e_title = escape(sanitize($e_title));

		$query = "SELECT resource_id FROM resource WHERE resource_title = '$e_title'  && resource_id != $resource_id  ";
		$result = mysqli_query($GLOBALS['connect_database'], $query);	
		if(mysqli_num_rows($result)> 0) {
			return true;
		}else{
			return false;
		}
	}
	function update_resource_without_image($e_title, $e_description, $e_content, $post_id){
		$title = escape(sanitize($e_title));
		$description = escape(sanitize($e_description));

		$query = "UPDATE resource SET ";
		$query .= "resource_title = '$e_title', ";
		$query .= "resource_description = '$e_description', ";
		$query .= "resource_content = '$e_content' ";
		$query .= "WHERE resource_id = $post_id";

		$result = mysqli_query($GLOBALS['connect_database'], $query);

		if($result){
			return true;
		}else{
			echo mysqli_error($GLOBALS['connect_database']);

		}

	}
	function update_resource_with_image($e_landing_image, $e_title, $e_description, $e_content, $post_id){
		$title = escape(sanitize($e_title));
		$description = escape(sanitize($e_description));

		$query = "UPDATE resource SET ";
		$query .= "resource_image = '$e_landing_image', ";
		$query .= "resource_title = '$title', ";
		$query .= "resource_description = '$description', ";
		$query .= "resource_content = '$e_content' ";
		$query .= "WHERE resource_id = $post_id";

		$result = mysqli_query($GLOBALS['connect_database'], $query);

		if($result){
			return true;
		}else{
			echo mysqli_error($GLOBALS['connect_database']);

		}

	}
	function update_download($id,$newCount){
		$query = "UPDATE resources SET ";
        $query .= "resource_download = '$newCount' ";
        $query .= "WHERE resource_id = $id";
       	$result = mysqli_query($GLOBALS['connect_database'], $query);
       	if($result){
			return true;
		}else{
			echo mysqli_error($GLOBALS['connect_database']);

		}
	}
	function resource_exist($resource_id){
		$query = "SELECT resource_id FROM resources WHERE resource_id = '$resource_id'";
		$result = $GLOBALS['connect_database']->query($query);

		if(mysqli_num_rows($result) > 0){
			return true;
		}else{
			return false;
		}
	}
	function delete_resource($resource_id){

		$query = "DELETE FROM resources WHERE resource_id = $resource_id LIMIT 1";

		$result = mysqli_query($GLOBALS['connect_database'], $query);

		if($result){
			return true;
		}else{
			echo "not deleted";
		}
	}
?>