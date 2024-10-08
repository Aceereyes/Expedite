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
							<!--<a target = "_blank" href = "_pdf/index.php" class="btn btn-success"><i class="fa fa-print"></i> PDF PRINT</a>-->
									<?php
										if(isset($_POST['find_date'])){
											$payment_status = $_POST['payment_status'];
											$date_1 = $_POST['date_1'];
											$date_2 = $_POST['date_2'];
										echo '
										<form method = "POST" action = "_pdf/index.php">
												<input type = "hidden" name = "payment_status" value = "'.$payment_status.'"/>
												<input type = "hidden" name = "date_pdf_1" value = "'.$date_1.'"/>
												<input type = "hidden" name = "date_pdf_2" value = "'.$date_2.'"/>
												<button type="submit" name = "print_pdf" class="btn btn-success btn-sm"><i class="fa fa-print"></i> PRINT PDF</button>
										</form>';
										}
									?>
						</ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
<form method = "POST">
<?php
if(isset($_POST['find_date'])){
	$date_1 = $_POST['date_1'];
	$date_2 = $_POST['date_2']; ?>
	
	<div class=" form-group has-feedback col-md-2 col-sm-2 col-xs-2">
		<label for="color">STATUS:</label>
		<select name = "payment_status" class="form-control" >
			<option>PAID</option>
			<option>PENDING</option>
			<option>DECLINED</option>
		</select>
	</div>
	<div class=" form-group has-feedback col-md-2 col-sm-2 col-xs-2">
		<label for="color">FROM DATE:</label>
		<input type = "date" name = "date_1" class = "form-control" required />
	</div>
	<div class=" form-group has-feedback col-md-2 col-sm-2 col-xs-2">
		<label for="color">TO DATE:</label>
		<input type = "date" name = "date_2" class="form-control" required />
	</div>
<?php }else{ ?>
	<div class=" form-group has-feedback col-md-2 col-sm-2 col-xs-2">
		<label for="color">STATUS:</label>
		<select name = "payment_status" class="form-control" >
			<option>PAID</option>
			<option>PENDING</option>
			<option>DECLINED</option>
		</select>
	</div>
	<div class=" form-group has-feedback col-md-2 col-sm-2 col-xs-2">
		<label for="color">FROM DATE:</label>
		<input type = "date" name = "date_1" class = "form-control"/>
	</div>
	<div class=" form-group has-feedback col-md-2 col-sm-2 col-xs-2">
		<label for="color">TO DATE:</label>
		<input type = "date" name = "date_2" class="form-control"/>
	</div>
<?php } ?>
	<div class="col-md-12 col-sm-12 col-xs-12">
	</div>
	<div class="col-md-3 col-sm-3 col-xs-3">
		<button type="submit" name = "find_date" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> FILTER</button>
	</div>
</form>
				  <?php
if(isset($_POST['find_date'])){
	$date_1 = $_POST['date_1'];
	$date_2 = $_POST['date_2'];
	$converted_date_1 = date('F d, Y', strtotime(''.$date_1.''));
	$converted_date_2 = date('F d, Y', strtotime(''.$date_2.''));
$total_sales = mysqli_query($conn, "SELECT SUM(price) AS total_price FROM cart WHERE status = 'CHECK OUT' && payment_status = '$payment_status' && date BETWEEN '$converted_date_1' AND '$converted_date_2'"); 
}else{
$total_sales = mysqli_query($conn, "SELECT SUM(price) AS total_price FROM cart"); 
}
$total_sales_show = mysqli_fetch_assoc($total_sales); 
$total_price = $total_sales_show['total_price'];
echo '<label>TOTAL SALES:</label>';
echo ' ';
echo '₱';
echo number_format(($total_price / 1), 2, '.', ',');
echo '<br/>';
					if(isset($_POST['add_new_product'])){
						$productname = $_POST['productname'];
						$productcode = $_POST['productcode'];
						$product_brand = $_POST['product_brand'];
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

						mysqli_query($conn, "INSERT into inventory (product_name,product_code,product_brand,quantity,price,photo,description)VALUES('$productname','$productcode','$product_brand','$quantity','$price','$productphoto','$productdescription')");
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
						
					if(isset($_POST['update_status_payment'])){
						$payment_status = $_POST['payment_status'];
						$remarks = $_POST['remarks'];
						$cart_id = $_POST['cart_id'];
						
						$select_photo=mysqli_query($conn, "SELECT * FROM cart WHERE id = '$cart_id'");
						$select_photo_show=mysqli_fetch_array($select_photo);
						$product_id = ''.$select_photo_show['product_id'].'';
						$id = ''.$select_photo_show['id'].'';
						$product_name = ''.$select_photo_show['product_name'].'';
						$product_code = ''.$select_photo_show['product_code'].'';
						$product_brand = ''.$select_photo_show['product_brand'].'';
						$quantity = ''.$select_photo_show['quantity'].'';
						$price = ''.$select_photo_show['price'].'';
						$photo = ''.$select_photo_show['photo'].'';
						$description = ''.$select_photo_show['description'].'';
						
							/*date_default_timezone_set("Asia/Manila");
							$time_today = date("H:i:s");
							$date_today = date("Y-m-d");
							$activity = 'Modified information of product <b>'.$product_name.'</b> <a target = "_blank" href = "user.php?cieti_user_id='.$product_id.'">(<i>click here to view this user</i>)</a>.';
							$module = 'Modify product information.';
							$link = 'inventory.php';
							$result = 'Product information has been succesfully updated.';
							$insert_activity = mysqli_query($conn, "INSERT INTO activity_logs 
							(time,date,activity,module,link,result,user_id) VALUES 
							('$time_today','$date_today','$activity','$module','$link','$result','$ADMIN_USERID')");*/
						if($payment_status == 'DECLINED'){
							mysqli_query($conn, "INSERT into inventory 
							(product_name,product_code,product_brand,quantity,price,photo,description)
							VALUES
							('$product_name','$product_code','$product_brand','$quantity','$price','$photo','$description')");
							mysqli_query($conn, "UPDATE cart SET remarks = '$remarks',
							payment_status = '$payment_status' WHERE id = $cart_id");
							echo '
							<div class="alert alert-success alert-dismissible fade in" role="alert">
								<i class = "fa fa-info-circle"></i>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
								<b>'.$product_name.'</b> Information was successfully updated in our database.
							</div>';
							echo '<META HTTP-EQUIV="REFRESH" CONTENT="2;URL=checkout.php">';
						}else{
							mysqli_query($conn, "UPDATE cart SET remarks = '$remarks',
							payment_status = '$payment_status' WHERE id = $cart_id");
							echo '
							<div class="alert alert-success alert-dismissible fade in" role="alert">
								<i class = "fa fa-info-circle"></i>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
								<b>'.$product_name.'</b> Information was successfully updated in our database.
							</div>';
							echo '<META HTTP-EQUIV="REFRESH" CONTENT="2;URL=checkout.php">';
						}
					}
					echo '
						<table id="datatable" class="table-hover table table-striped table-bordered">
							<thead>
								<tr>
									<th>Customer</th>
									<th>Product</th>
									<th>Brand</th>
									<th>Quantity</th>
									<th>Price</th>
									<th>Status</th>
									<th>Date & Time</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							';
							
					if(isset($_POST['find_date'])){
						$payment_status = $_POST['payment_status'];
						$date_1 = $_POST['date_1'];
						$date_2 = $_POST['date_2'];
						$converted_date_1 = date('F d, Y', strtotime(''.$date_1.''));
						$converted_date_2 = date('F d, Y', strtotime(''.$date_2.''));
						$message=mysqli_query($conn, "SELECT * FROM cart WHERE status = 'CHECK OUT' && payment_status = '$payment_status' && date BETWEEN '$converted_date_1' AND '$converted_date_2'");
					}else{
						$message=mysqli_query($conn, "SELECT * FROM cart");
					}
					while($row=mysqli_fetch_array($message))
					{
							$user_id = $row['user_id'];
							$receipt = $row['payment_receipt'];
							$declined = $row['payment_status'];
							$time_now = date('H:i A', strtotime(''.$row['time'].''));
							
						$select_user=mysqli_query($conn, "SELECT * FROM user_admins WHERE user_id = '$user_id'");
						$select_user_show=mysqli_fetch_array($select_user);
						$user_firstname = ''.$select_user_show['user_firstname'].'';
						$user_lastname = ''.$select_user_show['user_lastname'].'';
					echo '	
								<tr class="record">
									<td>'.$user_firstname.' '.$user_lastname.'</td>
									<td>'.$row['product_name'].'</td>
									<td>'.$row['product_brand'].'</td>
									<td>'.$row['quantity'].'</td>
									<td>₱';
									echo number_format(($row['price'] / 1), 2, '.', ',');
					echo '			</td>
									<td>';
									if($row['payment_status'] ==''){
										echo 'CART';
									}else{
										echo $row['payment_status'];
									}
					echo '			</td>
									<td>'.$row['date'].'-'.$time_now.'</td>
									<td>';
								if($declined == 'DECLINED'){
									echo 'REQUEST HAS BEEN DECLINED';
								}elseif($declined == 'PAID'){
									echo '<a data-toggle="modal" data-target=".bs-example-modal-view_product_receipt_'.$row['id'].'" class = "btn btn-xs btn-info"><i class="fa fa-eye"></i> PAYMENT RECEIPT</a>
										<a data-toggle="modal" data-target=".bs-example-modal-view_product_'.$row['id'].'" class = "btn btn-xs btn-info"><i class="fa fa-eye"></i> VIEW</a>';
								}else{
									if($receipt != ''){
									echo '
										<a data-toggle="modal" data-target=".bs-example-modal-view_product_receipt_'.$row['id'].'" class = "btn btn-xs btn-info"><i class="fa fa-eye"></i> PAYMENT RECEIPT</a>';
									}
									echo '
										<a data-toggle="modal" data-target=".bs-example-modal-view_product_'.$row['id'].'" class = "btn btn-xs btn-info"><i class="fa fa-eye"></i> VIEW</a>
										<a data-toggle="modal" data-target=".bs-example-modal-update_status_'.$row['id'].'" class = "btn btn-xs btn-warning"><i class="fa fa-pencil"></i> UPDATE PAYMENT STATUS</a>';
								}									
								echo '
									</td>
								</tr>
							';
						echo '
									<div class="modal fade bs-example-modal-view_product_receipt_'.$row['id'].'" tabindex="-1" role="dialog" aria-hidden="true">
										<div class="modal-dialog modal-sm">
										  <div class="modal-content">

											<div class="modal-header">
											  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
											  </button>
											  <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-user"></i> View <b>'.$row['product_name'].'</b>\'s Receipt</h4>
											</div>
											<div class="modal-body">
												  <label>Product Receipt:</label>
												  <br>
												  ';
												  if($receipt == ''){
												 echo 'NO RECEIPT';
												  }else{
												 echo '
												  <span class="image" ><img style = "width: 267px; height: 250px;" src="_photos/receipts/'.$row['product_id'].''.$row['user_id'].'/'.$row['payment_receipt'].'" alt="Profile Image" /></span>
												  ';}
												  echo '<br>
												  <br>
											</div>
											<div class="modal-footer">
											  <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
											</div>
										  </div>
										</div>
									  </div>
									  ';
							echo '
				<div class="modal fade bs-example-modal-update_status_'.$row['id'].'" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-info-circle"></i> MODIFY <b>'.$row['product_name'].'</b>\'s INFORMATION</h4>
                        </div>
							<form id="demo-form" method = "POST" enctype="multipart/form-data" data-parsley-validate>
								<div class="modal-body">
									<input type="hidden" class="form-control" name="cart_id" value = "'.$row['id'].'" />
									<div class=" form-group has-feedback">
										<label for = "product_name">STATUS:</label>
										<select name = "payment_status" class="form-control" >
											<option>PAID</option>
											<option>DECLINED</option>
										</select>
									</div>
									<div class=" form-group has-feedback">
										<label for = "product_name">REMARKS:</label>
										<textarea type="text" class="form-control" name="remarks"></textarea>
									</div>
								</div> 
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
									<button  type="submit" name = "update_status_payment" class="btn btn-success" download><i class="fa fa-pencil"></i> Update</button>
								</div>
							</form>
                      </div>
                    </div>
                </div>';
	echo '
				<div class="modal fade bs-example-modal-delete_product'.$row['id'].'" tabindex="-1" role="dialog" aria-hidden="true">
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
									<div class="modal fade bs-example-modal-view_product_'.$row['id'].'" tabindex="-1" role="dialog" aria-hidden="true">
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
												  <label>Product Code:</label>
												  <br>
												  '.$row['product_code'].'
												  <br>
												  <br>
												  <label>Product Brand:</label>
												  <br>
												  '.$row['product_brand'].'
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
												  <label>Product Review:</label>
												  <br>
												  '.$row['review'].'
												  <br>
												  <br>
												  <label>Remarks:</label>
												  <br>
												  '.$row['remarks'].'
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
										<label>Product Code:</label>
										<input type = "text" placeholder = "Product Code" name = "productcode" class = "form-control"/>
										<br>
										<label>Product Brand:</label>
										<input type = "text" placeholder = "Product Code" name = "product_brand" class = "form-control"/>
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
