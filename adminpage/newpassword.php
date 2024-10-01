<!DOCTYPE html>
<link rel="shortcut icon" href="logo-cieti-pages.png" />
<html lang="en">
<?php 
include '_connections/_database_connection.php';
include '_user_accounts/_users_controller.php';
include '_partial/partial_head.php'; 
session_start();
if(isset($_SESSION['ADMIN_LOGIN'])){
	header("Location: index.php");
}elseif(isset($_SESSION['STAFF_LOGIN'])){
	header("Location: index.php");
}elseif(isset($_SESSION['STUDENT_LOGIN'])){
	header("Location: index.php");
}
?>
  <body class="login">
    <div>
      <div class="login_wrapper">
          <section class="login_content">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-unlock"></i> New Password</h2>
                    <div class="clearfix"></div>
                  </div>
					<form method = "POST" autocomplete = "OFF">
						<?php 
						new_password_send();
						$date = date('mmjjyY');
						$user_identification = $_GET[''.$date.''];
						
							$GET_user_recovery=mysql_query("SELECT * FROM user_admins WHERE user_identification = '$user_identification'");
							$DISPLAY_GET_user_recovery=mysql_fetch_array($GET_user_recovery);
							$user_id = $DISPLAY_GET_user_recovery['user_id'];
							$user_firstname = $DISPLAY_GET_user_recovery['user_firstname'];
							$user_middlename = $DISPLAY_GET_user_recovery['user_middlename'];
							$user_lastname = $DISPLAY_GET_user_recovery['user_lastname'];
						?>
					  <div>
						<label class = "left">Password:</label>
						<input required type="hidden" name = "user_id" value = "<?php echo $user_id; ?>" />
						<input required type="text" name = "new_password" class="form-control" placeholder="New Password" />
						<input required type="text" name = "re_new_password" class="form-control" placeholder="Re - New Password" />
					  </div>
					  <div>
						<button type="submit" class="btn btn-info btn-block" name = "new_password_send">Recover</button>
					  </div>
					  <div class="clearfix"></div>
					  <div class="separator">
						<p class="change_link">Already a member ?
						  <a href="login.php" class="to_register"> Log in </a>
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
<?php include '_partial/partial_footscripts.php'; ?>
  </body>
</html>
