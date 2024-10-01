<?php 
include '_connections/_database_connection.php';
include '_connections/_session_connection.php';
include '_partial/partial_head.php'; 
?>
<!DOCTYPE html>
<html lang="en">
	<link rel="stylesheet" href="/richtexteditor/rte_theme_default.css" />
	<script type="text/javascript" src="/richtexteditor/rte.js"></script>
	<script type="text/javascript" src='/richtexteditor/plugins/all_plugins.js'></script>
	
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
					echo '<i class="fa fa-info"></i> About';
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
                        <li><a href="#photodisplay" data-toggle="tab">Photo Display</a>
                        </li>
                        <li><a href="#history" data-toggle="tab">History</a>
                        </li>
                        <li><a href="#mission" data-toggle="tab">Mission</a>
                        </li>
                        <li><a href="#vision" data-toggle="tab">Vision</a>
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
						<?php }elseif(isset($_POST['vision_save'])){ ?>
							<div class="x_panel">
								<div class="x_title">
									<h2><i class="fa fa-pencil"></i> CHANGES VISION RESULT</h2>
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
							<p class="lead">About Page Preview</p>
								<p>
									<iframe id="frame" style = "height: 700px; width: 100%;" src="https://jms.mameceaafw.com/about.php" scrolling="yes"></iframe>
								</p>
                        </div>
                        <div class="tab-pane" id="photodisplay">
							<p class="lead">Photo Display</p>
								<p>
									<?php
									if(isset($_POST['photo_save'])){
										$file=$_FILES['photo_about']['tmp_name'];
										$photo_about= addslashes(file_get_contents($_FILES['photo_about']['tmp_name']));
										$image_name= addslashes($_FILES['photo_about']['name']);
										$image_size= getimagesize($_FILES['photo_about']['tmp_name']);

										move_uploaded_file($_FILES["photo_about"]["tmp_name"],"_photos/aboutphoto/" . $_FILES["photo_about"]["name"]);
										
										$photo_about=$_FILES["photo_about"]["name"];
										
										mysqli_query($conn, "UPDATE aboutus SET photo = '$photo_about' WHERE photo != ''");
										
										echo '<META HTTP-EQUIV="REFRESH" CONTENT="5;URL=about.php">';
									}
									?>
									<form method = "POST" enctype="multipart/form-data">
									<?php
										$photodisplay_sel=mysqli_query($conn, "SELECT * FROM aboutus WHERE photo != ''");
										$photodisplay_view=mysqli_fetch_array($photodisplay_sel);
										$photo = $photodisplay_view['photo'];
										?>
										<img class="img-fluid mb-4" style = "height: 500px; width: 500px;" src = "_photos/aboutphoto/<?php echo $photo; ?>" />
 
										<input type = "file" name = "photo_about" accept="image/png, image/gif, image/jpeg" class = "form-control" required />
											<br>
										<button type="submit" name = "photo_save" class="btn btn-success"><i class="fa fa-save"></i> EDIT <b>ABOUT PHOTO</b></button>
									</form>
								</p>
						</div>
                        <div class="tab-pane" id="history">
							<p class="lead">History</p>
								<p>
									<?php
									if(isset($_POST['history_save'])){
										$history = $_POST['history'];
										mysqli_query($conn, "UPDATE aboutus SET history = '$history'");
										echo '<META HTTP-EQUIV="REFRESH" CONTENT="5;URL=about.php">';
									}
									?>
									<form method = "POST">
									<?php
										$history_sel=mysqli_query($conn, "SELECT * FROM aboutus");
										$history_view=mysqli_fetch_array($history_sel);
										$history = $history_view['history'];
										?>
										 <input name="history" id="inp_htmlcode1" type="hidden" />
											<?php echo $history; ?>

											<div id="div_editor1" class="richtexteditor" style="width: 100%;margin:0 auto;">
											</div>

											<script>
												var editor1 = new RichTextEditor(document.getElementById("div_editor1"));
												editor1.attachEvent("change", function () {
													document.getElementById("inp_htmlcode1").value = editor1.getHTMLCode();
												});
											</script>
											<br>
										 <button type="submit" name = "history_save" class="btn btn-success"><i class="fa fa-save"></i> EDIT <b>HISTORY</b></button>
									</form>
								</p>
                        </div>
                        <div class="tab-pane" id="mission">
							<p class="lead">Mission</p>
								<p>
									<?php
									if(isset($_POST['mission_save'])){
										$mission = $_POST['mission'];
										mysqli_query($conn, "UPDATE aboutus SET mission = '$mission'");
										echo '<META HTTP-EQUIV="REFRESH" CONTENT="5;URL=about.php">';
									}
									?>
									<form method = "POST">
									<?php
									
										$mission_sel=mysqli_query($conn, "SELECT * FROM aboutus");
										$mission_view=mysqli_fetch_array($mission_sel);
										$mission = $history_view['mission'];
										?>
										 <input name="mission" id="inp_htmlcode2" type="hidden" />
											<?php echo $mission; ?>

											<div id="div_editor2" class="richtexteditor" style="width: 100%;margin:0 auto;">
											</div>
											<script>
												var editor2 = new RichTextEditor(document.getElementById("div_editor2"));
												editor2.attachEvent("change", function () {
													document.getElementById("inp_htmlcode2").value = editor2.getHTMLCode();
												});
											</script>
											<br>
										 <button type="submit" name = "mission_save" class="btn btn-success"><i class="fa fa-save"></i> EDIT <b>MISSION</b></button>
									</form>
								</p>
						</div>
                        <div class="tab-pane" id="vision">
							<p class="lead">Vision</p>
								<p>
									<?php
									if(isset($_POST['vision_save'])){
										$vision = $_POST['vision'];
										mysqli_query($conn, "UPDATE aboutus SET vision = '$vision'");
										echo '<META HTTP-EQUIV="REFRESH" CONTENT="5;URL=about.php">';
									}
									?>
									<form method = "POST">
									<?php
									
										$vision_sel=mysqli_query($conn, "SELECT * FROM aboutus");
										$vision_view=mysqli_fetch_array($vision_sel);
										$vision = $vision_view['vision'];
										?>
										 <input name="vision" id="inp_htmlcode3" type="hidden" />
											<?php echo $vision; ?>

											<div id="div_editor3" class="richtexteditor" style="width: 100%;margin:0 auto;">
											</div>
											<script>
												var editor3 = new RichTextEditor(document.getElementById("div_editor3"));
												editor3.attachEvent("change", function () {
													document.getElementById("inp_htmlcode3").value = editor3.getHTMLCode();
												});
											</script>
											<br>
										 <button type="submit" name = "vision_save" class="btn btn-success"><i class="fa fa-save"></i> EDIT <b>VISION</b></button>
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
