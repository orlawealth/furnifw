<?php 
	include"../core/init.php";
	verify_login($_SESSION['admin_id']);
	include "admin_header.php";
?>
<div class="">
	<form method="post">
		<div class="form-group">
			<label class="form-control-label">Old password</label> <br>
			<input class="form-control" type="text" id="" name="current_password" placeholder="Enter current password" value="<?php if(isset($_POST['submit'])){echo $current_password;} ?>"> <br>
			<div class="error_message form-text"><?php echo $current_err ?></div>
		</div>
		<div class="form-group">
			<label class="form-control-label">Enter New password</label> <br>
			<input class="form-control" type="text" name="password" placeholder="Enter new password" value="<?php if(isset($_POST['submit'])){echo $password;} ?>"> <br>
		</div>
		<div class="form-group">
			<label class="form-control-label">Enter New password</label> <br>
			<input class="text" type="text" id="" name="confirm_password" placeholder="Confirm new password" value="<?php if(isset($_POST['submit'])){echo $confirm_password;} ?>"> <br>
			<div class="error_message form-text"><?php 	echo $password_err ?></div>
		</div>
		<input type="submit" name="submit" value="Change password">

	</form>
</div>
<?php 
	include "admin_footer.php";
?>