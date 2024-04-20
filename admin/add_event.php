<?php 
	include "../core/init.php";
	verify_login($_SESSION['admin_id']);
		$empty_error = "";
		$success_message = "";
		$create_error = "";
		$title_error = "";
		$image_error = "";

	if (isset($_POST['submit'])) {
    	$event_image = $GLOBALS['connect_database']->real_escape_string('landing_images/'.$_FILES['image']['name']);
		$title = $_POST['title'];
		$description = $_POST['description'];
		$content = $_POST['content'];
		$meet_link = $_POST['meet_link'];
		$meet_id = $_POST['meet_id'];
		$meet_pass = $_POST['meet_pass'];

		$required_fields = ["image", "title", "description", "content"]; 
		foreach ($_POST as $key => $value) {
			if (empty($value) and in_array($key, $required_fields)) {
				$empty_error = '*Fill all the fields';
			}
		}
		if (empty($empty_error)){
			if(event_title_exist($title)){
				$title_error = '*This title already exist';
			}
			if(!preg_match("!image!", $_FILES['image']['type'])){
				$image_error = "Insert a file with .jpg, .jpeg, .png extension";
			}
			if(empty($image_error) and copy($_FILES['image']['tmp_name'], $event_image)){
				if (empty($meet_link)) {
					if (create_event($event_image, $title, $description, $content)) {
						$_SESSION['success_message'] = 'Event successfully created';
						header('location: events.php');
					}else {
						$create_error = 'Sorry something went wrong. please try again';
					}
				}else {
					if (create_event_web($event_image, $title, $description, $content, $meet_link, $meet_id, $meet_pass)) {
						$_SESSION['success_message'] = 'Event successfully created';
						header('location: events.php');
					}else {
						$create_error = 'Sorry something went wrong. please try again';
					}
				}
			}
		}
	}

include "admin_header.php";
?>
<div class="container">	
	<div class="row">
		<div class="col-6 offset-3">	
					<h3 class="text-primary text-center">Add New Event</h3>
					<div><p class="errors"><?php echo $empty_error; ?></p></div>
					<form method ="post" enctype="multipart/form-data">
						<div class="form-group">
							<label class="form-control-label text-primary bold">Select Event image</label><br>
							<input  type="file" name="image">
							<div><p class="errors form-text"><?php echo $image_error; ?></p></div>
						</div>
						<div class="form-group">
							<label class="form-control-label text-primary bold">Theme of the event</label>
							<input class="form-control" type="text" name="title" value="<?php if(isset($title)){echo $title;} ?>">
							<p class="form-text errors"><?php echo $title_error;  ?></p>
						<div class="form-group">
							<label class="form-control-label text-primary bold">In few words describe the event below</label>
							<p class="form-text">**This shouldn't be more than 500 words</p>
							<input class="form-control" type="text" name="description" value="<?php if(isset($title)){echo $description ;} ?>">
						</div>
						<div class="form-group">
							<label class="form-control-label text-primary bold">Full Detail about the event</label>
							<textarea class="form-control" id="edit" name="content"><?php if(isset($title)){echo $content;} ?></textarea>
						</div>
						</div>
						<div class="form-group">
							<label class="form-control-label text-primary bold">**For webinar events</label>
							<input class="form-control" type="text" name="meet_link" value="<?php if(isset($title)){echo $meet_link;} ?>" placeholder="Enter meeting link"> <br>
							<input class="form-control" type="text" name="meet_id" value="<?php if(isset($title)){echo $meet_id;} ?>" placeholder="Enter meeting ID"> <br>
							<input class="form-control" type="text" name="meet_pass" value="<?php if(isset($title)){echo $meet_pass;} ?>" placeholder="Enter meeting password"> <br>
						</div>
						<input class="btn btn-primary" type="submit" name="submit" value="Add Event">
					</form>
		</div>	
	</div>	
</div>	
<?php
include "admin_footer.php";
?>
