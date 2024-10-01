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
                    <h2><i class="fa fa-users"></i> User's Account</h2>
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
					echo '
						<table id="datatable" class="table-hover table table-striped table-bordered">
							<thead>
								<tr>
									<th>Name</th>
									<th>Email</th>
									<th>Subject</th>
									<th>Time & Date</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							';
					$message=mysqli_query($conn, "SELECT * FROM inbox");
					while($row=mysqli_fetch_array($message))
					{
					echo '	
								<tr class="record">
									<td>'.$row['name'].'</td>
									<td>'.$row['email'].'</td>
									<td>'.$row['subject'].'</td>
									<td>'.$row['date'].'</td>
									<td>
										<a data-toggle="modal" data-target=".bs-example-modal-view_user_'.$row['id'].'" class = "btn btn-xs btn-info"><i class="fa fa-eye"></i> View</a>
										<a data-toggle="modal" data-target=".bs-example-modal-reply_user_'.$row['id'].'" class = "btn btn-xs btn-info"><i class="fa fa-send"></i> Reply</a>
									</td>
								</tr>
							';
					$contactinformation = mysqli_query($conn, "SELECT * FROM contactinformation WHERE id = '1'");
					$contactinformation_view = mysqli_fetch_array($contactinformation);
						echo '
									<div class="modal fade bs-example-modal-reply_user_'.$row['id'].'" tabindex="-1" role="dialog" aria-hidden="true">
										<div class="modal-dialog modal-sm">
										  <div class="modal-content">

											<div class="modal-header">
											  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
											  </button>
											  <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-user"></i> View <b>'.$row['name'].'</b>\'s Message</h4>
											</div>
												<form method = "POST">
													<div class="modal-body">
															  <input type = "text" value = "'.$row['id'].'" name = "inbox_id" class = "form-control" readonly/>
															  <label>Name:</label>
															  <input type = "text" value = "'.$row['name'].'" name = "name" class = "form-control" readonly/>
															  <br>
															  <label>Email:</label>
															  <input type = "text" value = "'.$row['email'].'" name = "email" class = "form-control" />
															  <br>
															  <label>Subject:</label>
															  <input type = "text" value = "'.$row['subject'].'" name = "subject" class = "form-control" readonly/>
															  <br>
															  <label>Message:</label>
															  <input type = "text" value = "'.$row['message'].'" name = "message" class = "form-control" readonly/>
															  <br>
															  <label>Date & Time:</label>
															  <input type = "text" value = "'.$row['date'].'" name = "date" class = "form-control" readonly/>
															  <br>
															  <label>My Email:</label>
															  <input type = "text" value = "'.$contactinformation_view['email'].'" name = "contactinformation_email" class = "form-control"/>
															  <br>
															  <label>Reply:</label>
															  <textarea type = "text" Placeholder = "Reply Message" name = "reply_message" class = "form-control"></textarea>
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
											  <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-user"></i> View <b>'.$row['name'].'</b>\'s Message</h4>
											</div>
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
												  '.$row['date'].'
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
