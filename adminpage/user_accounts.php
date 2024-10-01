<?php 
include '_connections/_database_connection.php';
include '_connections/_session_connection.php';
include '_partial/partial_head.php'; 
/*if($ADMIN_USER_REQUIRE_CHANGE == 'REQUIRE_CHANGE'){
echo '
	<script>
	  location.replace("dashboard.php?action=CHANGE_PASSWORD")
	</script>
';
}*/

$priviledge = $ADMIN_LOGIN_VIEW['priviledge'];
if(($priviledge == 'Admin')){}else{echo '
	<script>
	  location.replace("dashboard.php")
	</script>
';}
?>
<!DOCTYPE html>
<html lang="en">
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
<?php include '_partial/partial_logo_user.php'; ?>
            <br />
<?php include '_sidebars/_sidebar_global.php'; ?>
          </div>
        </div>
<?php include '_partial/partial_navbar.php'; ?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
					<?php
						echo '<h2>';
						if(isset($_POST['update_user_details'])){
							echo '<img src = "loading.gif" height = "25"/>';
						}elseif(isset($_POST['activate_user'])){
							echo '<img src = "loading.gif" height = "25"/>';
						}elseif(isset($_POST['deactivate_user'])){
							echo '<img src = "loading.gif" height = "25"/>';
						}elseif(isset($_POST['add_signatory'])){
							echo '<img src = "loading.gif" height = "25"/>';
						}elseif(isset($_POST['remove_signatory'])){
							echo '<img src = "loading.gif" height = "25"/>';
						}elseif(isset($_POST['save_staff_user_account'])){
							echo '<img src = "loading.gif" height = "25"/>';
						}
					?>
                    <i class="fa fa-users"></i> User's Account</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><button type="button" class = "btn btn-success" data-toggle="modal" data-target=".bs-example-modal-lg-create-account"><i class="fa fa-plus"></i> Create New User</button>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
				  <?php
					if(isset($_POST['update_user_details'])){
						$user_id = $_POST['user_id'];
						$user_firstnameedit = $_POST['user_firstname'];
						$user_middlenameedit = $_POST['user_middlename'];
						$user_lastnameedit = $_POST['user_lastname'];
						$user_email = $_POST['user_email'];
						$user_contact = $_POST['user_contact'];
						$user_username = $_POST['user_username'];
						$user_password = $_POST['user_password'];
						$user_passwordenc = password_hash($user_password, PASSWORD_DEFAULT);
						$user_priviledge_level = $_POST['iCheck'];
						$user_email_old = $_POST['user_email_old'];
						if($user_email == $user_email_old){
							$delete_photo=mysqli_query($conn, "SELECT * FROM user_admins WHERE user_id = '$user_id'");
								$delete_photo_show=mysqli_fetch_array($delete_photo);
								$user_firstname = ''.$delete_photo_show['user_firstname'].'';
								$user_middlename = ''.$delete_photo_show['user_middlename'].'';
								$user_lastname = ''.$delete_photo_show['user_lastname'].'';
								$file_name = ''.$delete_photo_show['user_photo'].'';
								unlink("_photos/profilephotos/admins/".$user_firstname."".$user_middlename."".$user_lastname."/$file_name");
									$file=$_FILES['user_staff_photo']['tmp_name'];
								if($file != ''){
									$file=$_FILES['user_staff_photo']['tmp_name'];
									$user_staff_photo= addslashes(file_get_contents($_FILES['user_staff_photo']['tmp_name']));
									$image_name= addslashes($_FILES['user_staff_photo']['name']);
									$image_size= getimagesize($_FILES['user_staff_photo']['tmp_name']);
									move_uploaded_file($_FILES["user_staff_photo"]["tmp_name"],"_photos/profilephotos/admins/".$user_firstname."".$user_middlename."".$user_lastname."/" . $_FILES["user_staff_photo"]["name"]);
									$user_staff_photo=$_FILES["user_staff_photo"]["name"];
								$old_name = '_photos/profilephotos/admins/'.$user_firstname.''.$user_middlename.''.$user_lastname.'';
								$new_name = '_photos/profilephotos/admins/'.$user_firstnameedit.''.$user_middlenameedit.''.$user_lastnameedit.'';
								rename( $old_name, $new_name);
								}else{
									$user_staff_first_name_1 = substr($user_firstname, 0, 1); 
									$user_staff_middle_name_1 = substr($user_middlename, 0, 1); 
									$user_staff_last_name_1 = substr($user_lastname, 0, 1); 
									$full_cut_strings = ''.$user_staff_first_name_1.''.$user_staff_middle_name_1.''.$user_staff_last_name_1.'';
									$im = imagecreate(50, 50);
									$bg = imagecolorallocate($im, 255, 255, 255);
									$textcolor = imagecolorallocate($im, 0, 0, 0);
									imagestring($im, 5, 14, 17, ''.$full_cut_strings.'', $textcolor);
									// Output the image
									imagepng($im, '_photos/profilephotos/admins/'.$user_firstname.''.$user_middlename.''.$user_lastname.'/'.$full_cut_strings.'.png');
									$user_staff_photo = ''.$full_cut_strings.'.png';
								$old_name = '_photos/profilephotos/admins/'.$user_firstname.''.$user_middlename.''.$user_lastname.'';
								$new_name = '_photos/profilephotos/admins/'.$user_firstnameedit.''.$user_middlenameedit.''.$user_lastnameedit.'';
								rename( $old_name, $new_name);
								}
									$description = 'Editing '.$user_username.'/s account.';
									$link = 'user_accounts.php';
									$date_today = date("F d, Y");
									$time_today = date("h:i A");
													mysqli_query($conn, "UPDATE user_admins SET user_firstname = '$user_firstnameedit', user_middlename = '$user_middlenameedit', user_lastname = '$user_lastnameedit', user_priviledge_level = '$user_priviledge_level', user_photo = '$user_staff_photo', user_passwordenc = '$user_passwordenc', user_email = '$user_email', user_contact = '$user_contact', user_username = '$user_username', user_password = '$user_password' WHERE user_id = $user_id");
													mysqli_query($conn, "UPDATE file_downloads SET email = '$user_email' WHERE user_id = $user_id");
													mysqli_query($conn, "UPDATE sent_file SET email = '$user_email' WHERE user_id = $user_id");
													mysqli_query($conn, "INSERT INTO activity_logs (user_id,description,link,date,time)VALUES('$user_id','$description','$link','$date_today','$time_today')");

												echo '
												<div class="alert alert-success alert-dismissible fade in" role="alert">
													<i class = "fa fa-check-circle"></i> INFORMATION UPDATED!
													<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
													<br/>
													<b>'.$user_firstname.' '.$user_lastname.'</b> Information was successfully updated in our database.
												</div>';
												echo '<META HTTP-EQUIV="REFRESH" CONTENT="1;URL=user_accounts.php">';
						}else{
							$CHECKemail = mysqli_query($conn, "SELECT * FROM user_admins WHERE user_email='".$user_email."'");
							if(mysqli_num_rows($CHECKemail) > 0){
								echo '
									<div class="alert alert-danger alert-dismissible fade in" role="alert">
										<i class = "fa fa-check-circle"></i> <b>ACCOUNT EXIST!</b>
										</br>
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
										<strong>'.$user_email.'</strong> This email is already exist, please choose new email.
										</br>			
									</div>';
								echo '<META HTTP-EQUIV="REFRESH" CONTENT="1;URL=user_accounts.php">';
							}else{
								$delete_photo=mysqli_query($conn, "SELECT * FROM user_admins WHERE user_id = '$user_id'");
								$delete_photo_show=mysqli_fetch_array($delete_photo);
								$user_firstname = ''.$delete_photo_show['user_firstname'].'';
								$user_middlename = ''.$delete_photo_show['user_middlename'].'';
								$user_lastname = ''.$delete_photo_show['user_lastname'].'';
								$file_name = ''.$delete_photo_show['user_photo'].'';
								unlink("_photos/profilephotos/admins/".$user_firstname."".$user_middlename."".$user_lastname."/$file_name");
								
									$file=$_FILES['user_staff_photo']['tmp_name'];
								if($file != ''){
									$file=$_FILES['user_staff_photo']['tmp_name'];
									$user_staff_photo= addslashes(file_get_contents($_FILES['user_staff_photo']['tmp_name']));
									$image_name= addslashes($_FILES['user_staff_photo']['name']);
									$image_size= getimagesize($_FILES['user_staff_photo']['tmp_name']);
									move_uploaded_file($_FILES["user_staff_photo"]["tmp_name"],"_photos/profilephotos/admins/".$user_firstname."".$user_middlename."".$user_lastname."/" . $_FILES["user_staff_photo"]["name"]);
									$user_staff_photo=$_FILES["user_staff_photo"]["name"];
								$old_name = '_photos/profilephotos/admins/'.$user_firstname.''.$user_middlename.''.$user_lastname.'';
								$new_name = '_photos/profilephotos/admins/'.$user_firstnameedit.''.$user_middlenameedit.''.$user_lastnameedit.'';
								rename( $old_name, $new_name);
								}else{
									$user_staff_first_name_1 = substr($user_firstname, 0, 1); 
									$user_staff_middle_name_1 = substr($user_middlename, 0, 1); 
									$user_staff_last_name_1 = substr($user_lastname, 0, 1); 
									$full_cut_strings = ''.$user_staff_first_name_1.''.$user_staff_middle_name_1.''.$user_staff_last_name_1.'';
									$im = imagecreate(50, 50);
									// White background and blue text
									$bg = imagecolorallocate($im, 255, 255, 255);
									$textcolor = imagecolorallocate($im, 0, 0, 0);
									// Write the string at the top left
									imagestring($im, 5, 14, 17, ''.$full_cut_strings.'', $textcolor);
									// Output the image
									imagepng($im, '_photos/profilephotos/admins/'.$user_firstname.''.$user_middlename.''.$user_lastname.'/'.$full_cut_strings.'.png');
									$user_staff_photo = ''.$full_cut_strings.'.png';
								$old_name = '_photos/profilephotos/admins/'.$user_firstname.''.$user_middlename.''.$user_lastname.'';
								$new_name = '_photos/profilephotos/admins/'.$user_firstnameedit.''.$user_middlenameedit.''.$user_lastnameedit.'';
								rename( $old_name, $new_name);
								}
								
									//ACTIVITY LOGS RECORD
									$description = 'Editing '.$user_username.'/s account.';
									$link = 'user_accounts.php';
									$date_today = date("F d, Y");
									$time_today = date("h:i A");
													mysqli_query($conn, "UPDATE user_admins SET user_firstname = '$user_firstnameedit', user_middlename = '$user_middlenameedit', user_lastname = '$user_lastnameedit', user_priviledge_level = '$user_priviledge_level', user_photo = '$user_staff_photo', user_passwordenc = '$user_passwordenc', user_email = '$user_email', user_contact = '$user_contact', user_username = '$user_username', user_password = '$user_password' WHERE user_id = $user_id");
													mysqli_query($conn, "UPDATE file_downloads SET email = '$user_email' WHERE user_id = $user_id");
													mysqli_query($conn, "UPDATE sent_file SET email = '$user_email' WHERE user_id = $user_id");
													mysqli_query($conn, "INSERT INTO activity_logs (user_id,description,link,date,time)VALUES('$user_id','$description','$link','$date_today','$time_today')");

												echo '
												<div class="alert alert-success alert-dismissible fade in" role="alert">
													<i class = "fa fa-check-circle"></i> INFORMATION UPDATED!
													<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
													<br/>
													<b>'.$user_firstname.' '.$user_lastname.'</b> Information was successfully updated in our database.
												</div>';
												echo '<META HTTP-EQUIV="REFRESH" CONTENT="1;URL=user_accounts.php">';
							}
						}
					}
					
					if(isset($_POST['activate_user'])){
						$user_id = $_POST['user_id'];
						$user_name = $_POST['user_name'];
						$activated_user = 'Activated';
						$description = 'Activated '.$user_name.' account.';
						$link = 'user_accounts.php';
						$date_today = date("F d, Y");
						$time_today = date("h:i A");
						mysqli_query($conn, "INSERT INTO activity_logs (user_id,description,link,date,time)VALUES('$user_id','$description','$link','$date_today','$time_today')");
						mysqli_query($conn, "UPDATE user_admins SET user_activation = '$activated_user' WHERE user_id = $user_id");
								echo '
									<div class="alert alert-success alert-dismissible fade in" role="alert">
										<i class = "fa fa-info-circle"></i> ACCOUNT ACTIVATED!
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
										<br/>
										<b>'.$user_name.'</b> This user was succesfully activated.
									</div>';
								echo '<META HTTP-EQUIV="REFRESH" CONTENT="1;URL=user_accounts.php">';
					}
					
					if(isset($_POST['deactivate_user'])){
						$user_id = $_POST['user_id'];
						$user_name = $_POST['user_name'];
						$deactivated_user = 'Not Activated';
						$description = 'Dectivated '.$user_name.' account.';
						$link = 'user_accounts.php';
						$date_today = date("F d, Y");
						$time_today = date("h:i A");
						mysqli_query($conn, "INSERT INTO activity_logs (user_id,description,link,date,time)VALUES('$user_id','$description','$link','$date_today','$time_today')");
						mysqli_query($conn, "UPDATE user_admins SET user_activation = '$deactivated_user' WHERE user_id = $user_id");
								echo '
									<div class="alert alert-danger alert-dismissible fade in" role="alert">
										<i class = "fa fa-info-circle"></i> ACCOUNT DEACTIVATED!
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
										<br/>
										<b>'.$user_name.'</b> This user was succesfully deactivated.
									</div>';
								echo '<META HTTP-EQUIV="REFRESH" CONTENT="1;URL=user_accounts.php">';
					}
					
					if(isset($_POST['delete_user'])){
						date_default_timezone_set("Asia/Manila");
						ini_set('max_execution_time', '900');
						$delete_user_id = $_POST['delete_user_id'];
						$user_id = $_POST['user_id'];
						$user_password = $_POST['user_password'];
						$user_passwordenc = password_hash($user_password, PASSWORD_BCRYPT);
						$select_user = mysqli_query($conn, "SELECT * FROM user_admins WHERE user_id = '$user_id'");
						$select_user_view = mysqli_fetch_array($select_user);
						$user_passwordenc = $select_user_view['user_passwordenc'];
						if(password_verify($user_password, $user_passwordenc)) {
							$select_user = mysqli_query($conn, "SELECT * FROM user_admins WHERE user_id = '$delete_user_id'");
							$select_user_view = mysqli_fetch_array($select_user);
							$user_firstname = $select_user_view['user_firstname'];
							$user_middlename = $select_user_view['user_middlename'];
							$user_lastname = $select_user_view['user_lastname'];
							$user_photo = $select_user_view['user_photo'];
									
							mysqli_query($conn, "DELETE FROM user_admins WHERE user_id = '$delete_user_id'");
							
							unlink("_photos/profilephotos/admins/$user_firstname$user_middlename$user_lastname/$user_photo");
							
							rmdir("_photos/profilephotos/admins/$user_firstname$user_middlename$user_lastname/");
								
							date_default_timezone_set("Asia/Manila");
							$time_today = date("H:i:s");
							$date_today = date("Y-m-d");
							$activity = 'Deleting department <b>'.$user_firstname.' '.$user_lastname.'</b>, using <b>'.$ADMIN_FIRSTNAME.' '.$ADMIN_LASTNAME.'</b> account.';
							$module = 'Delete account.';
							$link = 'user_accounts.php';
							$result = 'Account of <b>'.$user_firstname.' '.$user_lastname.'</b> is successfully deleted.';
							$insert_activity = mysqli_query($conn, "INSERT INTO activity_logs 
							(time,date,activity,module,link,result,user_id) VALUES 
							('$time_today','$date_today','$activity','$module','$link','$result','$ADMIN_USERID')");
							echo '<META HTTP-EQUIV="REFRESH" CONTENT="1;URL=user_accounts.php">';
							echo '
							<div class="alert alert-success alert-dismissible fade in" role="alert">
								<i class = "fa fa-info-circle"></i> DELETING ACCOUNT!
								<br/>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
								<b>'.$user_firstname.' '.$user_lastname.'</b> account was succesfully deleted.
							</div>';
						}else{
							$select_user = mysqli_query($conn, "SELECT * FROM user_admins WHERE user_id = '$delete_user_id'");
							$select_user_view = mysqli_fetch_array($select_user);
							$user_firstname = $select_user_view['user_firstname'];
							$user_lastname = $select_user_view['user_lastname'];
												
							date_default_timezone_set("Asia/Manila");
							$time_today = date("H:i:s");
							$date_today = date("Y-m-d");
							$activity = 'Deleting department <b>'.$user_firstname.' '.$user_lastname.'</b>, using <b>'.$ADMIN_FIRSTNAME.' '.$ADMIN_LASTNAME.'</b> account.';
							$module = 'Delete account.';
							$link = 'user_accounts.php';
							$result = 'Account of <b>'.$user_firstname.' '.$user_lastname.'</b> is unsuccessfully deleted.';
							$insert_activity = mysqli_query($conn, "INSERT INTO activity_logs 
							(time,date,activity,module,link,result,user_id) VALUES 
							('$time_today','$date_today','$activity','$module','$link','$result','$ADMIN_USERID')");
							echo '<META HTTP-EQUIV="REFRESH" CONTENT="1;URL=user_accounts.php">';
							echo '
							<div class="alert alert-danger alert-dismissible fade in" role="alert">
								<i class = "fa fa-warning"></i> DELETING ACCOUNT!
								<br/>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
								Invelid password.
							</div>';
												}
						}
					function add_administrator_user_account(){
						if(isset($_POST['save_staff_user_account'])){
							date_default_timezone_set("Asia/Manila");
							include '_connections/_database_connection.php';
							//QUERY
							include '_user_accounts/_admin_add.php';
						}
					}
					add_administrator_user_account();
					echo '
						<table id="datatable" class="table-hover table table-striped table-bordered">
							<thead>
								<tr style = "text-transform: uppercase;">
									<th>Name</th>
									<th>Email</th>
									<th>Department</th>
									<th>Created At</th>
									<th>Updated At</th>
									<th>Priviledges</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>';
						if(isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
							$priviledge = $ADMIN_LOGIN_VIEW['priviledge'];
							if($priviledge == 'Admin'){	
								$sel = mysqli_query($conn, "SELECT * FROM tbl_admins");
							}
							/*elseif($priviledge == 'Staff'){
								$sel = mysqli_query($conn, "SELECT * FROM tbl_admins WHERE priviledge != 'Admin'");
							}*/
						}
					while($row=mysqli_fetch_array($sel))
					{
						$id = ''.$row['id'].'';
						$department = ''.$row['department'].'';
						
						//$signatory=mysqli_query($conn, "SELECT * FROM users_signatory WHERE id = '$id'");
						//$signatory_show=mysqli_fetch_array($signatory);
					echo '	
								<tr class="record">';
					echo '
									<td style = "cursor:pointer;" class = "success" data-toggle="modal" data-target=".bs-example-modal-view_user_'.$row['id'].'">'.$row['firstName'].' '.$row['lastName'].'</td>
									<td style = "cursor:pointer;" class = "success" data-toggle="modal" data-target=".bs-example-modal-view_user_'.$row['id'].'">'.$row['email'].'</td>
									<td style = "cursor:pointer;" class = "success" data-toggle="modal" data-target=".bs-example-modal-view_user_'.$row['id'].'">'.$row['department'].'</td>
									<td style = "cursor:pointer;" class = "success" data-toggle="modal" data-target=".bs-example-modal-view_user_'.$row['id'].'">'.$row['created_at'].'</td>
									<td style = "cursor:pointer;" class = "success" data-toggle="modal" data-target=".bs-example-modal-view_user_'.$row['id'].'">'.$row['updated_at'].'</td>
									<td style = "cursor:pointer;" class = "success" data-toggle="modal" data-target=".bs-example-modal-view_user_'.$row['id'].'"><b>'.$row['priviledge'].'</b></td>
									<td style = "text-transform: uppercase;" class = "success">
										<a data-toggle="modal" data-target=".bs-example-modal-edit_user_'.$row['id'].'" class = "btn btn-xs btn-primary"><i class="fa fa-pencil"></i> Edit</a>';
									
									
									if($priviledge == 'Admin'){
										echo '<a data-toggle="modal" data-target=".bs-example-modal-delete_user'.$row['id'].'" class = "btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> DELETE</a>';
									}
					echo'
									</td>';
							
	echo '
				<div class="modal fade bs-example-modal-delete_user'.$row['id'].'" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-user"></i> DELETE USER</h4>
                        </div>
								<div class="modal-body" style = "margin-top:-15px;">
								
									<div class=" form-group has-feedback">';
								echo '
									</div>
									<div class=" form-group has-feedback">
										<label>Are you sure you want to delete this user ('.$row['firstName'].' '.$row['lastName'].' of '.$colleges_department_code.') account?</label>
									</div>
							<form method = "POST" class="form-horizontal form-label-left input_mask" autocomplete = "OFF" enctype="multipart/form-data">
									<div class=" form-group has-feedback">
										<input value = "'.$row['id'].'" type="hidden" name = "delete_user_id">
										<input value = "'.$id.'" type="hidden" name = "user_id">
									</div>
									<div class=" form-group has-feedback">
										<label for = "user_password">PASSWORD:</label>
										<input value = "" onkeypress="return /[0-9a-zA-Z !@#$%^&*()_ - + = ]/i.test(event.key)" required type="password" class="form-control" name = "user_password" id="user_password">
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
									<button class="btn btn-danger" type="reset"><i class="fa fa-refresh"></i> Reset</button>
									<button name = "delete_user" class="btn btn-success" type="submit"><i class="fa fa-save"></i> Save</button>
								</div>
							</form>
                      </div>
                    </div>
				</div>';
					echo '
								</tr>
							';
						echo '
									<div class="modal fade bs-example-modal-view_user_'.$row['id'].'" tabindex="-1" role="dialog" aria-hidden="true">
										<div class="modal-dialog modal-sm">
										  <div class="modal-content">

											<div class="modal-header">
											  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
											  </button>
											  <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-user"></i> View <b>'.$row['firstName'].' '.$row['lastName'].'</b>\'s Information</h4>
											</div>
											<div class="modal-body">
												<label>Profile Photo:</label>'; 
												if(''.$row['user_photo'].'' != ''){
													echo '<span class="image" ><img style = "width: 267px; height: 250px;" src="_photos/profilephotos/admins/'.$row['firstName'].''.$row['firstName'].'/'.$row['photo'].'" alt="Profile Image" /></span>';
												}else{
													echo '<span class="image" ><img style = "width: 267px; height: 250px;" src="_photos/male.png" alt="Profile Image" /></span>';
												}
						echo '
											<div class=" form-group has-feedback">
												<label for = "event_name">PRIVILEDGE LEVEL:</label>
												<input disabled value = "'.$row['user_priviledge_level'].'" type="text" class="form-control" >
											</div>
											<div class=" form-group has-feedback">
												<label for = "event_name">NAME:</label>
												<input disabled value = "'.$row['user_firstname'].' '.$row['user_middlename'].' '.$row['user_lastname'].'" type="text" class="form-control" >
											</div>
											<div class=" form-group has-feedback">
												<label for = "event_name">EMAIL:</label>
												<input disabled value = "'.$row['user_email'].'" type="text" class="form-control" >
											</div>
											<div class=" form-group has-feedback">
												<label for = "event_name">USERNAME:</label>
												<input disabled value = "'.$row['user_username'].'" type="text" class="form-control" >
											</div>
											<div class=" form-group has-feedback">
												<label for = "event_name">PASSWORD:</label>
												<input disabled value = "'.$row['user_password'].'" type="text" class="form-control" >
											</div>
											<div class=" form-group has-feedback">
												<label for = "event_name">EMAIL NOTIFICATION:</label>
												<input disabled value = "'.$row['user_notification'].'" type="text" class="form-control" >
											</div>';
												
						echo '
											</div>
											</div>
											<div class="modal-footer">
											  <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
											</div>
										  </div>
										</div>
									  </div>
									  ';
						//EDIT USER
						echo '
									<div class="modal fade bs-example-modal-edit_user_'.$row['id'].'" tabindex="-1" role="dialog" aria-hidden="true">
										<div class="modal-dialog modal-sm">
										  <div class="modal-content">

											<div class="modal-header">
											  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
											  </button>
											  <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-user"></i> Edit <b>'.$row['firstName'].' '.$row['lastName'].'</b>\'s Information</h4>
											</div>
												<form id="demo-form" method = "POST" enctype="multipart/form-data" data-parsley-validate>
												<div class="modal-body" style = "margin-top:-15px;">
												  <input type="hidden" id="id" class="form-control" name="id" value = "'.$row['id'].'" />
												  
												  <label for="firstName">First Name:</label>
												  <input onkeypress="return /[0-9a-zA-Z @ _ .]/i.test(event.key)" type="text" id="firstName" class="form-control" name="firstName" value = "'.$row['firstName'].'" required />
												  <label for="user_middlename">Middle Name:</label>
												  <input onkeypress="return /[0-9a-zA-Z @ _ .]/i.test(event.key)" type="text" id="lastName" class="form-control" name="lastName" value = "'.$row['lastName'].'" required />
												  
												  <label for="email">EMAIL:</label>
												  <input onkeypress="return /[0-9a-zA-Z @ _ .]/i.test(event.key)" type="text" id="email" class="form-control" name="email" value = "'.$row['email'].'" required />
												  <input type="hidden"class="form-control" name="user_email_old" value = "'.$row['email'].'" required />
												  
												  
												  <!--<label for="user_email_2">Email:</label>
													<select required class="form-control" name="user_email_2" id = "user_email_2" >
														<option selected>@dlshsi.edu.ph</option>
														<option selected>@yahoo.com</option>
													</select>-->
													
												  <label for="user_staff_photo">PHOTO:</label>
												  <input type="file" id="photo" class="form-control" name="photo" value = "'.$row['photo'].'" />
												  
												  <label for="password">PASSWORD:</label>
												  <input onkeypress="return /[0-9a-zA-Z_ ]/i.test(event.key)" type="text" id="password" class="form-control" name="password" value = "'.$row['password'].'" required />
												  '; 
												  ?>
												  <br/>
													<!--<label for = "user_priviledge">EMAIL NOTIFICATION:</label>
													  <div class="radio">
														<label>
														  <input type="radio" class="flats" name="enotif" value = "ON" <?php if($row['user_notification'] == 'ON'){ echo 'Checked'; } ?>> <b>ON</b> <i>Received mailing notifications when sending, receiving and other transactions inside the system.</i>
														</label>
													  </div>
													  <div class="radio">
														<label>
														  <input type="radio" class="flats" name="enotif" value = "OFF" <?php if($row['user_notification'] == 'OFF'){ echo 'Checked'; } ?>> <b>OFF</b> <i>Stop receiving mailing notifications.</i>
														</label>
													  </div>-->
								<?php echo '
											</div>
											<div class="modal-footer">
											  <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
												<button  type="submit" name = "update_user_details" class="btn btn-success" download><i class="fa fa-pencil"></i> Update</button>
											</div>
												</form>
										  </div>
										</div>
									  </div>
									  ';
					}
					echo '
					</tbody>
					</table>';
					?>
                  <div class="modal fade bs-example-modal-lg-create-account" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-user"></i> Create Account</h4>
                        </div>
                        <div class="modal-body">
                    <form method = "POST" class="form-horizontal form-label-left input_mask" autocomplete = "OFF" enctype="multipart/form-data">
							<input required id = "user_autoid" name="user_autoid" class="form-control input-sm" type="hidden" value = "<?php if($auto_id == 0){ echo $count;}else{ echo $adminadd; } ?>">
							<input required id = "user_staff_account_created_by" name="user_staff_account_created_by" class="form-control input-sm" type="hidden" value = "<?php echo $ADMIN_FIRSTNAME; echo ' '; echo $ADMIN_LASTNAME; ?>">
						<h2>User Identification</h2>
								<input required class="form-control" name="user_staffid" id = "user_staffid" type="hidden" value = "<?php if($autoID == 0){echo $staff_year;echo '-';echo $adminadd; }else{echo $staff_year;echo '-';echo $adminadd;}?>" readonly>
							<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
								<?php $startDate = time();$today = date('Y-m-d', strtotime('-1 day', $startDate));?>
								<label for = "user_staffdateregistration">Date of Registration:</label>
								<input required class="form-control" name="user_staffdateregistration" id = "user_staffdateregistration" type="text" value = "<?php echo $today; ?>" readonly>
							</div>
						<h2>Basic information</h2>
							<div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
								<label for = "user_staff_first_name">First Name:</label>
								<input onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)" required type="text" class="form-control" name = "user_staff_first_name" id="user_staff_first_name" placeholder="First Name">
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
								<label for = "user_staff_middle_name">Middle Name:</label>
								<input onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)" required type="text" class="form-control" name = "user_staff_middle_name" id="user_staff_middle_name" placeholder="Middle Name">
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
								<label for = "user_staff_last_name">Last Name:</label>
								<input onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)" required type="text" class="form-control" name = "user_staff_last_name" id="user_staff_last_name" placeholder="Last Name">
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
								<label for = "user_staff_contact">Contact:</label>
								<input onkeypress="return /[0-9]/i.test(event.key)" type="number" class="form-control" name = "user_staff_contact" id="user_staff_contact" placeholder="Contact No">
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
								<label for = "user_staff_email">Email:</label>
								<input onkeypress="return /[0-9a-zA-Z @ _ .]/i.test(event.key)" required type="text" class="form-control" name = "user_staff_email" id="user_staff_email" placeholder="Email">
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
								<label for = "user_staff_photo">Photo:</label>
								<input type="file" class="form-control" name = "user_staff_photo" id="user_staff_photo">
							</div>
                    <div class="clearfix"></div>
						<h2>User Account</h2>
							<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
								<label for = "user_staff_username">Admin Username:</label>
								<input onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)" required type="text" class="form-control" name = "user_staff_username" id="user_staff_username">
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
								<label for = "user_staff_password">Auto Generated Admin Password:</label>
								<input required type="text" class="form-control" name = "user_staff_password" id="user_staff_password" value = "<?php echo generateRandomString();?>">
							</div>
							<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
								<label for = "user_priviledge">Account Priviledges:</label>
								<?php
								if($ADMIN_PRIVILEDGE == 'Admin' && $ADMIN_USER_DEPARTMENT == '1'){ ?>
								  <div class="radio">
									<label>
									  <input type="radio" class="flat" name="iCheck" value = "Admin"> <b>Admin</b> <i>Admin: Can access all modification inside the system.</i>
									</label>
								  </div>
								  <div class="radio">
									<label>
									  <input checked type="radio" class="flat" name="iCheck" value = "Guest"> <b>Guest</b> <i>Guest: Are the customers and only have access to the frontend of the website.</i>
									</label>
								  </div>
								  <?php }elseif($ADMIN_PRIVILEDGE == 'Admin'){ ?>
								  </div>
								  <div class="radio">
									<label>
									  <input checked type="radio" class="flat" name="iCheck" value = "Guest"> <b>Guest</b> <i>Guest: Are the customers and only have access to the frontend of the website.</i>
									</label>
								  </div>
								<?php } ?>
							</div>
						
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
								<button class="btn btn-danger" type="reset"><i class="fa fa-refresh"></i> Reset</button>
								<button name = "save_staff_user_account" class="btn btn-success" type="submit"><i class="fa fa-save"></i> Save</button>
                        </div>
                    </form>
                      </div>
                    </div>
                  </div>
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
<script src="_plugins/jquery.min.js"></script>
<script type="text/javascript">
$(function() {
$(".remove_signatory").click(function(){
var element = $(this);
var del_id = element.attr("id");
var info = 'id=' + del_id;
 if(confirm("Are you sure you want to remove this user as signatory?"))
		  {
 $.ajax({
   type: "GET",
   url: "_delete/remove_signatory.php",
   data: info,
   success: function(){   
   }
 });
         $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");
 }
return false;
});
});
</script>
<script type="text/javascript">
$(function() {
$(".activate_account").click(function(){
var element = $(this);
var del_id = element.attr("id");
var info = 'id=' + del_id;
 if(confirm("Are you sure you want to ACTIVATE this account?"))
		  {
 $.ajax({
   type: "GET",
   url: "_delete/activate_accounts.php",
   data: info,
   success: function(){   
   }
 });
         $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");
 }
return false;
});
});
</script>
<script type="text/javascript">
$(function() {
$(".deactivate_account").click(function(){
var element = $(this);
var del_id = element.attr("id");
var info = 'id=' + del_id;
 if(confirm("Are you sure you want to DEACTIVATE this account?"))
		  {
 $.ajax({
   type: "GET",
   url: "_delete/deactivate_accounts.php",
   data: info,
   success: function(){   
   }
 });
         $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");
 }
return false;
});
});
</script>

<?php include '_partial/partial_footscripts_datatables.php'; ?>
  </body>
</html>
