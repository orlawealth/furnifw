<?php 
		 include "core/init.php";
		 ini_set('display_errors', 1);
		 //die("log in successful");

         if (isset($_POST['submit'])){
            die("logged in ssuccesful");
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
                <h2 class="h3 mb-3 text-black">Customer</h2>
		          <div class="p-3 p-lg-5 border bg-white">
                    <form method="post" action="">
                        <div class="form-group row">
                        <div class="col-md-12">
                            <label for="c_email" class="text-black">Email </label>
                            <input type="email" class="form-control" id="c_email" name="c_email" placeholder="Enter email address">
                        </div>
                        </div>
                        <div class="form-group row">
                        <div class="col-md-12">
                            <label for="c_password" class="text-black">Password </label>
                            <input type="password" class="form-control" id="c_password" name="c_password" placeholder="Enter Password">
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