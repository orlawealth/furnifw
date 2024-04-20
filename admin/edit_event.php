<?php 
	include"../core/init.php";
	verify_login($_SESSION['admin_id']);
	$title_error = "";
	$image_error = "";
	$event_id = (int)$_GET['id'] ?? '1';

	if (isset($_POST['submit'])) {
		$imag = $_FILES['image']['name'];
    	$event_image = $GLOBALS['connect_database']->real_escape_string('landing_images/'.$_FILES['image']['name']);
		$title = $_POST['title'];
		$description = $_POST['description'];
		$content = $_POST['content'];	

		if(empty($imag)){
			if(event_update_title_exist($title, $event_id)){
				$title_error = '*This title already exist';
			}
			if(empty($title_error)){
				if (update_event_without_image($title, $description, $content, $event_id)) {
					$_SESSION['success_message'] = 'event successfully updated';
					header('location: events.php');
				}else {
					$create_error = 'Sorry something went wrong. please try again';
				}
			}
		}else{
			if(event_update_title_exist($e_title, $post_id)){
				$title_error = '*This title already exist';
			}
			if(!preg_match("!image!", $_FILES['image']['type'])){
				$image_error = "Insert a file with .jpg, .jpeg, .png extension";
			}
			if(empty($image_error) and copy($_FILES['image']['tmp_name'], $event_image)){
				if (update_event_with_image($event_image, $title, $description, $content, $event_id)) {
					$_SESSION['success_message'] = 'event successfully updated';
					header('location: events.php');
				}else {
					$create_error = 'Sorry something went wrong. please try again';
				}
			}
		}


	}else{
		if (!isset($_GET['id'])) {
			header("Location:events.php");
		}else{
			$id = $_GET['id'] ?? '1';
			$event_id = (int)$id;
			if (find_event_by_id($event_id)) {
				$event = find_event_by_id($event_id);
			}else{
				header("Location:events.php");
			}
		}
		
	}


	include "admin_header.php";
?>
	<div class="container">	
		<div class="row">
			<div class="col-6 offset-3">	
					<h3 class="text-primary text-center">Edit Event Details</h3>
					<div class="mb-3">
						<img class="img-fluid" src="<?php if(!isset($_POST['submit'])){echo $event['event_image'];} ?>">
					</div>
					<form method ="post" enctype="multipart/form-data">
						<div class="form-group">
						<label class="form-control-label text-primary bold">Select event image</label><br>
						<input  type="file" name="image">
						<div><p class="errors form-text"><?php echo $image_error; ?></p></div>
					</div>
						<div class="form-group">
							<label class="form-control-label text-primary bold">In few words describe the event below</label>
							<p class="form-text">**This shouldn't be more than 500 words</p>
							<input class="form-control" type="text" name="title" value="<?php if(isset($title)){echo $title;}else{echo $event['event_title'];} ?>">
							<p class="form-text errors"><?php echo $title_error;?></p>
						</div>
						<div class="form-group">
							<label class="form-control-label text-primary bold">Event Description</label>
							<input class="form-control" type="text" name="description" value="<?php if(isset($title)){echo $description;}else{echo $event['event_description'];} ?>">
						</div>
						<div class="form-group">
							<label class="form-control-label text-primary bold">Event Content</label>
							<textarea class="form-control" id="edit" name="content"><?php if(isset($title)){echo $content;}else{echo $event['event_content'];} ?></textarea>
						</div>
						<input class="btn btn-primary" type="submit" name="submit" value="Update">
					</form>
			</div>	
		</div>	
	</div>	
	
<?php 
	include "admin_footer.php";
?>