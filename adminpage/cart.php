<?php
include 'adminpage/_connections/_database_connection.php';
session_start();
if(!isset($_SESSION["loggedin_guest"]) || $_SESSION["loggedin_guest"] !== true){
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include '_partial/partial_head.php'; ?>
</head>

<body>
    <!-- Topbar Start -->
<?php include '_partial/topbar.php'; ?>
    <!-- Topbar End -->

    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <!--<link rel="stylesheet" href="css/docs.theme.min.css">-->
    <link rel="stylesheet" href="css/owl.theme.default.min.css">

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow-sm py-3 py-lg-0 px-3 px-lg-0 mb-5">
        <a href="index.php" class="navbar-brand ms-lg-5">
            <?php include '_partial/titlebar.php'; ?>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0">
                <a href="index.php" class="nav-item nav-link"><i class="fa fa-home fs-6"></i> Home</a>
                <a href="about.php" class="nav-item nav-link"><i class="fa fa-info-circle fs-6"></i> About</a>
                <a href="service.php" class="nav-item nav-link"><i class="bi bi-gear fs-6"></i> Services</a>
                <a href="product.php" class="nav-item nav-link"><i class="bi bi-shop fs-6"></i> Product</a>
                <a href="contact.php" class="nav-item nav-link"><i class="bi bi-phone fs-6"></i> Contact</a>
                <a href="cart.php" class="nav-item nav-link active"><i class="bi bi-cart fs-6"></i> MY CART</a>
				<?php
					if(!isset($_SESSION["loggedin_guest"]) || $_SESSION["loggedin_guest"] !== true){
						echo '<a href="login.php" class="nav-item nav-link nav-contact bg-primary text-white px-5 ms-lg-5">Login <i class="bi bi-arrow-right"></i></a>';
					}else{
					$ADMIN_LOGIN_ID = $_SESSION["id"];
					$ADMIN_LOGIN_SELECT = mysqli_query($conn, "SELECT * FROM user_admins WHERE user_id = '$ADMIN_LOGIN_ID'");
					$ADMIN_LOGIN_VIEW = mysqli_fetch_array($ADMIN_LOGIN_SELECT);
					//ADMIN ID
					$ADMIN_USERID = $ADMIN_LOGIN_VIEW['user_id'];
					//ADMIN ACCOUNT
					$ADMIN_USERNAME = $ADMIN_LOGIN_VIEW['user_username'];
					//ADMIN PERSONAL INFORMATION
					$ADMIN_FIRSTNAME = $ADMIN_LOGIN_VIEW['user_firstname'];
					$ADMIN_MIDDLENAME = $ADMIN_LOGIN_VIEW['user_middlename'];
					$ADMIN_LASTNAME = $ADMIN_LOGIN_VIEW['user_lastname'];
					$ADMIN_EMAIL = $ADMIN_LOGIN_VIEW['user_email'];
					$ADMIN_BIRTHDAY = $ADMIN_LOGIN_VIEW['user_birthday'];
					$ADMIN_PROFILE_PHOTO = $ADMIN_LOGIN_VIEW['user_photo'];
					$ADMIN_PRIVILEDGE = $ADMIN_LOGIN_VIEW['user_priviledge_level'];
					$ADMIN_DEPARTMENT = $ADMIN_LOGIN_VIEW['user_priviledge'];
					$ADMIN_USER_DEPARTMENT = $ADMIN_LOGIN_VIEW['user_dept'];
					$ADMIN_PHOTO = $ADMIN_LOGIN_VIEW['user_photo'];
						echo '<a href="logout.php" class="nav-item nav-link nav-contact bg-primary text-white px-5 ms-lg-5">Logout <i class="bi bi-arrow-right"></i></a>';
					}
				?>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->


    <!-- Products Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="border-start border-5 border-primary ps-5 mb-5">
                <h2 class="text-primary text-uppercase">My Cart</h2><p><a href = "checkout.php?id=<?php echo $ADMIN_USERID; ?>">My Purchased History</a></p><p><a target = "_blank" href = "JMS-Terms-and-Condition.pdf">Payment Instructions</a></p>
				<?php
					if(isset($_POST['check_out'])){
						
						$pid = $_POST['pid'];
						$uid = $_POST['uid'];
						$quantity = $_POST['quantity'];
						$time = date("h:i");
						$date = date("F d, Y");
						
						$select_inventory = mysqli_query($conn, "SELECT * FROM inventory WHERE id = $pid");
						$select_inventory_view = mysqli_fetch_array($select_inventory);
						$product_name = $select_inventory_view['product_name'];
						$product_code = $select_inventory_view['product_code'];
						$product_brand = $select_inventory_view['product_brand'];
						$orig_quantity = $select_inventory_view['quantity'];
						$price = $select_inventory_view['price'];
						$photo = $select_inventory_view['photo'];
						$description = $select_inventory_view['description'];
						
						mysqli_query($conn, "INSERT INTO cart
						(product_name,product_code,product_brand,quantity,price,photo,description,user_id,date,time,status)
						VALUES
						('$product_name','$product_code','$product_brand','$quantity','$price','$photo','$description','$uid','$date','$time','WAITING FOR APPROVAL')");
						echo '<h5 class="text-primary text-uppercase">Product Checked Out</h5>';
						echo '<META HTTP-EQUIV="REFRESH" CONTENT="2; URL=product.php">';
					}
				?>
            </div>
			
			<div class="owl-carousel owl-theme">
				<?php
					if(!isset($_SESSION["loggedin_guest"]) || $_SESSION["loggedin_guest"] !== true){
					}else{
					$ADMIN_LOGIN_ID = $_SESSION["id"];
					$ADMIN_LOGIN_SELECT = mysqli_query($conn, "SELECT * FROM user_admins WHERE user_id = '$ADMIN_LOGIN_ID'");
					$ADMIN_LOGIN_VIEW = mysqli_fetch_array($ADMIN_LOGIN_SELECT);
					//ADMIN ID
					$ADMIN_USERID = $ADMIN_LOGIN_VIEW['user_id'];
					//ADMIN ACCOUNT
					$ADMIN_USERNAME = $ADMIN_LOGIN_VIEW['user_username'];
					//ADMIN PERSONAL INFORMATION
					$ADMIN_FIRSTNAME = $ADMIN_LOGIN_VIEW['user_firstname'];
					$ADMIN_MIDDLENAME = $ADMIN_LOGIN_VIEW['user_middlename'];
					$ADMIN_LASTNAME = $ADMIN_LOGIN_VIEW['user_lastname'];
					$ADMIN_EMAIL = $ADMIN_LOGIN_VIEW['user_email'];
					$ADMIN_BIRTHDAY = $ADMIN_LOGIN_VIEW['user_birthday'];
					$ADMIN_PROFILE_PHOTO = $ADMIN_LOGIN_VIEW['user_photo'];
					$ADMIN_PRIVILEDGE = $ADMIN_LOGIN_VIEW['user_priviledge_level'];
					$ADMIN_DEPARTMENT = $ADMIN_LOGIN_VIEW['user_priviledge'];
					$ADMIN_USER_DEPARTMENT = $ADMIN_LOGIN_VIEW['user_dept'];
					$ADMIN_PHOTO = $ADMIN_LOGIN_VIEW['user_photo'];
						$message=mysqli_query($conn, "SELECT * FROM cart WHERE status = 'CART' && user_id = $ADMIN_USERID GROUP BY product_name, product_brand");
						while($row=mysqli_fetch_array($message))
						{
									$pname = $row['product_name'];
									$pbrand = $row['product_brand'];
									$count_product = mysqli_query($conn, "SELECT COUNT(id) AS total_prod FROM cart WHERE product_name = '$pname' && product_brand = '$pbrand' && quantity != '0'"); 
									$count_product_show = mysqli_fetch_assoc($count_product); 
									$total_product = $count_product_show['total_prod'];
									
						echo '
							<div class="item">
								<div class="pb-5">
									<div class="product-item position-relative bg-light d-flex flex-column text-center">
										<img class="img-fluid mb-4" src="adminpage/_photos/products/'.$row['product_name'].'/'.$row['photo'].'" alt="" style = "height: 170px;">
										<h6 class="text-uppercase">'.$row['product_name'].'</h6>
										<h5 class="text-primary mb-0">₱'.$row['price'].'</h5>
										<h5 class="text-primary mb-0">Quantity: '.$total_product.'</h5>
										<div class="btn-action d-flex justify-content-center">
											<a class="btn btn-primary py-2 px-3" data-bs-toggle="modal" data-bs-target="#videoModal'.$row['id'].'">
												<i class="bi bi-eye"></i>
											</a>
										</div>
									</div>
								</div>
							</div>
							';
							echo '
							
							';
						}
					}
				?>
			</div>
			<?php
				if(!isset($_SESSION["loggedin_guest"]) || $_SESSION["loggedin_guest"] !== true){
				}else{
					$ADMIN_LOGIN_ID = $_SESSION["id"];
					$ADMIN_LOGIN_SELECT = mysqli_query($conn, "SELECT * FROM user_admins WHERE user_id = '$ADMIN_LOGIN_ID'");
					$ADMIN_LOGIN_VIEW = mysqli_fetch_array($ADMIN_LOGIN_SELECT);
					//ADMIN ID
					$ADMIN_USERID = $ADMIN_LOGIN_VIEW['user_id'];
					//ADMIN ACCOUNT
					$ADMIN_USERNAME = $ADMIN_LOGIN_VIEW['user_username'];
					//ADMIN PERSONAL INFORMATION
					$ADMIN_FIRSTNAME = $ADMIN_LOGIN_VIEW['user_firstname'];
					$ADMIN_MIDDLENAME = $ADMIN_LOGIN_VIEW['user_middlename'];
					$ADMIN_LASTNAME = $ADMIN_LOGIN_VIEW['user_lastname'];
					$ADMIN_EMAIL = $ADMIN_LOGIN_VIEW['user_email'];
					$ADMIN_BIRTHDAY = $ADMIN_LOGIN_VIEW['user_birthday'];
					$ADMIN_PROFILE_PHOTO = $ADMIN_LOGIN_VIEW['user_photo'];
					$ADMIN_PRIVILEDGE = $ADMIN_LOGIN_VIEW['user_priviledge_level'];
					$ADMIN_DEPARTMENT = $ADMIN_LOGIN_VIEW['user_priviledge'];
					$ADMIN_USER_DEPARTMENT = $ADMIN_LOGIN_VIEW['user_dept'];
					$ADMIN_PHOTO = $ADMIN_LOGIN_VIEW['user_photo'];
				?>
						<div style="padding-right: 25px;">
							<script>
								function toggleall(source){
									var checkboxes = document.querySelectorAll('input[type="checkbox"]');
									for (var i = 0; i < checkboxes.length; i++) {
										if (checkboxes[i] != source)
											checkboxes[i].checked = source.checked;
										}
								}
							</script>
							<?php
							if(isset($_POST['buy_now'])){
								if(isset($_POST['product_checkout'])){
									$product_checkout=$_POST['product_checkout'];
									//$quantity_checkout=$_POST['quantity_checkout']; 
									$user_id=$_POST['user_id'];
									$product_id=$_POST['product_id'];
									$total_product=$_POST['total_product'];
									$product_name=$_POST['product_name'];
									$product_brand=$_POST['product_brand'];
									$time_today = date("H:i:s");
									$date_today = date("Y-m-d");
										foreach($_POST['product_checkout'] as $pid_count){
											
										$select_product_from_cart = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = '$user_id' && product_name = '$pid_count'");
										$select_product_from_cart_view = mysqli_fetch_array($select_product_from_cart);
										$product_name_cart = $select_product_from_cart_view['product_name'];
										$product_code_cart = $select_product_from_cart_view['product_code'];
										$quantity_cart = $select_product_from_cart_view['quantity'];
										$price_cart = $select_product_from_cart_view['price'];
										$photo_cart = $select_product_from_cart_view['photo'];
										$description_cart = $select_product_from_cart_view['description'];
										echo $product_name_cart;
										$select_product_from_inventory = mysqli_query($conn, "SELECT * FROM inventory WHERE id = '$pid_count'");
										$select_product_from_inventory_view = mysqli_fetch_array($select_product_from_inventory);
										$product_name = $select_product_from_inventory_view['product_name'];
										$product_code = $select_product_from_inventory_view['product_code'];
										$product_brand = $select_product_from_inventory_view['product_brand'];
										$quantity = $select_product_from_inventory_view['quantity'];
										$price = $select_product_from_inventory_view['price'];
										$photo = $select_product_from_inventory_view['photo'];
										$description = $select_product_from_inventory_view['description'];
										
										$insert_activity = mysqli_query($conn, "INSERT INTO purchased 
										(product_name,product_code,product_brand,quantity,price,photo,description,date,time,product_id,user_id) VALUES 
										('$product_name','$product_code_cart','$product_brand','$quantity_cart','$price','$photo','$description','$date_today','$time_today','$pid_count','$user_id')");
										
										$new_quantity = $quantity - $quantity_cart;
										
											mysqli_query($conn, "UPDATE cart SET status = 'CHECK OUT', payment_status = 'PENDING' WHERE user_id = '$user_id' && product_name = '$pid_count'");
											
											foreach($_POST['product_id'] as $pid_){
												mysqli_query($conn, "DELETE FROM inventory WHERE id = '$pid_'");
											}
										}
										
										//echo '<META HTTP-EQUIV="REFRESH" CONTENT="2; URL=cart.php">';
								}
							}
							?>
									<form method = "POST" class="form-horizontal form-label-left input_mask" enctype="multipart/form-data">
										<table class="table">
										  <thead>
											<tr>
												<th>
													<center>
														<div class="checkbox">
															<label>
																<input type="checkbox" onclick="toggleall(this);"/>    
															</label>
														</div>
													</center>
												</th>
												<th>Product Name</th>
												<th>Price</th>
												<th>Quantity</th>
												<th>Total Price</th>
												<th>Date & Time</th>
											</tr>
										  </thead>
										  <tbody>
							<?php
								$ADMIN_LOGIN_ID = $_SESSION["id"];
								$message=mysqli_query($conn, "SELECT * FROM cart WHERE status = 'CART' && user_id = '$ADMIN_USERID' GROUP BY product_name, product_brand");
								while($row=mysqli_fetch_array($message))
								{
									$product_id = $row['product_id'];
									$product_name = $row['product_name'];
									$quantity = $row['quantity'];
									$price = $row['price'];
									$date = $row['date'];
									$time = $row['time'];
									$total_price = $row['total_price'];
									
									$pname = $row['product_name'];
									$pbrand = $row['product_brand'];
									$count_product = mysqli_query($conn, "SELECT COUNT(id) AS total_prod FROM cart WHERE product_name = '$pname' && product_brand = '$pbrand' && quantity != '0'"); 
									$count_product_show = mysqli_fetch_assoc($count_product); 
									$total_product = $count_product_show['total_prod'];
									
									echo '
											<tr>';
									echo '	<td>	
												<center>
													<div class="checkbox">
														<label>
															<input type="checkbox" name="product_checkout[]" id="checkbox2" onclick="disableMyText()" value="'.$product_name.'" />
														</label>
													</div>
												</center>
											</td>';
									echo '
											  <td>'.$product_name.'</td>
											  <td>'.$price.'</td>
											  <td>'.$total_product.'</td>
											  <td>'.$total_price.'</td>
											  <td>'.$date.' - '.$time.'</td>
											</tr>
								';
								}
								
								@$sum_total_price = mysqli_query($conn, "SELECT SUM(price) AS newtotal_price FROM cart WHERE status = 'CART' && quantity != '0' && user_id = '$ADMIN_LOGIN_ID'");
								@$sum_total_price_view = mysqli_fetch_array($sum_total_price);
								$sumoftotalprice = $sum_total_price_view['newtotal_price'];
								
								$check_product = mysqli_query($conn, "SELECT * FROM cart WHERE status = 'CART' && user_id = $ADMIN_USERID");
								if(mysqli_num_rows($check_product) > 0){
									echo '
											  <td></td>
											  <td></td>
											  <td></td>';
									echo '		<td><b>TOTAL PRICE:</b></td>
								
											  <td><b>'.$sumoftotalprice.'</b></td>';
								}
									echo '
											  
													<input type = "hidden" name = "user_id" value = "'.$ADMIN_LOGIN_ID.'"/><td>';
								$ADMIN_LOGIN_ID = $_SESSION["id"];
								$message=mysqli_query($conn, "SELECT * FROM cart WHERE status = 'CART' && user_id = $ADMIN_USERID");
								while($row=mysqli_fetch_array($message))
								{
														$product_id = $row['product_id'];
														$quantityew = $row['quantity'];
														$product_name = $row['product_name'];
														$product_brand = $row['product_brand'];
														echo '<input type = "hidden" name = "product_id[]" value = "'.$product_id.'"/>';
														echo '<input type = "hidden" name = "total_product" value = "'.$total_product.'"/>';
														echo '<input type = "hidden" name = "product_name" value = "'.$product_name.'"/>';
														echo '<input type = "hidden" name = "product_brand" value = "'.$product_brand.'"/>';
								}
								$check_product = mysqli_query($conn, "SELECT * FROM cart WHERE status = 'CART' && user_id = $ADMIN_USERID");
								if(mysqli_num_rows($check_product) > 0){
														echo '<button class="btn btn-primary" type="submit" name = "buy_now">BUY NOW</button>';
								}
								
									echo '				
													
											  </td>
										  </tbody>
										</table>';
								
								
							?>
									</form>
						</div>
					<?php } ?>
        </div>
    </div>
    <!-- Products End -->

	
    <!-- Video Modal Start -->
	
				<?php
				if(!isset($_SESSION["loggedin_guest"]) || $_SESSION["loggedin_guest"] !== true){
				}else{
					$ADMIN_LOGIN_ID = $_SESSION["id"];
					$ADMIN_LOGIN_SELECT = mysqli_query($conn, "SELECT * FROM user_admins WHERE user_id = '$ADMIN_LOGIN_ID'");
					$ADMIN_LOGIN_VIEW = mysqli_fetch_array($ADMIN_LOGIN_SELECT);
					//ADMIN ID
					$ADMIN_USERID = $ADMIN_LOGIN_VIEW['user_id'];
					//ADMIN ACCOUNT
					$ADMIN_USERNAME = $ADMIN_LOGIN_VIEW['user_username'];
					//ADMIN PERSONAL INFORMATION
					$ADMIN_FIRSTNAME = $ADMIN_LOGIN_VIEW['user_firstname'];
					$ADMIN_MIDDLENAME = $ADMIN_LOGIN_VIEW['user_middlename'];
					$ADMIN_LASTNAME = $ADMIN_LOGIN_VIEW['user_lastname'];
					$ADMIN_EMAIL = $ADMIN_LOGIN_VIEW['user_email'];
					$ADMIN_BIRTHDAY = $ADMIN_LOGIN_VIEW['user_birthday'];
					$ADMIN_PROFILE_PHOTO = $ADMIN_LOGIN_VIEW['user_photo'];
					$ADMIN_PRIVILEDGE = $ADMIN_LOGIN_VIEW['user_priviledge_level'];
					$ADMIN_DEPARTMENT = $ADMIN_LOGIN_VIEW['user_priviledge'];
					$ADMIN_USER_DEPARTMENT = $ADMIN_LOGIN_VIEW['user_dept'];
					$ADMIN_PHOTO = $ADMIN_LOGIN_VIEW['user_photo'];
						$message=mysqli_query($conn, "SELECT * FROM cart WHERE user_id = $ADMIN_USERID");
						while($row=mysqli_fetch_array($message))
						{
							
						$pname = $row['product_name'];
						$pbrand = $row['product_brand'];
						$count_product = mysqli_query($conn, "SELECT COUNT(id) AS total_prod FROM cart WHERE user_id = $ADMIN_USERID && product_name = '$pname' && product_brand = '$pbrand' && quantity != '0'"); 
						$count_product_show = mysqli_fetch_assoc($count_product); 
						$total_product = $count_product_show['total_prod'];
						
						echo '
							<div class="modal fade" id="videoModal'.$row['id'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content rounded-0">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">'.$row['product_name'].'</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body">
											<!-- 16:9 aspect ratio -->
											<div class="ratio ratio-16x9">
												<img class="img-fluid mb-4" src="adminpage/_photos/products/'.$row['product_name'].'/'.$row['photo'].'" alt="">
												
											</div>
											<b>Product Brand:</b> '.$row['product_brand'].'<br/><br/>';
						echo '				<b>Product Code:</b><br/>';
							$count_pcode=mysqli_query($conn, "SELECT * FROM cart WHERE user_id = $ADMIN_USERID");
							while($count_pcode_show=mysqli_fetch_array($count_pcode))
							{				
								echo '				'.$count_pcode_show['product_code'].'<br/>';
							}
						echo '				<br/>';
						echo '					
											<b>Price:</b> ₱'.$row['price'].'<br/><br/>
											<b>Quantity:</b> '.$total_product.'<br/><br/>
											<b>Description:</b> '.$row['description'].'
										</div>
									</div>
								</div>
							</div>
							';
						echo '
							<div class="modal fade" id="checkout'.$row['id'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content rounded-0">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Checking out ('.$row['product_name'].')</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body">
											<!-- 16:9 aspect ratio -->
											<div class="ratio ratio-16x9">
												<img class="img-fluid mb-4" src="adminpage/_photos/products/'.$row['product_name'].'/'.$row['photo'].'" alt="">
												
											</div>
											<br/>
											<b>Price:</b> '.$row['product_code'].'<br/><br/>
											<b>Product Brand:</b> '.$row['product_brand'].'<br/><br/>
											<b>Price:</b> ₱'.$row['price'].'<br/><br/>
											<b>Quantity:</b> '.$row['quantity'].'<br/><br/>
											<b>Description:</b> '.$row['description'].'
											<br/><br/>
											<form method="POST">';
							$pid = $row['id'];
							$select_inventory = mysqli_query($conn, "SELECT * FROM inventory WHERE id = '$pid'");
							$select_inventory_VIEW = mysqli_fetch_array($select_inventory);
							$inventory_quantity = $select_inventory_VIEW['quantity'];
						echo '
													<input type="hidden" name = "pid" value = "'.$row['id'].'" class="form-control p-3">
													<input type="hidden" name = "uid" value = "'.$ADMIN_USERID.'" class="form-control p-3">
													<div class="input-group">
														<input type="number" id="quantity" class="form-control p-3" name="quantity" value = "1" min="1" max="'.$inventory_quantity.'"/>
													</div>
													
													<div class="input-group">
														<button class="btn btn-primary" name = "check_out">Check Out</button>
													</div>
											</form>
										</div>
									</div>
								</div>
							</div>
							';
						}
				}
				?>
    <!-- Video Modal End -->
	

    <!-- Footer Start -->
	<?php include '_partial/footer.php'; ?>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary py-3 fs-4 back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.js"></script>
	<script>
		$(document).ready(function() {
			var owl = $('.owl-carousel');
			owl.owlCarousel({
				margin: 10,
                nav: true,
                loop: false,
                responsive: {
                  0: {
                    items: 1
                  },
                  600: {
                    items: 3
                  },
                  1000: {
                    items: 5
                  }
                }
              })
            })
	</script>
    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>