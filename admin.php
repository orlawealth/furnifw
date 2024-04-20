<?php 
		 include "core/init.php";
		 ini_set('display_errors', 1);
		 //die("log in successful");
         if(isset($_SESSION['admin_id'])){
            header('location: admin/index.php');
        }
    
        $error = "";
        $username_error = "";
        $login_error = "";

         if (isset($_POST['submit'])){
            // die("logged in ssuccesful");
            $username = $_POST['username'];
            $password = $_POST['password'];
      
            if(!admin_exists($username)){
                $username_error = "*Username does not exist";
            }else{
                if (!verify_admin($username, $password)) {
                    $login_error = '*invalid username or password';
                }else{
                    $admin_id = get_admin_id($username);

                    $_SESSION['admin_username'] = $username;
                    $_SESSION['admin_id'] = $admin_id;
                    header("location:admin/index.php");

                }
            }
                      
         }
        include "furni_header.php";  
 ?>
    <!-- Start Hero Section -->
			<div class="her">
				<div class="container">
					<div class="row justify-content-between">
						<div class="col-lg-5">
							<div class="intro-excerpt">
								<h1>Login</h1>
							</div>
						</div>
						<div class="col-lg-7">
							
						</div>
					</div>
				</div>
			</div>
		<!-- End Hero Section -->

		<div class="untree_co-section_checkout">
		    <div class="container">
	
		      <div class="row">
		        <div class="col-md-6 mb-5 mb-md-0">
                <div>
							<p class="text-warning">	
								<?php 	
									if (isset($_SESSION['logout'])) {
										if (!empty($_SESSION['logout'])) {
											echo "***Your session has expired***";
											$_SESSION['logout'] = null;

										}
									}
								?>
							</p>
				</div>	
                <h2 class="h3 mb-3 text-black">Admin Login</h2>
		          <div class="p-3 p-lg-5 border bg-white">
                    <div class="text-danger"><?php echo $error; ?></div>
				    <div class="text-danger"><?php echo $login_error; ?></div>
                    <form method="post" action="">
                        <div class="form-group row">
                        <div class="col-md-12">
                            <label for="username" class="text-black">Email </label>
                            <input type="text" class="form-control" id="username" name="username" value="<?php if(isset($_POST['submit'])){echo $_POST['username'];} ?>" placeholder="Enter email address">
                            <div class="text-danger"><?php echo $username_error; ?></div>
                        </div>
                        </div>
                        <div class="form-group row">
                        <div class="col-md-12">
                            <label for="password" class="text-black">Password </label>
                            <input type="password" class="form-control" id="password" name="password"  placeholder="Enter Password">
                        </div>
                        </div>
                        <div class="form-group mt-2">
                            <button type="submit" name ="submit" class="btn btn-black btn-sm btn-block">Login</button>
                        </div>
                    </form>

                    <hr>
                    <div class="text-center">
                        <a class="text-primary text-decoration-none" href="#">Forgot Password?</a>
                    </div>
                    <div class="text-center">
                        <a class="text-primary text-decoration-none" href="register.php">Create an Account!</a>
                    </div>

		          </div>
		        </div>
		        
		      </div>
		      <!-- </form> -->
		    </div>
		  </div>
<?php 
	include "furni_footer.php";  
?>