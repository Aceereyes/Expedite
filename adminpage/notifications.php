<!DOCTYPE html>
<html lang="en">
<?php 
include '_connections/_database_connection.php';
include '_connections/_session_connection.php';
include '_partial/partial_head.php'; 
@$collegedepartment = $_GET['department'];

$ADMIN_SIDEBAR = $ADMIN_LOGIN_VIEW['user_priviledge_level'];

?>
  <body class="nav-md footer_fixed">
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
						<h2><i class="fa fa-bell"></i> NOTIFICATIONS</h2>
						<div class="clearfix"></div>
						</div>
					  <div class="x_content">
					  
						<div class="" role="tabpanel" data-example-id="togglable-tabs">
						  <ul id="myTab1" class="nav nav-tabs bar_tabs left" role="tablist">
							<?php
								$ADMIN_PRIVILEDGE_level = $ADMIN_LOGIN_VIEW['user_priviledge_level'];
								if(($ADMIN_PRIVILEDGE_level == 'Moderator') || ($ADMIN_PRIVILEDGE_level == 'Admin')){
							?>
							<li role="presentation" class="active"><a href="#tab_content11" id="home-tabb" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">DOWNLOAD FILES</a>
							</li>
							<li role="presentation" class=""><a href="#tab_content22" role="tab" id="profile-tabb" data-toggle="tab" aria-controls="profile" aria-expanded="false">RECEIVE FILES</a>
							</li>
							<?php } ?>
							<li role="presentation" class=""><a href="#tab_content33" role="tab" id="profile-tabb3" data-toggle="tab" aria-controls="profile" aria-expanded="false">FILE APPROVALS</a>
							</li>
						  </ul>
						  <div id="myTabContent2" class="tab-content">
							<div role="tabpanel" class="tab-pane fade active in" id="tab_content11" aria-labelledby="home-tab">
								<?php 
									include 'notification_downloads.php';
								?>
							</div>
							<div role="tabpanel" class="tab-pane fade" id="tab_content22" aria-labelledby="profile-tab">
								<?php
									include 'notification_sent.php';
								?>
							</div>
							<div role="tabpanel" class="tab-pane fade" id="tab_content33" aria-labelledby="profile-tab">
								<?php
									include 'notification_filewapproval.php';
								?>
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
$(".delete_dept").click(function(){
var element = $(this);
var del_id = element.attr("id");
var info = 'id=' + del_id;
 if(confirm("Are you sure you want to delete this DEPARTMENT?"))
		  {
 $.ajax({
   type: "GET",
   url: "_delete/delete_dept.php",
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

