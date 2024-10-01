<?php
include 'adminpage/_connections/_database_connection.php';
session_start();
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
                <a href="product.php" class="nav-item nav-link active"><i class="bi bi-shop fs-6"></i> Product</a>
                <a href="contact.php" class="nav-item nav-link"><i class="bi bi-phone fs-6"></i> Contact</a>
                <a href="cart.php" class="nav-item nav-link"><i class="bi bi-cart fs-6"></i> MY CART</a>
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
                <h2 class="text-primary text-uppercase">Appliances and Accessories</h2>
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
						$total_quantity = $quantity * $price;
						mysqli_query($conn, "INSERT INTO cart
						(product_id,product_name,product_code,product_brand,quantity,price,total_price,photo,description,user_id,date,time,status)
						VALUES
						('$pid','$product_name','$product_code','$product_brand','$quantity','$price','$total_quantity','$photo','$description','$uid','$date','$time','CART')");
						echo '<h5 class="text-primary text-uppercase">Product Checked Out</h5>';
						echo '<META HTTP-EQUIV="REFRESH" CONTENT="2; URL=product.php">';
					}
				?>
            </div>
			
            <div class="owl-carousel" style="">
				<form method = "POST">
					<div class="input-group" style = "width: 500px;">
						<input type="text" id="search" class="form-control p-4" name="search" placeholder = "PRODUCT / BRAND / CODE"/>
						<button class="btn btn-primary" name = "find_product">SEARCH</button>
					</div>
					<br/>
				</form>
            </div>
			<div class="owl-carousel owl-theme">
			
				<?php
				if(isset($_POST['find_product'])){
					$search = $_POST['search'];
					$find_prod = ''.$search.'%';
					$message=mysqli_query($conn, "SELECT * FROM inventory WHERE product_name LIKE '$find_prod' || product_code LIKE '$find_prod' || product_brand LIKE '$find_prod'");
					while($row=mysqli_fetch_array($message))
					{
						echo '
						<div class="item">
							<div class="pb-5">
								<div class="product-item position-relative bg-light d-flex flex-column text-center">
									<img class="img-fluid mb-4" src="adminpage/_photos/products/'.$row['product_name'].'/'.$row['photo'].'" alt="" style = "height: 170px;">
									<h6 class="text-uppercase">'.$row['product_name'].'</h6>
									<h5 class="text-primary mb-0">₱'.$row['price'].'</h5>
									<h5 class="text-primary mb-0">Quantity: '.$row['quantity'].'</h5>
									<div class="btn-action d-flex justify-content-center">';
					
					if(!isset($_SESSION["loggedin_guest"]) || $_SESSION["loggedin_guest"] !== true){
					}else{
						echo '
										<a class="btn btn-primary py-2 px-3" data-bs-toggle="modal" data-bs-target="#checkout'.$row['id'].'">
											<i class="bi bi-cart"></i>
										</a>';
					}
						echo '
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
				}else{
					$message=mysqli_query($conn, "SELECT * FROM inventory");
					while($row=mysqli_fetch_array($message))
					{
						echo '
						<div class="item">
							<div class="pb-5">
								<div class="product-item position-relative bg-light d-flex flex-column text-center">
									<img class="img-fluid mb-4" src="adminpage/_photos/products/'.$row['product_name'].'/'.$row['photo'].'" alt="" style = "height: 170px;">
									<h6 class="text-uppercase">'.$row['product_name'].'</h6>
									<h5 class="text-primary mb-0">₱'.$row['price'].'</h5>
									<h5 class="text-primary mb-0">Quantity: '.$row['quantity'].'</h5>
									<div class="btn-action d-flex justify-content-center">';
					
					if(!isset($_SESSION["loggedin_guest"]) || $_SESSION["loggedin_guest"] !== true){
					}else{
						echo '
										<a class="btn btn-primary py-2 px-3" data-bs-toggle="modal" data-bs-target="#checkout'.$row['id'].'">
											<i class="bi bi-cart"></i>
										</a>';
					}
						echo '
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
        </div>
    </div>
    <!-- Products End -->
	
    <!-- Video Modal Start -->
	
				<?php
					$message=mysqli_query($conn, "SELECT * FROM inventory");
					while($row=mysqli_fetch_array($message))
					{
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
										<br/>
										<b>Product Code:</b> '.$row['product_code'].'<br/><br/>
										<b>Product Brand:</b> '.$row['product_brand'].'<br/><br/>
										<b>Price:</b> ₱'.$row['price'].'<br/><br/>
										<b>Quantity:</b> '.$row['quantity'].'<br/><br/>
										<b>Description:</b> '.$row['description'].'
									</div>
								</div>
							</div>
						</div>
						';
						
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
											<b>Product Code:</b> '.$row['product_code'].'<br/><br/>
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