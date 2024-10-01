<?php
// Initialize the session
session_start();
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}
// Include config file
include '_connections/_database_connection.php';
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username_user, password FROM tbl_admins WHERE username_user = ?";
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            // Set parameters
            $param_username = $username;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            // Redirect user to welcome page
                            header("location: index.php");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($conn);
}
include '_partial/partial_head.php'; 
?>
<!DOCTYPE html>
<link rel="shortcut icon" href="logo-cieti-pages.png" />
<html lang="en">

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>
      <a class="hiddenanchor" id="recovery"></a>
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-unlock"></i> Login</h2>
                    <div class="clearfix"></div>
					<?php 
					if(!empty($login_err)){
						echo '<div class="alert alert-danger">' . $login_err . '</div>';
					}        
					?>
                  </div>
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
					  <div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">
						<label class = "left">Username:</label>
						<input type="text" name="username" class="has-feedback-left form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
						<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
						<span class="invalid-feedback"><?php echo $username_err; ?></span>
					  </div>
					  <div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">
						<label class = "left">Password:</label>
						<input type="password" name="password" id = "myInput1" class="has-feedback-left form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
						<span  class="fa fa-unlock-alt form-control-feedback left" aria-hidden="true"></span>
						<span class="invalid-feedback"><?php echo $password_err; ?></span>
						<p onclick="myFunction1()" class = "left" style = "cursor:pointer;"><i class="fa fa-eye" ></i> Show Password</p>
					  </div>
					  <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
						<button type="reset" class="btn btn-warning"><i class="fa fa-refresh"></i> Reset</button>
						<button type="submit" class="btn btn-primary"><i class="fa fa-unlock"></i> Login</button>
					  </div>
					  <div class="clearfix"></div>
					  <div class="separator">
						<p class="change_link">
						  <a href="#signup" class="to_register"> Lost your password? </a>
						</p>
						<div class="clearfix"></div>
						<br />
						<div>
						  <p>&copy;<script>document.write(new Date().getFullYear())</script>, 
						  Designed by lorels@dev <br>All Rights Reserved.</p>
						</div>
					  </div>
					</form>
					<script>
					function myFunction1() {
						var x = document.getElementById("myInput1");
							if (x.type === "password") {
								x.type = "text";
							  } else {
								x.type = "password";
							  }
						}
					</script>
                </div>
              </div>
          </section>
        </div>
        <div id="register" class="animate form registration_form">
          <section class="login_content">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-unlock"></i> Recover</h2>
                    <div class="clearfix"></div>
                  </div>
					<form method = "POST" autocomplete = "OFF">
						<?php user_recovery(); ?>
					  <div>
						<label class = "left">Username / Email:</label>
						<input required type="text" name = "usernameemail" class="form-control" placeholder="Username or Email" />
					  </div>
					  <div>
						<button type="submit" class="btn btn-info btn-block" name = "user_forgot_button">Recover</button>
					  </div>
					  <div class="clearfix"></div>
					  <div class="separator">
						<p class="change_link">Already a member ?
						  <a href="#signin" class="to_register"> Log in </a>
						</p>

						<div class="clearfix"></div>
						<br />

						<div>
						  <p>&copy;<script>document.write(new Date().getFullYear())</script>, 
						  Designed by lorels@dev <br>All Rights Reserved.</p>
						</div>
					  </div>
					</form>
                </div>
              </div>
          </section>
        </div>
		
      </div>
    </div>
<?php include '_partial/partial_footscripts.php'; ?>
  </body>
</html>
