<!DOCTYPE html>
<html lang="en">
<?php 
include '_connections/_database_connection.php';
include '_connections/_session_connection.php';
include '_partial/partial_head.php'; 
?>
<script src="http://code.jquery.com/jquery.js"></script>
<script src="src/skdslider.min.js"></script>
<link href="src/skdslider.css" rel="stylesheet">
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('#demo1').skdslider({
          slideSelector: '.slide',
          delay:5000,
          animationSpeed:1000,
          showNextPrev:true,
          showPlayButton:false,
          autoSlide:true,
          animationType:'sliding'
        });
    });
</script>
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
						<h2><i class="fa fa-envelope"></i> <b><?php echo $ADMIN_PRIVILEDGE; ?></b> Mailing Signature</h2>
						
                    <ul class="nav navbar-right panel_toolbox">
                      <li><button type="button" class = "btn btn-sm btn-success" data-toggle="modal" data-target=".bs-example-modal-lg-signature"><i class="fa fa-pencil"></i> Modify Signature <b><?php echo $ADMIN_PRIVILEDGE; ?></b></button>
                      </li>
					</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<div class="row tile_count">
						<?php if(isset($_POST['add_new_signature'])){
							$header = $_POST['header'];
							$descr = $_POST['descr'];
							mysql_query("INSERT INTO auto_mailing (header, message) VALUES ('$header','$descr')");
						}
							?>
						
							
						</div>
					</div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

                  <div class="modal fade bs-example-modal-lg-signature" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-pencil"></i> Modify Email Signature</h4>
                        </div>
					<form method = "POST" id="demo-form" data-parsley-validate>
                        <div class="modal-body">
							  <label for="header">Header (message):</label>
							  <input type="text" id="header" class="form-control" name="header" required />

							  <label for="message">Body (message):</label>

							  <textarea name="descr" id="descr" class="form-control" required ></textarea>
						</div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
						  <button  type="submit" name = "add_new_signature" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                        </div>
					</form>
                      </div>
                    </div>
                  </div>
        <!-- footer content -->
<?php include '_partial/partial_footer.php'; ?>
        <!-- /footer content -->
      </div>
    </div>
<?php //include '_partial/partial_footscripts.php'; ?>

    <!-- jQuery -->
    <script src="_vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="_vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="_vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="_vendors/nprogress/nprogress.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="_vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="_vendors/iCheck/icheck.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="_vendors/moment/min/moment.min.js"></script>
    <script src="vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="_vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="_vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="_vendors/google-code-prettify/src/prettify.js"></script>
    <!-- jQuery Tags Input -->
    <script src="_vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
    <!-- Switchery -->
    <script src="_vendors/switchery/dist/switchery.min.js"></script>
    <!-- Select2 -->
    <script src="_vendors/select2/dist/js/select2.full.min.js"></script>
    <!-- Parsley -->
    <script src="_vendors/parsleyjs/dist/parsley.min.js"></script>
    <!-- Autosize -->
    <script src="_vendors/autosize/dist/autosize.min.js"></script>
    <!-- jQuery autocomplete -->
    <script src="_vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
    <!-- starrr -->
    <script src="_vendors/starrr/dist/starrr.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="_build/js/custom.min.js"></script>
  </body>
</html>
