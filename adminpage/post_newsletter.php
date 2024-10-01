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
                    <h2><i class="fa fa-envelope"></i> Newsletter</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><button type="button" class = "btn btn-success" data-toggle="modal" data-target=".bs-example-modal-lg-post_letter"><i class="fa fa-plus"></i> Post Newsletter</button>
                      </li>
                      <!--<li><button type="button" class = "btn btn-success" data-toggle="modal" data-target=".bs-example-modal-lg-post_fbnews"><i class="fa fa-plus"></i> Post Facebook News</button>
                      </li>-->
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
				  <?php
					if(isset($_POST['post_newsletter'])){
						$email = $_POST['email'];
						$date = $_POST['date'];
						$cc_email = $_POST['cc_email'];
						$subject = $_POST['subject'];
						$message = $_POST['message'];
						
						$file=$_FILES['photo_msg']['tmp_name'];
									$photo_msg= addslashes(file_get_contents($_FILES['photo_msg']['tmp_name']));
									$image_name= addslashes($_FILES['photo_msg']['name']);
									$image_size= getimagesize($_FILES['photo_msg']['tmp_name']);
									//mkdir('_photos/newsletter/'.$user_staff_first_name.''.$user_staff_middle_name.''.$user_staff_last_name.'');

									move_uploaded_file($_FILES["photo_msg"]["tmp_name"],"_photos/newsletter/" . $_FILES["photo_msg"]["name"]);

									$photo_msg=$_FILES["photo_msg"]["name"];
						
						mysqli_query($conn, "INSERT into newsletter (email,subject,message,date,photo)VALUES('$email','$subject','$message','$date','$photo_msg')");
						include 'mail_newsletter.php';
							echo '
							<div class="alert alert-success alert-dismissible fade in" role="alert">
								<i class = "fa fa-check-circle"></i> <b>MESSAGE SENT!</b>
								</br>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
								Newsletter has been sent to subscribers.
								</br>
							</div>';
						echo '<META HTTP-EQUIV="REFRESH" CONTENT="5;URL=post_newsletter.php">';
					}
					if(isset($_POST['post_fbnews'])){
						$post_type = $_POST['post_type'];
						$post_no = $_POST['post_no'];
						mysqli_query($conn, "INSERT into facebook_post (type,post_id)VALUES('$post_type','$post_no')");
						echo '<META HTTP-EQUIV="REFRESH" CONTENT="3;URL=post_newsletter.php">';
					}
				  ?>
					<div class="modal fade bs-example-modal-lg-post_fbnews" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog modal-sm">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
									<h4 class="modal-title" id="myModalLabel2"><i class="fa fa-facebook"></i> Post Facebook Post</h4>
								</div>
								<form method = "POST">
									<div class="modal-body">
										<label>Post Type:</label>
										<select class = "form-control" name = "post_type">
											<option>TEXT</option>
											<option>PHOTO</option>
										</select>
										<label>Subject:</label>
										<input type = "text" placeholder = "Post No." name = "post_no" class = "form-control"/>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
											<button type="submit" name = "post_fbnews" class="btn btn-primary"><i class="fa fa-send"></i> Send</button>
										</div>
									</form>
							</div>
						</div>
					</div>
					<div class="modal fade bs-example-modal-lg-post_letter" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog modal-sm">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
									<h4 class="modal-title" id="myModalLabel2"><i class="fa fa-envelope"></i> Post Newsletter Message</h4>
								</div>
								
								<?php
								?>
								<form method = "POST" enctype="multipart/form-data">
								<?php 
									$date = date("F d, Y - h:i A");
									$contactinformation = mysqli_query($conn, "SELECT * FROM contactinformation WHERE id = '1'");
									$contactinformation_view = mysqli_fetch_array($contactinformation);
									$contact_email = $contactinformation_view['email'];
								?>
									<div class="modal-body">
										<label>My Email:</label>
										<input type = "text" value = "<?php echo $contact_email; ?>" name = "email" class = "form-control" readonly/>
										<br>
										<label>Date & Time:</label>
										<input type = "text" value = "<?php echo $date; ?>" name = "date" class = "form-control" readonly/>
										<br>
										<label>CC Email:</label>
										<textarea type = "text" style = "height: 150px; max-height: 150px; width: 268px;" name = "cc_email" class = "form-control" readonly><?php 
										$subscribe_email=mysqli_query($conn, "SELECT * FROM subscribe");
										while($subscribe_email_show=mysqli_fetch_array($subscribe_email))
										{
											echo ''.$subscribe_email_show['email'].', ';
										}
										?>
										</textarea>
										<br>
										<label>Subject:</label>
										<input type = "text" placeholder = "Subject" name = "subject" class = "form-control"/>
										<br>
										<label>Message:</label>
										<textarea type = "text" style = "height: 150px; max-height: 150px; width: 268px;" placeholder = "Message" name = "message" class = "form-control"></textarea>
										<br>
										<label>Photo:</label>
										<input type="file" class="form-control" name = "photo_msg" id="photo_msg">
										<br>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
											<button type="submit" name = "post_newsletter" class="btn btn-primary"><i class="fa fa-send"></i> Send</button>
										</div>
									</form>
							</div>
						</div>
					</div>
				  <?php
				  if(isset($_POST['reply_user'])){	  
						$inbox_id = $_POST['inbox_id'];
						$name = $_POST['name'];
						$email = $_POST['email'];
						$subject = $_POST['subject'];
						$message = $_POST['message'];
						$date = $_POST['date'];
						
						
						
						$reply_name = 'MAMECEA-AFW INQUIRY';
						$contactinformation_email = $_POST['contactinformation_email'];
						$reply_subject = 'REPLY-'.$subject.'';
						$reply_message = $_POST['reply_message'];
						$reply_date = date("F d, Y - h:i A");
						
						
						mysqli_query($conn, "INSERT INTO sent 	(inbox_id, name, email, subject, message, date, reply_name, reply_email, reply_subject, reply_message, reply_date)
								VALUES('.$inbox_id.','$name','$email','$subject','$message','$date','$reply_name','$contactinformation_email','$reply_subject','$reply_message','$reply_date')");
						include 'mail.php';
						echo '
						<div class="alert alert-success alert-dismissible fade in" role="alert">
							<i class = "fa fa-info-circle"></i>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
							Message has been successfully sent to <b>'.$name.' - '.$email.'</b>.
						</div>
							<meta http-equiv="refresh" content="3; url=inbox.php">
						';
				  }
				  ?>
				  


						<?php
							echo '
								<table id="datatable" class="table-hover table table-striped table-bordered">
									<thead>
										<tr>
											<th>Subject</th>
											<th>Date</th>
											<th>View Content</th>
										</tr>
									</thead>
									<tbody>
									';
							$message=mysqli_query($conn, "SELECT * FROM newsletter ORDER BY id DESC");
							while($row=mysqli_fetch_array($message))
							{
							echo '	
										<tr class="record">
											<td>'.$row['subject'].'</td>
											<td>'.$row['date'].'</td>
											<td>
												<a data-toggle="modal" data-target=".bs-example-modal-view_user_'.$row['id'].'" class = "btn btn-xs btn-info"><i class="fa fa-eye"></i> View</a>
											</td>
										</tr>
									';
								echo '
											<div class="modal fade bs-example-modal-view_user_'.$row['id'].'" tabindex="-1" role="dialog" aria-hidden="true">
												<div class="modal-dialog modal-sm">
												  <div class="modal-content">

													<div class="modal-header">
													  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
													  </button>
													  <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-user"></i> View Newsletter</h4>
													</div>
													<div class="modal-body">
														  <label>Date:</label>
														  <br>
														  '.$row['date'].'
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
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
        <!-- footer content -->
<?php include '_partial/partial_footer.php'; ?>
<script src="_plugins/jquery.min.js"></script>
<script type="text/javascript">
$(function() {
$(".delete_user").click(function(){
var element = $(this);
var del_id = element.attr("id");
var info = 'id=' + del_id;
 if(confirm("Are you sure you want to delete this facebook post?"))
		  {
 $.ajax({
   type: "GET",
   url: "_delete/delete_facebookpost.php",
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
        <!-- /footer content -->
      </div>
    </div>
<?php include '_partial/partial_footscripts_datatables.php'; ?>
  </body>
</html>
