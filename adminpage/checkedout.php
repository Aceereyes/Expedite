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
                    <h2><i class="fa fa-users"></i> Products</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><button type="button" class = "btn btn-success" data-toggle="modal" data-target=".bs-example-modal-lg-add_product"><i class="fa fa-plus"></i> Add Product</button>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
				  <?php
					if(isset($_POST['add_new_product'])){
						$productname = $_POST['productname'];
						$quantity = $_POST['quantity'];
						$price = $_POST['price'];
						$productdescription = $_POST['productdescription'];
						
						$file=$_FILES['productphoto']['tmp_name'];
						$productphoto= addslashes(file_get_contents($_FILES['productphoto']['tmp_name']));
						$image_name= addslashes($_FILES['productphoto']['name']);
						$image_size= getimagesize($_FILES['productphoto']['tmp_name']);

						mkdir('_photos/products/'.$productname.'');
						
						move_uploaded_file($_FILES["productphoto"]["tmp_name"],"_photos/products/".$productname."/" . $_FILES["productphoto"]["name"]);
						
						$productphoto=$_FILES["productphoto"]["name"];

						mysqli_query($conn, "INSERT into inventory (product_name,quantity,price,photo,description)VALUES('$productname','$quantity','$price','$productphoto','$productdescription')");
							echo '
							<div class="alert alert-success alert-dismissible fade in" role="alert">
								<i class = "fa fa-check-circle"></i> <b>NEW PRODUCT!</b>
								</br>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
								New product <b>'.$productname.'</b> has been successfully added.
								</br>
							</div>';
						echo '<META HTTP-EQUIV="REFRESH" CONTENT="3;URL=inventory.php">';
					}
					
					if(isset($_POST['delete_product'])){
						date_default_timezone_set("Asia/Manila");
						ini_set('max_execution_time', '900');
						$delete_product_id = $_POST['delete_product_id'];
						$user_id = $_POST['user_id'];
						$user_password = $_POST['user_password'];
						$user_passwordenc = password_hash($user_password, PASSWORD_BCRYPT);
						$select_user = mysqli_query($conn, "SELECT * FROM user_admins WHERE user_id = '$user_id'");
						$select_user_view = mysqli_fetch_array($select_user);
						$user_passwordenc = $select_user_view['user_passwordenc'];
							if(password_verify($user_password, $user_passwordenc)) {
								$select_user = mysqli_query($conn, "SELECT * FROM inventory WHERE id = '$delete_product_id'");
								$select_user_view = mysqli_fetch_array($select_user);
								
								$product_name = $select_user_view['product_name'];
								$quantity = $select_user_view['quantity'];
								$price = $select_user_view['price'];
								$description = $select_user_view['description'];
								$photo = $select_user_view['photo'];
										
								unlink("_photos/products/$product_name/$photo");
									
								rmdir("_photos/products/$product_name/");
								
								mysqli_query($conn, "DELETE FROM inventory WHERE id = '$delete_product_id'");
								
								
								/*date_default_timezone_set("Asia/Manila");
								$time_today = date("H:i:s");
								$date_today = date("Y-m-d");
								$activity = 'Deleting department <b>'.$user_firstname.' '.$user_lastname.'</b>, using <b>'.$ADMIN_FIRSTNAME.' '.$ADMIN_LASTNAME.'</b> account.';
								$module = 'Delete account.';
								$link = 'user_accounts.php';
								$result = 'Account of <b>'.$user_firstname.' '.$user_lastname.'</b> is successfully deleted.';
								$insert_activity = mysqli_query($conn, "INSERT INTO activity_logs 
								(time,date,activity,module,link,result,user_id) VALUES 
								('$time_today','$date_today','$activity','$module','$link','$result','$ADMIN_USERID')");*/
								echo '<META HTTP-EQUIV="REFRESH" CONTENT="3;URL=inventory.php">';
								echo '
								<div class="alert alert-success alert-dismissible fade in" role="alert">
									<i class = "fa fa-info-circle"></i> DELETING ACCOUNT!
									<br/>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
									The product <b>'.$product_name.'</b> was succesfully deleted.
								</div>';
							}else{
													
								/*date_default_timezone_set("Asia/Manila");
								$time_today = date("H:i:s");
								$date_today = date("Y-m-d");
								$activity = 'Deleting department <b>'.$user_firstname.' '.$user_lastname.'</b>, using <b>'.$ADMIN_FIRSTNAME.' '.$ADMIN_LASTNAME.'</b> account.';
								$module = 'Delete account.';
								$link = 'user_accounts.php';
								$result = 'Account of <b>'.$user_firstname.' '.$user_lastname.'</b> is unsuccessfully deleted.';
								$insert_activity = mysqli_query($conn, "INSERT INTO activity_logs 
								(time,date,activity,module,link,result,user_id) VALUES 
								('$time_today','$date_today','$activity','$module','$link','$result','$ADMIN_USERID')");*/
								echo '<META HTTP-EQUIV="REFRESH" CONTENT="1;URL=inventory.php">';
								echo '
								<div class="alert alert-danger alert-dismissible fade in" role="alert">
									<i class = "fa fa-warning"></i> DELETING ACCOUNT!
									<br/>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
									Invelid password.
								</div>';
							}
						}
					echo '
						<table id="datatable" class="table-hover table table-striped table-bordered">
							<thead>
								<tr>
									<th>Customer</th>
									<th>Product</th>
									<th>Quantity</th>
									<th>Price</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							';
					$message=mysqli_query($conn, "SELECT * FROM cart");
					while($row=mysqli_fetch_array($message))
					{
					$uid = $row['user_id'];
					$userinfo = mysqli_query($conn, "SELECT * FROM user_admins WHERE user_id = $uid");
					$userinfo_view = mysqli_fetch_array($userinfo);
					$firstname = $userinfo_view['user_firstname'];
					$lastname = $userinfo_view['user_lastname'];
					echo '	
								<tr class="record">
									<td>'.$firstname.' '.$lastname.'</td>
									<td>'.$row['product_name'].'</td>
									<td>'.$row['quantity'].'</td>
									<td>'.$row['price'].'</td>
									<td>
										<a data-toggle="modal" data-target=".bs-example-modal-view_user_'.$row['id'].'" class = "btn btn-xs btn-info"><i class="fa fa-eye"></i> VIEW</a>
										<a data-toggle="modal" data-target=".bs-example-modal-delete_user'.$row['id'].'" class = "btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> DELETE</a>
									</td>
								</tr>
							';
							
	echo '
				<div class="modal fade bs-example-modal-delete_user'.$row['id'].'" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-user"></i> DELETE PRODUCT</h4>
                        </div>
								<div class="modal-body" style = "margin-top:-15px;">
								
									<div class=" form-group has-feedback">';
								echo '
									</div>
									<div class=" form-group has-feedback">
										<label>Are you sure you want to delete this product ('.$row['product_name'].')?</label>
									</div>
							<form method = "POST" class="form-horizontal form-label-left input_mask" autocomplete = "OFF" enctype="multipart/form-data">
									<div class=" form-group has-feedback">
										<input value = "'.$row['id'].'" type="hidden" name = "delete_product_id">
										<input value = "'.$ADMIN_USERID.'" type="hidden" name = "user_id">
									</div>
									<div class=" form-group has-feedback">
										<label for = "user_password">PASSWORD:</label>
										<input value = "" onkeypress="return /[0-9a-zA-Z !@#$%^&*()_ - + = ]/i.test(event.key)" required type="password" class="form-control" name = "user_password" id="user_password">
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
									<button class="btn btn-danger" type="reset"><i class="fa fa-refresh"></i> Reset</button>
									<button name = "delete_product" class="btn btn-success" type="submit"><i class="fa fa-save"></i> Save</button>
								</div>
							</form>
                      </div>
                    </div>
				</div>';
				
					$contactinformation = mysqli_query($conn, "SELECT * FROM contactinformation WHERE id = '1'");
					$contactinformation_view = mysqli_fetch_array($contactinformation);
						echo '
									<div class="modal fade bs-example-modal-view_user_'.$row['id'].'" tabindex="-1" role="dialog" aria-hidden="true">
										<div class="modal-dialog modal-sm">
										  <div class="modal-content">

											<div class="modal-header">
											  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
											  </button>
											  <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-user"></i> View <b>'.$row['product_name'].'</b>\'s Information</h4>
											</div>
											<div class="modal-body">
												  <label>Product Photo:</label>
												  <br>
												  <span class="image" ><img style = "width: 267px; height: 250px;" src="_photos/products/'.$row['product_name'].'/'.$row['photo'].'" alt="Profile Image" /></span>
												  <br>
												  <br>
												  <label>Product Name:</label>
												  <br>
												  '.$row['product_name'].'
												  <br>
												  <br>
												  <label>Product Description:</label>
												  <br>
												  '.$row['description'].'
												  <br>
												  <br>
												  <label>Quantity:</label>
												  <br>
												  '.$row['quantity'].'
												  <br>
												  <br>
												  <label>Price:</label>
												  <br>
												  '.$row['price'].'
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
				  
					<div class="modal fade bs-example-modal-lg-add_product" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog modal-sm">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
									<h4 class="modal-title" id="myModalLabel2"><i class="fa fa-envelope"></i> Add Product</h4>
								</div>
								<form method = "POST" enctype="multipart/form-data">
									<div class="modal-body">
										<label>Product Name:</label>
										<input type = "text" placeholder = "Product Name" name = "productname" class = "form-control"/>
										<br>
										<label>Quantity:</label>
										<input type = "number" placeholder = "Quantity" name = "quantity" class = "form-control"/>
										<br>
										<label>Price:</label>
										<input type = "number" placeholder = "Price" name = "price" class = "form-control"/>
										<br>
										<label>Product Description:</label>
										<textarea type = "text" placeholder = "Product Description" name = "productdescription" class = "form-control"></textarea>
										<br>
										<label>Photo:</label>
										<input type = "file" name = "productphoto" accept="image/png, image/gif, image/jpeg" class = "form-control" required />
										<br>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
											<button type="submit" name = "add_new_product" class="btn btn-primary"><i class="fa fa-send"></i> Send</button>
										</div>
									</form>
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
