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
                    <h2><i class="fa fa-send"></i> Sent</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
				  <?php
					echo '
						<table id="datatable" class="table-hover table table-striped table-bordered">
							<thead>
								<tr>
									<th>To Name</th>
									<th>To Email</th>
									<th>Subject-Reply</th>
									<th>Time & Date Reply</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							';
					$message=mysqli_query($conn, "SELECT * FROM sent ORDER BY id DESC");
					while($row=mysqli_fetch_array($message))
					{
					echo '	
								<tr class="record">
									<td>'.$row['name'].'</td>
									<td>'.$row['email'].'</td>
									<td>'.$row['subject'].'</td>
									<td>'.$row['reply_date'].'</td>
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
											  <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-user"></i> View <b>'.$row['name'].'</b>\'s Message Reply</h4>
											</div>
											<div class="modal-body">
												<h2>Message Sender</h2>
													  <label>Email:</label>
													  <br>
													  '.$row['email'].'
													  <br>
													  <label>Subject:</label>
													  <br>
													  '.$row['subject'].'
													  <br>
													  <label>Message:</label>
													  <br>
													  '.$row['message'].'
													  <br>
													  <label>Date & Time:</label>
													  <br>
													  '.$row['date'].'
													  <br>
													  <br>
												<h2>Message Reply</h2>
													  <label>Reply Name:</label>
													  <br>
													  '.$row['reply_name'].'
													  <br>
													  <label>Reply Email:</label>
													  <br>
													  '.$row['reply_email'].'
													  <br>
													  <label>Reply Subject:</label>
													  <br>
													  '.$row['reply_subject'].'
													  <br>
													  <label>Reply Message:</label>
													  <br>
													  '.$row['reply_message'].'
													  <br>
													  <label>Reply Date:</label>
													  <br>
													  '.$row['reply_date'].'
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
