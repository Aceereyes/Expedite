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
					if(isset($_POST['contactinfo_save'])){
						echo '<img src="_photos/loading.gif"><meta http-equiv="refresh" content="3; url=contactinfo.php"> Contact Information';
						
					}else{
					echo '<i class="fa fa-info"></i> Contact Information';
					}
					?>
					</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
	<?php
	if(isset($_POST['contactinfo_save'])){
		$email = $_POST['email'];
		$contactno = $_POST['contactno'];
		$address = $_POST['address'];
		$googlemap_link = $_POST['googlemap_link'];
		$contactinfo = $_POST['contactinfo'];
		
		$businesstime = $_POST['businesstime'];
		
		$facebook = $_POST['facebook'];
		$twitter = $_POST['twitter'];
		$viber = $_POST['viber'];
		$google = $_POST['google'];
		
		mysqli_query($conn, "UPDATE contactinformation SET businesstime = '$businesstime',facebook = '$facebook',twitter = '$twitter',viber = '$viber',google = '$google',
		contactinfo = '$contactinfo', contactno = '$contactno', email = '$email', address = '$address', googlemap_link = '$googlemap_link' WHERE id = '1'");
	}
	?>
	<form method = "POST">
	<?php
		$contactinformation = mysqli_query($conn, "SELECT * FROM contactinformation WHERE id = '1'");
		$contactinformation_view = mysqli_fetch_array($contactinformation);
		$contactinfo = $contactinformation_view['contactinfo'];
		$contactno = $contactinformation_view['contactno'];
		$email = $contactinformation_view['email'];
		$address = $contactinformation_view['address'];
		$googlemap_link = $contactinformation_view['googlemap_link'];
		
		$businesstime = $contactinformation_view['businesstime'];
		
		$facebook = $contactinformation_view['facebook'];
		$twitter = $contactinformation_view['twitter'];
		$viber = $contactinformation_view['viber'];
		$google = $contactinformation_view['google'];
		?>
			<h2>CONTACT INFORMATION</h2>
			<label for="email">Email:</label>
			<input type = "text" id="email" name = "email" class="form-control" value = "<?php echo ''.$email.''; ?>"/>
			<label for="contactno">Contact No:</label>
			<input type = "number" id="contactno" name = "contactno" class="form-control" value = "<?php echo ''.$contactno.''; ?>"/>
			<label for="address">Address:</label>
			<textarea id="address" name = "address" class="form-control"><?php echo ''.$address.''; ?></textarea>
			<label for="googlemap_link">Google Map Link:</label>
			<textarea id="googlemap_link" name = "googlemap_link" class="form-control"><?php echo ''.$googlemap_link.''; ?></textarea>
			<label for="contactinfo">Contact Information:</label>
			<textarea id="contactinfo" name = "contactinfo" class="form-control" ><?php echo ''.$contactinfo.''; ?></textarea>
			<h2>Operating Schedule</h2>
			<label for="businesstime">Schedule:</label>
			
		 <input name="businesstime" id="inp_htmlcode" type="hidden" />
			<?php echo ''.$businesstime.''; ?>

			<div id="div_editor1" class="richtexteditor" style="width: 100%;margin:0 auto;">
			</div>

			<script>
				var editor1 = new RichTextEditor(document.getElementById("div_editor1"));
				editor1.attachEvent("change", function () {
					document.getElementById("inp_htmlcode").value = editor1.getHTMLCode();
				});
			</script>
			<h2>SOCIAL MEDIA</h2>
			<label for="facebook">Facebook:</label>
			<input type = "text" id="facebook" name = "facebook" class="form-control" value = "<?php echo ''.$facebook.''; ?>"/>
			<label for="twitter">Twitter:</label>
			<input type = "text" id="twitter" name = "twitter" class="form-control" value = "<?php echo ''.$twitter.''; ?>"/>
			<label for="viber">Viber:</label>
			<input type = "text" id="viber" name = "viber" class="form-control" value = "<?php echo ''.$viber.''; ?>"/>
			<label for="google">Google:</label>
			<input type = "text" id="google" name = "google" class="form-control" value = "<?php echo ''.$google.''; ?>"/>
			<br>
         <button type="submit" name = "contactinfo_save" class="btn btn-success"><i class="fa fa-save"></i> EDIT <b>CONTACT INFORMATIONS</b></button>
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
