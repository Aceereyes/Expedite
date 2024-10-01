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
					if(isset($_POST['vision_save'])){
						echo '<img src="_photos/loading.gif"><meta http-equiv="refresh" content="5; url=history.php"> History';
						
					}else{
					echo '<i class="fa fa-desktop"></i> History';
					}
					?>
					</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
	<?php
	if(isset($_POST['history_save'])){
		$history = $_POST['history'];
		mysqli_query($conn, "UPDATE aboutus SET history = '$history' WHERE history != ''");
		echo ''.$history.'';
	}
	?>
	<form method = "POST">
	<?php
	
		$history_sel = mysqli_query($conn, "SELECT * FROM aboutus WHERE history != ''");
		$history_view = mysqli_fetch_array($history_sel);
		$history = $history_view['history'];
		?>
		 <input name="history" id="inp_htmlcode" type="hidden" />
			<?php echo $history; ?>

			<div id="div_editor1" class="richtexteditor" style="width: 100%;margin:0 auto;">
			</div>

			<script>
				var editor1 = new RichTextEditor(document.getElementById("div_editor1"));
				editor1.attachEvent("change", function () {
					document.getElementById("inp_htmlcode").value = editor1.getHTMLCode();
				});
			</script>
			<br>
         <button type="submit" name = "history_save" class="btn btn-success"><i class="fa fa-save"></i> EDIT <b>HISTORY</b></button>
	</form>

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
<?php include '_partial/partial_footscripts.php'; ?>
  </body>
</html>
