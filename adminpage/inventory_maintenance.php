<!DOCTYPE html>
<html lang="en">
<?php 
include '_connections/_database_connection.php';
include '_connections/_session_connection.php';
include '_partial/partial_head.php'; 
?>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <!-- menu profile quick info -->
<?php include '_partial/partial_logo_user.php'; ?>
            <!-- /menu profile quick info -->
            <br />

            <!-- sidebar menu -->
<?php include '_sidebars/_sidebar_global.php'; ?>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <!-- /menu footer buttons -->
          </div>
        </div>
        <!-- top navigation -->
<?php include '_partial/partial_navbar.php'; ?>
        <!-- /top navigation -->

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
					if(isset($_POST['save_new_product'])){
						echo '<img src="images/loading.gif"><meta http-equiv="refresh" content="3; url=locate_item.php">';
					}else{
						echo 'Inventory';
					}
					?></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
				  <?php
					if(isset($_POST['save_new_product'])){
						$product_name = $_POST['product_name'];
						$product_code = $_POST['product_code'];
						$added_by = $_POST['added_by'];
						$date_added = $_POST['date_added'];
						echo '<div class="alert alert-info"><span><i class = "fa fa-info-circle"></i>  Product / Item <b>'.$product_name.'</b> with Product Code <b>'.$product_code.'</b> has been successfully added to our system.</span></div>';
						$new_room = mysql_query("INSERT into inventory_product (product_name, product_code, product_date_added, product_added_by) values ('$product_name','$product_code','$added_by','$date_added')");
					echo '<i class="fa fa-desktop"></i> Projectors';
					}else{
						echo '<img src="images/loading.gif">';
					}
					?>
                  <div class="x_content">
				<div class="col-md-6 col-sm-12 col-xs-12">
					<br />
					<div class="form-group">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<button type="button" class="btn btn-success btn-md btn-block" data-toggle="modal" data-target=".bs-example-modal-add_new_product"><i class="fa fa-plus"></i> Add New Product</button>
						</div>
					</div>
                    <br />
                    <br />
					<div class="form-group">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<button type="button" class="btn btn-primary btn-md btn-block" data-toggle="modal" data-target=".bs-example-modal-add_new_product"><i class="fa fa-plus"></i> Add New Main Category</button>
                        </div>
					</div>
				</div>
								
							<div class="col-md-12 col-sm-12 col-xs-12">
								<button type="button" class="col-md-5 col-sm-12 btn btn-primary btn-md" data-toggle="modal" data-target=".bs-example-modal-add_new_product"><i class="fa fa-plus"></i> Add New Sub Category 1</button>
								<button type="button" class="col-md-5 col-sm-12 btn btn-primary btn-md" data-toggle="modal" data-target=".bs-example-modal-add_new_product"><i class="fa fa-plus"></i> Add New Sub Category 2</button>
								<button type="button" class="col-md-6 col-sm-12 btn btn-primary btn-md" data-toggle="modal" data-target=".bs-example-modal-add_new_product"><i class="fa fa-plus"></i> Add New Sub Category 3</button>
								<button type="button" class="col-md-6 col-sm-12 btn btn-primary btn-md" data-toggle="modal" data-target=".bs-example-modal-add_new_product"><i class="fa fa-plus"></i> Add New Sub Category 4</button>
								<button type="button" class="col-md-6 col-sm-12 btn btn-primary btn-md" data-toggle="modal" data-target=".bs-example-modal-add_new_product"><i class="fa fa-plus"></i> Add New Sub Category 5</button>
								<button type="button" class="col-md-6 col-sm-12 btn btn-primary btn-md" data-toggle="modal" data-target=".bs-example-modal-add_new_product"><i class="fa fa-plus"></i> Add New Sub Category 6</button>
							</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
		
		<!-- ADD NEW PRODUCT -->
		<div class="modal fade bs-example-modal-add_new_product" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-md">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
						<h4 class="modal-title" id="myModalLabel2">Add New Product</h4>
					</div>
					<div class="modal-body">
						  <form method = "POST" class="form-horizontal form-label-left">
							<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
							  <label for = "product_name">Product Name</label>
							  <input name = "product_name" type="text" class="form-control" placeholder="Product Name">
							</div>
							<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
							  <label for = "product_code">Product Code</label>
							  <input name = "product_code" type="text" class="form-control" placeholder="Product Code">
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							  <label for = "added_by">Added By</label>
							  <input name = "added_by" readonly type="text" class="form-control" value = "<?php echo $ADMIN_FIRSTNAME; echo ' '; echo $ADMIN_LASTNAME;?>">
							</div>
							<?php date_default_timezone_set('Etc/GMT+8'); $date_today = date("d-m-Y");?>
							<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
								<label for = "date_added">Date:</label>
								<input name = "date_added" type="text" class="form-control" id="user_admin_account_created_by" value = "<?php echo $date_today; ?>" readonly>
							</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
						<button name = "save_new_product" type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Save New Product</button>
					</div>
						  </form>
				</div>
			</div>
		</div>
		<!-- /ADD NEW PRODUCT -->

        <!-- footer content -->
<?php include '_partial/partial_footer.php'; ?>
        <!-- /footer content -->
      </div>
    </div>
<?php include '_partial/partial_footscripts.php'; ?>
  </body>
</html>
