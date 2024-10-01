<?php 
include '_connections/_database_connection.php';
include '_connections/_session_connection.php';
include '_partial/partial_head.php'; 
?>
<!DOCTYPE html>
<html lang="en">
	<link rel="stylesheet" href="richtexteditor/rte_theme_default.css" />
	<script type="text/javascript" src="richtexteditor/rte.js"></script>
	<script type="text/javascript" src="richtexteditor/plugins/all_plugins.js"></script>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
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
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>
					<?php
						echo '<h2>';
						if(isset($_POST['mission_save'])){
							echo '<img src = "loading.gif" height = "25"/>';
						}elseif(isset($_POST['history_save'])){
							echo '<img src = "loading.gif" height = "25"/>';
						}elseif(isset($_POST['vision_save'])){
							echo '<img src = "loading.gif" height = "25"/>';
						}
					?>
					<?php
					if(isset($_POST['save_slider_photo'])){
						echo '<img src="_photos/systemimages/loading.gif"><meta http-equiv="refresh" content="5; url=slider.php">';
						
					}elseif(isset($_POST['edit_slider_photo'])){
						echo '<img src="_photos/systemimages/loading.gif"><meta http-equiv="refresh" content="5; url=slider.php">';
						
					}else{
					echo '<i class="fa fa-info"></i> Home';
					}
					?>
					</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><button type="button" class="btn btn-success" data-toggle="modal" data-target=".bs-example-modal-add_new_slider_photo"><i class="fa fa-plus"></i> Add Photo</button>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  
				  <div class="x_content">
				<?php
				  if(isset($_POST['reply_user'])){	 
						
						
						$inbox_id = $_POST['inbox_id'];
						$name = $_POST['name'];
						$email = $_POST['email'];
						$subject = $_POST['subject'];
						$message = $_POST['message'];
						$created_at = $_POST['created_at'];
						
						$reply_name = ''.$name.'';
						$contactinformation_email = $_POST['contactinformation_email'];
						$reply_subject = 'REPLY - '.$subject.'';
						$reply_message = $_POST['reply_message'];
						$reply_date = date("F d, Y - h:i A");
						
						
            $subject = $_POST['subject'];
            $content = $_POST['message'];

						mysqli_query($conn, "INSERT INTO tbl_crm_reply 	(inbox_id, name, email, subject, message, date, reply_name, reply_email, reply_subject, reply_message, created_at)
								VALUES('.$inbox_id.','$name','$email','$subject','$message','$created_at','$reply_name','$contactinformation_email','$reply_subject','$reply_message','$reply_date')");
						//include 'mail.php';
						echo '
						<div class="alert alert-success alert-dismissible fade in" role="alert">
							<i class = "fa fa-info-circle"></i>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
							Message has been successfully sent to <b>'.$name.' - '.$email.'</b>.
						</div>
							<meta http-equiv="refresh" content="3; url=inquiries.php">
						';
				  }
					echo '
						<table id="datatable" class="table-hover table table-striped table-bordered">
							<thead>
								<tr>
									<th>ID</th>
									<th>Name</th>
									<th>Email</th>
									<th>Subject</th>
									<th>Time & Date</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							';
					$message=mysqli_query($conn, "SELECT * FROM tbl_crm_messages");
					while($row=mysqli_fetch_array($message))
					{
					echo '	
								<tr class="record">
									<td>'.$row['id'].'</td>
									<td>'.$row['name'].'</td>
									<td>'.$row['email'].'</td>
									<td>'.$row['subject'].'</td>
									<td>'.$row['created_at'].'</td>
									<td>
										<a data-toggle="modal" data-target=".bs-example-modal-view_user_'.$row['id'].'" class = "btn btn-xs btn-info"><i class="fa fa-eye"></i> View</a>
										<a data-toggle="modal" data-target=".bs-example-modal-reply_user_'.$row['id'].'" class = "btn btn-xs btn-info"><i class="fa fa-send"></i> Reply</a>
									</td>
								</tr>
							';
						echo '
                  <div class="modal fade bs-example-modal-reply_user_'.$row['id'].'" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-photo"></i> Reply to <b>'.$row['name'].'</B></h4>
                        </div>
												<form method = "POST">
													<div class="modal-body">
															  <input type = "hidden" value = "'.$row['id'].'" name = "inbox_id" class = "form-control" readonly/>
															  <input type = "hidden" value = "'.$row['name'].'" name = "name" class = "form-control" readonly/>
															  <input type = "hidden" value = "'.$row['email'].'" name = "email" class = "form-control" readonly/>
															  <input type = "hidden" value = "'.$row['created_at'].'" name = "created_at" class = "form-control" readonly/>
															  <label>Subject:</label>
															  <input type = "text" value = "'.$row['subject'].'" name = "subject" class = "form-control" readonly/>
															  <br>
															  <label>Message:</label>
															  <textarea type = "text" name = "message" class = "form-control" readonly required/>'.$row['message'].'</textarea>
															  <br>
															  <label>My Email:</label>
															  <input type = "text" value = "" name = "contactinformation_email" class = "form-control" required/>
															  <br>
															  <label>Reply:</label>
															  <textarea type = "text" Placeholder = "Reply Message" name = "reply_message" class = "form-control" required></textarea>
															  <br>
													</div>
													<div class="modal-footer">
													  <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
															  <button type="submit" name = "reply_user" class="btn btn-primary"><i class="fa fa-send"></i> Send</button>
													</div>
												</form>
                      </div>
                    </div>
                  </div>
									 ';
						echo '
						
                  <div class="modal fade bs-example-modal-view_user_'.$row['id'].'" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-photo"></i> Add New Photo</h4>
                        </div>
							<form id="demo-form" method = "POST" enctype="multipart/form-data" data-parsley-validate>
                        
											<div class="modal-body">
												  <label>Email:</label>
												  <br>
												  '.$row['email'].'
												  <br>
												  <br>
												  <label>Subject:</label>
												  <br>
												  '.$row['subject'].'
												  <br>
												  <br>
												  <label>Message:</label>
												  <br>
												  '.$row['message'].'
												  <br>
												  <br>
												  <label>Date & Time:</label>
												  <br>
												  '.$row['created_at'].'
												  <br>
												  <br>
											</div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
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
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
		
                  <!-- ADD SLIDER PHOTO -->
                  <div class="modal fade bs-example-modal-add_new_slider_photo" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-photo"></i> Add New Photo</h4>
                        </div>
							<form id="demo-form" method = "POST" enctype="multipart/form-data" data-parsley-validate>
                        <div class="modal-body">
						<p><b>NOTE:</b> <i>Photo's size must not higher than (width = 1520 and height = 592 or 1520x592) for perfect display on homepage.</i></p>
							  <label for="slider_photo">Photo:</label>
							  <input type="file" name = "slider_image" id="slider_photo" class="form-control" required />

						</div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                          <button type="submit" name = "save_slider_photo" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                        </div>
							</form>
                      </div>
                    </div>
                  </div>
                  <!-- /ADD SLIDER PHOTO -->
        <!-- footer content -->
<?php include '_partial/partial_footer.php'; ?>
        <!-- /footer content -->
      </div>
    </div>
<?php include '_partial/partial_footscripts.php'; ?>
  </body>
</html>
