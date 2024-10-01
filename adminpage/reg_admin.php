<!DOCTYPE html>
<html lang="en">
<?php 
include '_connections/_database_connection.php';
include '_connections/_session_connection.php';
include '_partial/partial_head.php'; 
?>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <!-- menu profile quick info -->
<?php include '_partial/partial_logo_user.php'; ?>
            <!-- /menu profile quick info -->
            <br />
<?php include '_sidebars/_sidebar_global.php'; ?>
          </div>
        </div>
<?php include '_partial/partial_navbar.php'; ?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
<?php //include '_partial/partial_title_search.php'; ?>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Create new user account</h2>
					<?php include '_user_accounts/_users_controller.php'; ?>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
				  <?php add_administrator_user_account(); ?>
                    <form method = "POST" class="form-horizontal form-label-left input_mask" enctype="multipart/form-data" autocomplete = "OFF">
					<h2>User Identification</h2>
							<input required id = "user_autoid" name="user_autoid" class="form-control input-sm" type="hidden" value = "<?php if($auto_id == 0){ echo $count; }else{ echo ''.$studentnoadd.''; } ?>">						
<?php
//auto generated user id
$checkID=mysql_query("SELECT * FROM user_admins ORDER BY user_id DESC");
$checkautoID=mysql_fetch_array($checkID);
$auto_id = $checkautoID['user_id'];
$query = "SELECT count(*) AS id FROM user_admins";
$result = mysql_query($query);
$values = mysql_fetch_assoc($result);
$autoID = $values['id'];
$count = '1000';
$countnum = '1';
$adminadd = $count + $autoID + $countnum;


$checkautoID=mysql_query("SELECT * FROM user_admins ORDER BY user_id DESC");
$checkautoIDshow=mysql_fetch_array($checkautoID);
$user_auto_id = $checkautoIDshow['user_auto_id'];
$user_auto_id_1 = '1';
$user_auto_id_counted = $user_auto_id + $user_auto_id_1;

//password auto generate
function generateRandomString($length = 10){
	$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
		}
?>
						<div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
							<?php $startDate = time();$year = date('Y', strtotime('-1 day', $startDate));?>
							<label for = "user_adminid">Auto generated Administrator ID:</label>
							<input required class="form-control" name="user_adminid" id = "user_adminid" type="text" value = "<?php if($autoID == 0){echo $adminadd;}else{echo $adminadd;}?>-<?php echo $year; ?>" readonly>
						</div>
							<input name="user_auto_id" type="hidden" value = "<?php echo $user_auto_id_counted; ?>">
						<div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
							<?php $startDate = time();$today = date('Y-m-d', strtotime('-1 day', $startDate));?>
							<label for = "user_admindateregistration">Date of Registration:</label>
							<input required class="form-control" name="user_admindateregistration" id = "user_admindateregistration" type="text" value = "<?php echo $today; ?>" readonly>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
							<label for = "user_admin_account_created_by">Account Created By:</label>
							<input  type="text" class="form-control" name = "user_admin_account_created_by" id="user_admin_account_created_by" value = "<?php echo $ADMIN_FIRSTNAME; ?> <?php echo $ADMIN_LASTNAME; ?>" readonly>
						</div>
					<h2>Personal Information</h2>
						<div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
							<label for = "user_admin_first_name">First Name:</label>
							<input  type="text" class="form-control" name = "user_admin_first_name" id="user_admin_first_name" placeholder="First Name">
						</div>
						<div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
							<label for = "user_admin_middle_name">Middle Name:</label>
							<input  type="text" class="form-control" name = "user_admin_middle_name" id="user_admin_middle_name" placeholder="Middle Name">
						</div>
						<div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
							<label for = "user_admin_last_name">Last Name:</label>
							<input  type="text" class="form-control" name = "user_admin_last_name" id="user_admin_last_name" placeholder="Last Name">
						</div>
						<?php $startDate = time(); $today = date('Y-m-d', strtotime('-2 day', $startDate));?>
						<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
							<label for = "user_admin_birthdate">Birthdate:</label>
							<input  type="date" class="form-control" name = "user_admin_birthdate" id="user_admin_birthdate" max = "<?php echo $today; ?>">
						</div>
						<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
							<label for = "user_admin_contact">Contact:</label>
							<input  type="number" class="form-control" name = "user_admin_contact" id="user_admin_contact" placeholder="Contact No">
						</div>
						<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
							<label for = "user_admin_email">Email:</label>
							<input  type="email" class="form-control" name = "user_admin_email" id="user_admin_email" placeholder="Email">
						</div>
						<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
							<label for = "user_admin_gender">Gender:</label>
							<select  class="form-control" name="user_admin_gender" id = "user_admin_gender" >
								<option>Male</option>
								<option>Female</option>
							</select>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
							<label for = "user_admin_civil_status">Civil Status:</label>
							<input  type="text" class="form-control" name = "user_admin_civil_status" id="user_admin_civil_status" placeholder="Civil Status">
						</div>
						<div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
							<label for = "user_admin_religion">Religion:</label>
							<input  type="text" class="form-control" name = "user_admin_religion" id="user_admin_religion" placeholder="Religion">
						</div>
						<div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
							<label for = "user_admin_nationality">Nationality:</label>
							<input  type="text" class="form-control" name = "user_admin_nationality" id="user_admin_nationality" placeholder="Nationality">
						</div>
						<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
							<label for = "user_admin_tin_no">TIN:</label>
							<input  type="text" class="form-control" name = "user_admin_tin_no" id="user_admin_tin_no" placeholder="Tin Number">
						</div>
						<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
							<label for = "user_admin_sss_no">SSS:</label>
							<input  type="text" class="form-control" name = "user_admin_sss_no" id="user_admin_sss_no" placeholder="SSS Number">
						</div>
						<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
							<label for = "user_admin_pagibig_no">Pag Ibig:</label>
							<input  type="text" class="form-control" name = "user_admin_pagibig_no" id="user_admin_pagibig_no" placeholder="PagIbig Number">
						</div>
						<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
							<label for = "user_admin_philhealth_no">Philhealth:</label>
							<input  type="text" class="form-control" name = "user_admin_philhealth_no" id="user_admin_philhealth_no" placeholder="Philhealth Number">
						</div>
					<h2>Permanent Address</h2>
						<div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
							<label for = "user_admin_street_address">Street Address:</label>
							<input  type="text" class="form-control" name = "user_admin_street_address" id="user_admin_street_address" placeholder="Street Address">
						</div>
						<div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
							<label for = "user_admin_barangay">Barangay:</label>
							<input  type="text" class="form-control" name = "user_admin_barangay" id="user_admin_barangay" placeholder="Barangay">
						</div>
						<div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
							<label for = "user_admin_citymunicipality">City/Municipality:</label>
							<input  type="text" class="form-control" name = "user_admin_citymunicipality" id="user_admin_citymunicipality" placeholder="City/Municipality">
						</div>
						<div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
							<label for = "user_admin_state_province">State/Province:</label>
							<input  type="text" class="form-control" name = "user_admin_state_province" id="user_admin_state_province" placeholder="State/Province">
						</div>
						<div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
							<label for = "user_admin_country">Country:</label>
							<input  type="text" class="form-control" name = "user_admin_country" id="user_admin_country" placeholder="Country">
						</div>
						<div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
							<label for = "user_admin_zip_code">Zip Code:</label>
							<input  type="text" class="form-control" name = "user_admin_zip_code" id="user_admin_zip_code" placeholder="Zip Code">
						</div>
					<h2>Users Account</h2>
						<div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
							<label for = "user_admin_username">Admin Username:</label>
							<input  type="text" class="form-control" name = "user_admin_username" id="user_admin_username" placeholder="Username">
						</div>
						<div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
							<label for = "user_admin_password">Auto Generate Password:</label>
							<input  type="text" class="form-control" name = "user_admin_password" id="user_admin_password" value = "<?php echo generateRandomString();?>" readonly>
						</div>
					<!--
						<div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
							<label for = "user_admin_username">Account Priviledge:</label>
							<select  class="form-control" name="user_admin_gender" id = "user_admin_gender" >
								<option value = "MainAdmin">Main Admin (Full Control)</option>
								<option value = "Admin">Admin (Modify & Execute) </option>
								<option value = "Moderator">Moderator (Read & Modify)</option>
							</select>
						</div>
					-->
						<div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
							<label>Email Authenticator:</label>
							<select  class="form-control" name="user_admin_email_autheticator" id = "user_admin_email_autheticator" >
								<option value = "ON_EMAIL_AUTH">Enabled (Turn ON Email Authenticator)</option>
								<option value = "OFF_EMAIL_AUTH" selected>Disabled (Turn OFF Email Authenticator) </option>
							</select>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12 input-group">
							<label>PRIVILEDGE: Giving rights to ADD/MODIFY/DELETE/VIEW every Administrator, Staff, Faculty and Student:</label>
								<div class="radio">
									<label>
										<input type="radio" class="flat" name="priviledge_of_users" value = "Full Control"> (ADMIN) Full Control <i>(This user can ADD/MODIFY/DELETE/VIEW/ACCOUNT MANAGEMENT every users in this system)</i>
									</label>
								</div>
								<div class="radio">
									<label>
										<input type="radio" class="flat" name="priviledge_of_users" value = "Staff, Faculty and Student Only"> (MODERATOR) Admin Staff <i>(This user can ADD/MODIFY/VIEW every users in this system)</i>
									</label>
								</div>
								<div class="radio">
									<label>
										<input type="radio" class="flat" name="priviledge_of_users" value = "Staff, Faculty and Student Only"> (STAFF) Staff <i>(This user can ADD/VIEW every infomartion)</i>
									</label>
								</div>
								<div class="radio">
									<label>
										<input type="radio" class="flat" name="priviledge_of_users" value = "No Control" checked> No Control <i>(No, this user is not allowed to take any action around this system)</i>
									</label>
								</div>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
							<label for = "user_admin_photo">Photo:</label>
							<input  type="file" class="form-control" name = "user_admin_photo" id="user_admin_photo">
						</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<button name = "save_administrator_user_account" class="btn btn-primary btn-block" type="submit">Submit</button>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<!-- onclick="demo.showNotification('bottom','right')" -->
								<button class="btn btn-danger btn-block" type="reset">Reset</button>
							</div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
<?php include '_partial/partial_footer.php'; ?>
        <!-- /footer content -->
      </div>
    </div>
<?php include '_partial/partial_footscripts.php'; ?>
<?php if(isset($_POST['save_administrator_user_account'])){ 
$priviledge_of_users = $_POST['priviledge_of_users'];
$user_admin_first_name = $_POST['user_admin_first_name'];
$user_admin_last_name = $_POST['user_admin_last_name'];
$ADMIN_FIRSTNAME = $ADMIN_LOGIN_VIEW['user_firstname'];
$ADMIN_MIDDLENAME = $ADMIN_LOGIN_VIEW['user_middlename'];
$ADMIN_LASTNAME = $ADMIN_LOGIN_VIEW['user_lastname']; ?>
<script type="text/javascript">
	$(document).ready(function(){
		demo.initChartist();
		$.notify({
			icon: "fa fa-check-circle",
			message: "<b>SYSTEM NOTIFICATION</b><br>Hi <b><?php echo @$ADMIN_FIRSTNAME; echo ' '; echo @$ADMIN_LASTNAME; ?></b>, You have succesfully created an <b><?php echo @$user_admin_first_name; echo ' '; echo @$user_admin_last_name; ?></b> with system priviledge <b><?php echo $priviledge_of_users; ?></b> account.<br>"
			},{
				type: "success",
				timer: 20000
            });
		});
</script>
<script type="text/javascript">
	$(document).ready(function(){
		demo.initChartist();
		$.notify({
			icon: "fa fa-check-circle",
			message: "<b>SYSTEM NOTIFICATION</b><br>All Admins will be notified about <b><?php echo $user_admin_first_name; echo ' '; echo $user_admin_last_name;?></b>'s created account."
			},{
				type: "success",
				timer: 15000
            });
		});
</script>
<?php }else{ ?>
<script type="text/javascript">
	$(document).ready(function(){
		demo.initChartist();
		$.notify({
			icon: "fa fa-info-circle",
			message: "<b>SYSTEM NOTIFICATION</b><br><b><i class = 'fa fa-user'></i> Create User Section</b><br>1. To create account, user must have a active and valid email for the account activation and security. <br> 2. Account information will be sended to email. <br> 3. Account activation will automatically sended to email. "
			},{
				type: "info",
				timer: 50000
            });
		});
</script>
<?php } ?>
  </body>
</html>
