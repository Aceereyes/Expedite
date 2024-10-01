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

                    <div class="">
                      <!-- required for floating -->
                      <!-- Nav tabs -->
                      <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li class="active"><a href="#about" data-toggle="tab">About Page Preview</a>
                        </li>
                        <li><a href="#home" data-toggle="tab">News & Updates</a>
                        </li>
                      </ul>
						<?php
							if(isset($_POST['mission_save'])){ ?>
							<div class="x_panel">
								<div class="x_title">
									<h2><i class="fa fa-pencil"></i> CHANGES MISSION RESULT</h2>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
								<?php
								if(isset($_POST['mission_save'])){
									$mission = $_POST['mission'];
									echo ''.$mission.'';
								}elseif(isset($_POST['history_save'])){
									$history = $_POST['history'];
									echo ''.$history.'';
								}elseif(isset($_POST['vision_save'])){
									$vision = $_POST['vision'];
									echo ''.$vision.'';
								}
								?>
								</div>
							</div>
						<?php }elseif(isset($_POST['history_save'])){ ?>
							<div class="x_panel">
								<div class="x_title">
									<h2><i class="fa fa-pencil"></i> CHANGES HISTORY RESULT</h2>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
								<?php
								if(isset($_POST['mission_save'])){
									$mission = $_POST['mission'];
									echo ''.$mission.'';
								}elseif(isset($_POST['history_save'])){
									$history = $_POST['history'];
									echo ''.$history.'';
								}elseif(isset($_POST['vision_save'])){
									$vision = $_POST['vision'];
									echo ''.$vision.'';
								}
								?>
								</div>
							</div>
						<?php }else{ } ?>
                    </div>

                    <div class="">
                      <!-- Tab panes -->
                      <div id="myTabContent" class="tab-content">
                        <div class="tab-pane active" id="about">
							<p class="lead">Page Preview</p>
								<p>
									<iframe id="frame" style = "height: 700px; width: 100%;" src="https://expediteph.com" scrolling="yes"></iframe>
								</p>
                        </div>
                        <div class="tab-pane" id="home">
							<p class="lead">Post News and Updates</p>
								<p>
									<?php
									if(isset($_POST['newsandupdates_save'])){
										date_default_timezone_set("Asia/Manila");
										$time_today = date("h:i A");
										$newsupdates = $_POST['newsupdates'];
										$date_today = date("Y-m-d");
										$postedby = $_POST['postedby'];
										mysqli_query($conn, "INSERT INTO newsandupdates (post,time,date,user_id) VALUES ('$newsupdates','$time_today','$date_today','$postedby')");
										echo '<META HTTP-EQUIV="REFRESH" CONTENT="5;URL=index.php">';
									}
									?>
									<form method = "POST">
										 <input name="newsupdates" id="inp_htmlcode1" type="hidden" />
										 <input name="postedby" value="<?php echo $ADMIN_USERID; ?>" type="hidden" required />
											<div id="div_editor1" class="richtexteditor" style="width: 100%;margin:0 auto;">
											</div>
											<script>
												var editor1 = new RichTextEditor(document.getElementById("div_editor1"));
												editor1.attachEvent("change", function () {
													document.getElementById("inp_htmlcode1").value = editor1.getHTMLCode();
												});
											</script>
											<br>
										 <button type="submit" name = "newsandupdates_save" class="btn btn-success"><i class="fa fa-save"></i> PUBLISH <b>NEWS & UPDATES</b></button>
									</form>
								</p>
                        </div>
                      </div>
                    </div>

                    <div class="clearfix"></div>

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
