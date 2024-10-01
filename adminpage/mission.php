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
    <style>
    .text-center{
        text-align:center;
    }
    </style>
	
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
					if(isset($_POST['mission_save'])){
						echo '<img src="_photos/loading.gif"><meta http-equiv="refresh" content="5; url=mission.php"> Mission';
						
					}else{
					echo '<i class="fa fa-desktop"></i> Mission';
					}
					?>
					</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
	<?php
	if(isset($_POST['mission_save'])){
		$mission = $_POST['mission'];
		mysqli_query($conn, "UPDATE aboutus SET mission = '$mission' WHERE mission != ''");
		echo ''.$mission.'';
	}
	?>
	<form method = "POST">
	<?php
	
		$mission_sel = mysqli_query($conn, "SELECT * FROM aboutus WHERE mission != ''");
		$mission_view = mysqli_fetch_array($mission_sel);
		$mission = $mission_view['mission'];
		?>
		 <input name="mission" id="inp_htmlcode" type="hidden" />
			<?php echo $mission; ?>

			<div id="div_editor1" class="richtexteditor" style="width: 100%;margin:0 auto;">
			</div>

			<script>
				var editor1 = new RichTextEditor(document.getElementById("div_editor1"));
				editor1.attachEvent("change", function () {
					document.getElementById("inp_htmlcode").value = editor1.getHTMLCode();
				});
			</script>
			<br>
         <button type="submit" name = "mission_save" class="btn btn-success"><i class="fa fa-save"></i> EDIT <b>MISSION</b></button>
	</form>

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
