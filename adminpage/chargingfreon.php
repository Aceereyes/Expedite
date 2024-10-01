<?php 
include '_connections/_database_connection.php';
include '_connections/_session_connection.php';
include '_partial/partial_head.php'; 
?>
<!DOCTYPE html>
<html lang="en">
  <body class="nav-md footer_fixed">
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
                    <h2><i class="fa fa-users"></i> Services</h2>
                    <!--<ul class="nav navbar-right panel_toolbox">
                      <li><button type="button" class = "btn btn-success" data-toggle="modal" data-target=".bs-example-modal-lg-add_services"><i class="fa fa-plus"></i> Add Services</button>
                      </li>
                    </ul>-->
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
				  <?php
					if(isset($_POST['repair_item'])){
						$iCheckstatus = $_POST['iCheckstatus'];
						$remarks = $_POST['remarks'];
						$repair_id = $_POST['repair_id'];
						$user_id = $_POST['user_id'];
						$item = $_POST['item'];
						$date_today = date("F d, Y");
						$time_today = date("h:i A");
									
						/*$file=$_FILES['servicephoto']['tmp_name'];
						$servicephoto= addslashes(file_get_contents($_FILES['servicephoto']['tmp_name']));
						$image_name= addslashes($_FILES['servicephoto']['name']);
						$image_size= getimagesize($_FILES['servicephoto']['tmp_name']);
						mkdir('_photos/services/'.$servicename.'');
						move_uploaded_file($_FILES["servicephoto"]["tmp_name"],"_photos/services/".$servicename."/" . $_FILES["servicephoto"]["name"]);
						$servicephoto=$_FILES["servicephoto"]["name"];*/

						mysqli_query($conn, "UPDATE chargingfreon SET status = '$iCheckstatus', remarks = '$remarks' WHERE id = $repair_id");
							echo '
							<div class="alert alert-success alert-dismissible fade in" role="alert">
								<i class = "fa fa-check-circle"></i> <b>NEW SERVICE!</b>
								</br>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
								Item <b>'.$item.'</b> status has been successfully updated.
								</br>
							</div>';
						echo '<META HTTP-EQUIV="REFRESH" CONTENT="3;URL=chargingfreon.php">';
					}
					
					if(isset($_POST['delete_services'])){
						date_default_timezone_set("Asia/Manila");
						ini_set('max_execution_time', '900');
						$delete_services_id = $_POST['delete_services_id'];
						$user_id = $_POST['user_id'];
						$user_password = $_POST['user_password'];
						$user_passwordenc = password_hash($user_password, PASSWORD_BCRYPT);
						$select_user = mysqli_query($conn, "SELECT * FROM user_admins WHERE user_id = '$user_id'");
						$select_user_view = mysqli_fetch_array($select_user);
						$user_passwordenc = $select_user_view['user_passwordenc'];
							if(password_verify($user_password, $user_passwordenc)) {
								$select_user = mysqli_query($conn, "SELECT * FROM services WHERE id = '$delete_services_id'");
								$select_user_view = mysqli_fetch_array($select_user);
								
								$services = $select_user_view['services'];
								$description = $select_user_view['description'];
								$photo = $select_user_view['photo'];
										
								unlink("_photos/services/$services/$photo");
									
								rmdir("_photos/services/$services/");
								
								mysqli_query($conn, "DELETE FROM services WHERE id = '$delete_services_id'");
								
								
								/*date_default_timezone_set("Asia/Manila");
								$time_today = date("H:i:s");
								$date_today = date("Y-m-d");
								$activity = 'Deleting department <b>'.$user_firstname.' '.$user_lastname.'</b>, using <b>'.$ADMIN_FIRSTNAME.' '.$ADMIN_LASTNAME.'</b> account.';
								$module = 'Delete account.';
								$link = 'user_accounts.php';
								$result = 'Account of <b>'.$user_firstname.' '.$user_lastname.'</b> is successfully deleted.';
								$insert_activity = mysqli_query($conn, "INSERT INTO activity_logs 
								(time,date,activity,module,link,result,user_id) VALUES 
								('$time_today','$date_today','$activity','$module','$link','$result','$ADMIN_USERID')");*/
								echo '<META HTTP-EQUIV="REFRESH" CONTENT="3;URL=services.php">';
								echo '
								<div class="alert alert-success alert-dismissible fade in" role="alert">
									<i class = "fa fa-info-circle"></i> DELETING SERVICES!
									<br/>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
									The services <b>'.$services.'</b> was succesfully deleted.
								</div>';
							}else{
													
								/*date_default_timezone_set("Asia/Manila");
								$time_today = date("H:i:s");
								$date_today = date("Y-m-d");
								$activity = 'Deleting department <b>'.$user_firstname.' '.$user_lastname.'</b>, using <b>'.$ADMIN_FIRSTNAME.' '.$ADMIN_LASTNAME.'</b> account.';
								$module = 'Delete account.';
								$link = 'user_accounts.php';
								$result = 'Account of <b>'.$user_firstname.' '.$user_lastname.'</b> is unsuccessfully deleted.';
								$insert_activity = mysqli_query($conn, "INSERT INTO activity_logs 
								(time,date,activity,module,link,result,user_id) VALUES 
								('$time_today','$date_today','$activity','$module','$link','$result','$ADMIN_USERID')");*/
								echo '<META HTTP-EQUIV="REFRESH" CONTENT="1;URL=inventory.php">';
								echo '
								<div class="alert alert-danger alert-dismissible fade in" role="alert">
									<i class = "fa fa-warning"></i> DELETING ACCOUNT!
									<br/>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
									Invelid password.
								</div>';
							}
						}
					echo '
						<table id="datatable" class="table-hover table table-striped table-bordered">
							<thead>
								<tr>
									<th>Item Repaired</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							';
					$message=mysqli_query($conn, "SELECT * FROM chargingfreon");
					while($row=mysqli_fetch_array($message))
					{
					echo '	
								<tr>
									<td>'.$row['item'].'</td>
									<td>'.$row['status'].'</td>
									<td>
										<a data-toggle="modal" data-target=".bs-example-modal-view_user_'.$row['id'].'" class = "btn btn-xs btn-info"><i class="fa fa-eye"></i> VIEW</a>
										<a data-toggle="modal" data-target=".bs-example-modal-change_status'.$row['id'].'" class = "btn btn-xs btn-primary"><i class="fa fa-recycle"></i> STATUS</a>
									</td>
								</tr>
							';
										//<a data-toggle="modal" data-target=".bs-example-modal-delete_user'.$row['id'].'" class = "btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> DELETE</a>
							
							
	echo '
				<div class="modal fade bs-example-modal-change_status'.$row['id'].'" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-user"></i> UPDATE REPAIRING</h4>
                        </div>
								<div class="modal-body" style = "margin-top:-15px;">
								
									<div class=" form-group has-feedback">';
								echo '
									</div>
									<form method = "POST" class="form-horizontal form-label-left input_mask" autocomplete = "OFF" enctype="multipart/form-data">
											<div class=" form-group has-feedback">
												<input value = "'.$row['id'].'" type="hidden" name = "repair_id">
												<input value = "'.$row['item'].'" type="hidden" name = "item">
												<input value = "'.$ADMIN_USERID.'" type="hidden" name = "user_id">
											</div>
											<div class=" form-group has-feedback">
											<label>Status</label>
												<div class="radio">
													<label>
														<input type="radio" class="flats" name="iCheckstatus" value = "PENDING" checked /> <b>PENDING</b>
													</label>
												</div>
												<div class="radio">
													<label>
														<input type="radio" class="flats" name="iCheckstatus" value = "ONGOING"/> <b>ONGOING</b>
													</label>
												</div>
												<div class="radio">
													<label>
														<input type="radio" class="flats" name="iCheckstatus" value = "DONE"/> <b>DONE</b>
													</label>
												</div>
												<div class="radio">
													<label>
														<input type="radio" class="flats" name="iCheckstatus" value = "DECLINE"/> <b>DECLINE</b>
													</label>
												</div>
												<label for = "remarks">Remarks:</label>
												<input required type="text" class="form-control" name = "remarks" id="remarks">
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
											<button class="btn btn-danger" type="reset"><i class="fa fa-refresh"></i> Reset</button>
											<button name = "repair_item" class="btn btn-success" type="submit"><i class="fa fa-save"></i> Save</button>
										</div>
									</form>	
								</div>
						</div>
                    </div>
				</div>';
	echo '
				<div class="modal fade bs-example-modal-delete_user'.$row['id'].'" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-user"></i> DELETE SERVICES</h4>
                        </div>
								<div class="modal-body" style = "margin-top:-15px;">
								
									<div class=" form-group has-feedback">';
								echo '
									</div>
									<div class=" form-group has-feedback">
										<label>Are you sure you want to delete this service ('.$row['services'].')?</label>
									</div>
							<form method = "POST" class="form-horizontal form-label-left input_mask" autocomplete = "OFF" enctype="multipart/form-data">
									<div class=" form-group has-feedback">
										<input value = "'.$row['id'].'" type="hidden" name = "delete_services_id">
										<input value = "'.$ADMIN_USERID.'" type="hidden" name = "user_id">
									</div>
									<div class=" form-group has-feedback">
										<label for = "user_password">PASSWORD:</label>
										<input value = "" onkeypress="return /[0-9a-zA-Z !@#$%^&*()_ - + = ]/i.test(event.key)" required type="password" class="form-control" name = "user_password" id="user_password">
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
									<button class="btn btn-danger" type="reset"><i class="fa fa-refresh"></i> Reset</button>
									<button name = "delete_services" class="btn btn-success" type="submit"><i class="fa fa-save"></i> Save</button>
								</div>
							</form>
                      </div>
                    </div>
				</div>';
						echo '
									<div class="modal fade bs-example-modal-view_user_'.$row['id'].'" tabindex="-1" role="dialog" aria-hidden="true">
										<div class="modal-dialog modal-sm">
										  <div class="modal-content">

											<div class="modal-header">
											  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
											  </button>
											  <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-user"></i> View <b>'.$row['item'].'</b>\'s Information</h4>
											</div>
											<div class="modal-body">
												<label>Item Name:</label>
												<br>
												'.$row['item'].'
												<br>
												<br>
												<label>Description:</label>
												<br>
												'.$row['description'].'
												<br>
												<br>
												<label>Status:</label>
												<br>
												'.$row['status'].'
												<br>
												<br>
												<label>Remarks:</label>
												<br>
												'.$row['remarks'].'
												<br>
												<br>
												<label>Date & Time of Request:</label>
												<br>
												'.$row['date'].' - '.$row['time'].'
												<br>
												<br>
											</div>
											<div class="modal-footer">
											  <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
											</div>
										  </div>
										</div>
									  </div>
									  ';
					}
					echo '
					</tbody>
					</table>';
					?>
                  </div>
				  
					<div class="modal fade bs-example-modal-lg-add_services" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog modal-sm">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
									<h4 class="modal-title" id="myModalLabel2"><i class="fa fa-envelope"></i> Add Services</h4>
								</div>
								<form method = "POST" enctype="multipart/form-data">
									<div class="modal-body">
										<label>Service Name:</label>
										<input type = "text" placeholder = "Service Name" name = "servicename" class = "form-control"/>
										<br>
										<label>Description:</label>
										<textarea type = "text" placeholder = "Description" name = "description" class = "form-control"></textarea>
										<br>
										<label>Photo:</label>
										<input type = "file" name = "servicephoto" accept="image/png, image/gif, image/jpeg" class = "form-control" required />
										<br>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
											<button type="submit" name = "add_new_service" class="btn btn-primary"><i class="fa fa-send"></i> Send</button>
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
        <!-- /page content -->

        <!-- footer content -->
<?php include '_partial/partial_footer.php'; ?>
        <!-- /footer content -->
      </div>
    </div>
<script src="_plugins/jquery.min.js"></script>

<?php include '_partial/partial_footscripts_datatables.php'; ?>
  </body>
</html>
