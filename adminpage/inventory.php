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
							$quantity = $_POST['quantity'];
							$productname = $_POST['productname'];
							$product_brand = $_POST['product_brand'];
							$type = $_POST['type'];
							$size = $_POST['size'];
							$horsepower = $_POST['horsepower'];
							$price = $_POST['price'];
							$productdescription = $_POST['productdescription'];
							
							$file=$_FILES['productphoto']['tmp_name'];
							$productphoto= addslashes(file_get_contents($_FILES['productphoto']['tmp_name']));
							$image_name= addslashes($_FILES['productphoto']['name']);
							$image_size= getimagesize($_FILES['productphoto']['tmp_name']);

							mkdir('_photos/products/'.$productname.'');
							
							move_uploaded_file($_FILES["productphoto"]["tmp_name"],"_photos/products/".$productname."/" . $_FILES["productphoto"]["name"]);
							
							$productphoto=$_FILES["productphoto"]["name"];
						
									function generateRandomString($length = 5){
									$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
									$charactersLength = strlen($characters);
									$randomString = '';
									for ($i = 0; $i < $length; $i++) {
										$randomString .= $characters[rand(0, $charactersLength - 1)];
										}
										return $randomString;
										}
						$check_user = mysqli_query($conn, "SELECT * FROM inventory WHERE product_name='".$productname."' && product_brand='".$product_brand."'");
							if(mysqli_num_rows($check_user) > 0){
								echo '
									<div class="alert alert-warning alert-dismissible fade in" role="alert">
										<i class = "fa fa-check-circle"></i> <b>EXISTING PRODUCT!</b>
										</br>
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
										Product <b>'.$productname.'</b> is already exist.
										</br>
									</div>';
								echo '<META HTTP-EQUIV="REFRESH" CONTENT="3;URL=inventory.php">';
							}else{

						for( $i=1; $i<=$quantity; $i++ )
						{
							$new_pcode = generateRandomString();
							mysqli_query($conn, "INSERT into inventory (product_name,product_code,product_brand,quantity,price,photo,description,type,size,hp)VALUES('$productname','$new_pcode','$product_brand','1','$price','$productphoto','$productdescription','$type','$size','$horsepower')");
								
						}
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
								$select_user = mysqli_query($conn, "SELECT * FROM inventory WHERE product_name = '$delete_product_id'");
								$select_user_view = mysqli_fetch_array($select_user);
								
								$product_name = $select_user_view['product_name'];
								$product_brand = $select_user_view['product_brand'];
								$quantity = $select_user_view['quantity'];
								$price = $select_user_view['price'];
								$description = $select_user_view['description'];
								$photo = $select_user_view['photo'];
										
								unlink("_photos/products/$product_name/$photo");
									
								rmdir("_photos/products/$product_name/");
								
								mysqli_query($conn, "DELETE FROM inventory WHERE product_name = '$product_name' && product_brand = '$product_brand'");
								
								
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
						
					if(isset($_POST['update_product_details'])){
						$product_id = $_POST['product_id'];
						$existing_quantity = $_POST['existing_quantity'];
						$product_name_new = $_POST['product_name'];
						$product_brand_new = $_POST['product_brand'];
						$type_new = $_POST['type'];
						$size_new = $_POST['size'];
						$horsepower_new = $_POST['horsepower'];
						$quantity_new = $_POST['quantity'];
						$price_new = $_POST['price'];
						$description_new = $_POST['description'];
							if($existing_quantity == $quantity_new){
								$select_photo=mysqli_query($conn, "SELECT * FROM inventory WHERE product_name = '$product_id'");
								$select_photo_show=mysqli_fetch_array($select_photo);
								$id = ''.$select_photo_show['id'].'';
								$product_name = ''.$select_photo_show['product_name'].'';
								$product_code = ''.$select_photo_show['product_code'].'';
								$product_brand = ''.$select_photo_show['product_brand'].'';
								$quantity = ''.$select_photo_show['quantity'].'';
								$price = ''.$select_photo_show['price'].'';
								$photo = ''.$select_photo_show['photo'].'';
								$description = ''.$select_photo_show['description'].'';
								
									$product_photo=$_FILES["product_photo"]["name"];
									
									unlink("_photos/products/".$product_name."/$photo");
									rmdir("_photos/products/".$product_name."");
									
									mkdir('_photos/products/'.$product_name_new.'');
									$file=$_FILES['product_photo']['tmp_name'];
									$product_photo= addslashes(file_get_contents($_FILES['product_photo']['tmp_name']));
									$image_name= addslashes($_FILES['product_photo']['name']);
									$image_size= getimagesize($_FILES['product_photo']['tmp_name']);
									move_uploaded_file($_FILES["product_photo"]["tmp_name"],"_photos/products/".$product_name_new."/" . $_FILES["product_photo"]["name"]);
									$product_photo=$_FILES["product_photo"]["name"];
									
									date_default_timezone_set("Asia/Manila");
									$time_today = date("H:i:s");
									$date_today = date("Y-m-d");
									$activity = 'Modified information of product <b>'.$product_name.'</b> <a target = "_blank" href = "user.php?cieti_user_id='.$product_id.'">(<i>click here to view this user</i>)</a>.';
									$module = 'Modify product information.';
									$link = 'inventory.php';
									$result = 'Product information has been succesfully updated.';
									$insert_activity = mysqli_query($conn, "INSERT INTO activity_logs 
									(time,date,activity,module,link,result,user_id) VALUES 
									('$time_today','$date_today','$activity','$module','$link','$result','$ADMIN_USERID')");

									mysqli_query($conn, "UPDATE inventory SET 
									product_name = '$product_name_new', 
									product_brand = '$product_brand_new', 
									type = '$type_new', 
									size = '$size_new', 
									hp = '$horsepower_new', 
									price = '$price_new', 
									photo = '$product_photo', 
									description='$description_new' WHERE product_name = '$product_id'");
									echo '
									<div class="alert alert-success alert-dismissible fade in" role="alert">
										<i class = "fa fa-info-circle"></i>
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
										<b>'.$product_name_new.'</b> Information was successfully updated in our database.
									</div>';
									echo '<META HTTP-EQUIV="REFRESH" CONTENT="2;URL=inventory.php">';
							}elseif($existing_quantity > $quantity_new){
								
								$select_photo=mysqli_query($conn, "SELECT * FROM inventory WHERE product_name = '$product_id'");
								$select_photo_show=mysqli_fetch_array($select_photo);
								$id = ''.$select_photo_show['id'].'';
								$product_name = ''.$select_photo_show['product_name'].'';
								$product_code = ''.$select_photo_show['product_code'].'';
								$product_brand = ''.$select_photo_show['product_brand'].'';
								$quantity = ''.$select_photo_show['quantity'].'';
								$price = ''.$select_photo_show['price'].'';
								$photo = ''.$select_photo_show['photo'].'';
								$description = ''.$select_photo_show['description'].'';
								
									$product_photo=$_FILES["product_photo"]["name"];
									
									unlink("_photos/products/".$product_name."/$photo");
									$file=$_FILES['product_photo']['tmp_name'];
									$product_photo= addslashes(file_get_contents($_FILES['product_photo']['tmp_name']));
									$image_name= addslashes($_FILES['product_photo']['name']);
									$image_size= getimagesize($_FILES['product_photo']['tmp_name']);
									move_uploaded_file($_FILES["product_photo"]["tmp_name"],"_photos/products/".$product_name."/" . $_FILES["product_photo"]["name"]);
									$product_photo=$_FILES["product_photo"]["name"];
									
									date_default_timezone_set("Asia/Manila");
									$time_today = date("H:i:s");
									$date_today = date("Y-m-d");
									$activity = 'Modified information of product <b>'.$product_name.'</b> <a target = "_blank" href = "user.php?cieti_user_id='.$product_id.'">(<i>click here to view this user</i>)</a>.';
									$module = 'Modify product information.';
									$link = 'inventory.php';
									$result = 'Product information has been succesfully updated.';
									$insert_activity = mysqli_query($conn, "INSERT INTO activity_logs 
									(time,date,activity,module,link,result,user_id) VALUES 
									('$time_today','$date_today','$activity','$module','$link','$result','$ADMIN_USERID')");
									$total_delete = $existing_quantity - $quantity_new;
									mysqli_query($conn, "DELETE FROM inventory WHERE product_name = '$product_id'");
									mysqli_query($conn, "UPDATE inventory SET 
									product_name = '$product_name_new', 
									product_brand = '$product_brand_new', 
									type = '$type_new', 
									size = '$size_new', 
									hp = '$horsepower_new', 
									price = '$price_new', 
									photo = '$product_photo', 
									description='$description_new' WHERE product_name = '$product_id'");
									echo '
									<div class="alert alert-success alert-dismissible fade in" role="alert">
										<i class = "fa fa-info-circle"></i>
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
										<b>'.$product_name_new.'</b> Information was successfully updated in our database.
									</div>';
									//echo '<META HTTP-EQUIV="REFRESH" CONTENT="2;URL=inventory.php">';
							}
						}
					echo '
						<table id="datatable" class="table-hover table table-striped table-bordered">
							<thead>
								<tr>
									<th>Product</th>
									<th>Product Brand</th>
									<th>Quantity</th>
									<th>Price</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							';
					$message=mysqli_query($conn, "SELECT * FROM inventory WHERE quantity != '0' GROUP BY product_name, product_brand");
					while($row=mysqli_fetch_array($message))
					{
						$pid = $row['id'];
						$product_name = $row['product_name'];
						$product_brand = $row['product_brand'];
						
						$total_inventory = mysqli_query($conn, "SELECT COUNT(quantity) AS total_product FROM inventory WHERE product_name = '$product_name' && product_brand = '$product_brand' && quantity != '0'"); 
						$total_inventory_show = mysqli_fetch_assoc($total_inventory); 
						$total_inventory_1 = $total_inventory_show['total_product'];
						
						$total_product_sales = mysqli_query($conn, "SELECT SUM(quantity) AS total_product FROM purchased WHERE product_id = '$pid'"); 
						$total_product_sales_show = mysqli_fetch_assoc($total_product_sales); 
						$total_prod = $total_product_sales_show['total_product'];
						
						$total_sales = mysqli_query($conn, "SELECT SUM(price) AS total_sales FROM purchased WHERE product_id = '$pid'"); 
						$total_sales_show = mysqli_fetch_assoc($total_sales); 
						$total_sale = $total_sales_show['total_sales'];
					echo '	
								<tr class="record">
									<td>'.$row['product_name'].'</td>
									<td>'.$row['product_brand'].'</td>
									<td>'.$total_inventory_1.'</td>
									<td>'.$row['price'].'</td>
									<td>
										<a data-toggle="modal" data-target=".bs-example-modal-view_product_'.$row['id'].'" class = "btn btn-xs btn-info"><i class="fa fa-eye"></i> VIEW</a>
										<a data-toggle="modal" data-target=".bs-example-modal-edit_product_'.$row['id'].'" class = "btn btn-xs btn-warning"><i class="fa fa-pencil"></i> EDIT</a>
										<a data-toggle="modal" data-target=".bs-example-modal-delete_product'.$row['id'].'" class = "btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> DELETE</a>
									</td>
								</tr>
							';
									$count_product = mysqli_query($conn, "SELECT COUNT(id) AS total_prod FROM inventory WHERE product_name = '$product_name' && product_brand = '$product_brand' && quantity != '0'"); 
									$count_product_show = mysqli_fetch_assoc($count_product); 
									$total_product = $count_product_show['total_prod'];
							echo '
				<div class="modal fade bs-example-modal-edit_product_'.$row['id'].'" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-info-circle"></i> MODIFY <b>'.$row['product_name'].'</b>\'s INFORMATION</h4>
                        </div>
							<form id="demo-form" method = "POST" enctype="multipart/form-data" data-parsley-validate>
								<div class="modal-body">
									<input type="hidden" class="form-control" name="product_id" value = "'.$row['product_name'].'" />
									<input required type="hidden" id="existing_quantity" class="form-control" name="existing_quantity" value = "'.$total_product.'" required />
									<div class=" form-group has-feedback">
										<label for = "product_name">PRODUCT NAME:</label>
										<input required onkeypress="return /[0-9a-zA-Z @ _ .]/i.test(event.key)" type="text" id="product_name" class="form-control" name="product_name" value = "'.$row['product_name'].'" required />
									</div>
									<div class=" form-group has-feedback">
										<label for="product_brand">PRODUCT BRAND:</label>
										<input required onkeypress="return /[0-9a-zA-Z @ _ .]/i.test(event.key)" type="text" id="product_brand" class="form-control" name="product_brand" value = "'.$row['product_brand'].'" required />
									</div>
									<div class=" form-group has-feedback">
										<label for="type">PRODUCT TYPE:</label>
										<select class = "form-control" name="type">
											<option>TV</option>
											<option>Aircon</option>
										</select>
									</div>
									<div class=" form-group has-feedback">
										<label for="size">PRODUCT SIZE:</label>
										<input onkeypress="return /[0-9a-zA-Z @ _ .]/i.test(event.key)" type="text" id="size" class="form-control" name="size" value = "'.$row['size'].'" />
									</div>
									<div class=" form-group has-feedback">
										<label for="horsepower">PRODUCT HORSE POWER:</label>
										<input onkeypress="return /[0-9a-zA-Z @ _ .]/i.test(event.key)" type="text" id="horsepower" class="form-control" name="horsepower" value = "'.$row['hp'].'" />
									</div>
										<input required onkeypress="return /[0-9]/i.test(event.key)" type="hidden" id="quantity" class="form-control" name="quantity" value = "'.$total_product.'" required />
									<div class=" form-group has-feedback">
										<label for="price">PRICE:</label>
										<input required onkeypress="return /[0-9]/i.test(event.key)" type="text" id="price" class="form-control" name="price" value = "'.$row['price'].'" required />
									</div>
									<div class=" form-group has-feedback">
										<label for="description">DESCRIPTION:</label>
										<input required onkeypress="return /[0-9a-zA-Z_ ! @ # $ % ^ & * ( ) _ - + =]/i.test(event.key)" type="text" id="description" class="form-control" name="description" value = "'.$row['description'].'" required />
									</div>
									<div class=" form-group has-feedback">
										<label for="product_photo">PHOTO:</label>
										<input required type="file" id="product_photo" class="form-control" name="product_photo"/>
									</div>
								</div> 
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
									<button  type="submit" name = "update_product_details" class="btn btn-success" download><i class="fa fa-pencil"></i> Update</button>
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
										<input value = "'.$row['product_name'].'" type="hidden" name = "delete_product_id">
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
												  <br>';
										$inventory_pcode=mysqli_query($conn, "SELECT * FROM inventory WHERE product_name = '$product_name' && product_brand = '$product_brand'");
										while($inventory_pcode_show=mysqli_fetch_array($inventory_pcode))
										{
											$pname = $inventory_pcode_show['product_name'];
											$pbrand = $inventory_pcode_show['product_brand'];
											$pcode = $inventory_pcode_show['product_code'];
											echo ''.$pcode.'<br/>';
										}
										
						$count_product = mysqli_query($conn, "SELECT SUM(quantity) AS total_prod FROM inventory WHERE product_name = '$pname' && product_brand = '$pbrand' && quantity != '0'"); 
						$count_product_show = mysqli_fetch_assoc($count_product); 
						$total_product = $count_product_show['total_prod'];
						echo '
												  <br>
												  <label>Product Brand:</label>
												  <br>
												  '.$row['product_brand'].'
												  <br>
												  <br>
												  <label>Product Type:</label>
												  <br>
												  '.$row['type'].'
												  <br>
												  <br>';
											if($row['size'] != ''){
											echo '<label>Product Size:</label>
												  <br>
												  '.$row['size'].'
												  <br>
												  <br>';
												  }
											if($row['hp'] != ''){
											echo '<label>Product Horsepower:</label>
												  <br>
												  '.$row['hp'].'
												  <br>
												  <br>';
											}
											echo '
												  <label>Product Description:</label>
												  <br>
												  '.$row['description'].'
												  <br>
												  <br>
												  <label>Quantity:</label>
												  <br>
												  '.$total_product.'
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
										<input type = "text" placeholder = "Product Name" name = "productname" class = "form-control" onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)"/>
										<br>
										<label>Product Brand:</label>
										<input type = "text" placeholder = "Product Brand" name = "product_brand" class = "form-control" onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)"/>
										<br>
										<label>Type:</label>
										<select class = "form-control" name="type">
											<option>TV</option>
											<option>Aircon</option>
										</select>
										<br>
										<label>Size:</label>
										<input type = "text" placeholder = "Size" name = "size" class = "form-control" onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)"/>
										<br>
										<label>Horse Power:</label>
										<input type = "text" placeholder = "Horse Power" name = "horsepower" class = "form-control" onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)"/>
										<br>
										<label>Quantity:</label>
										<input type = "number" placeholder = "Quantity" name = "quantity" class = "form-control" onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)"/>
										<br>
										<label>Price:</label>
										<input type = "number" placeholder = "Price" name = "price" class = "form-control" onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)"/>
										<br>
										<label>Product Description:</label>
										<textarea type = "text" placeholder = "Product Description" name = "productdescription" class = "form-control" onkeypress="return /[0-9a-zA-Z ]/i.test(event.key)"></textarea>
										<br>
										<label>Photo:</label>
										<input type = "file" name = "productphoto" accept="image/png, image/gif, image/jpeg" class = "form-control" required />
										<br>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
											<button type="submit" name = "add_new_product" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
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
