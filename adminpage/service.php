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
                <a href="service.php" class="nav-item nav-link active"><i class="bi bi-gear fs-6"></i> Services</a>
                <a href="product.php" class="nav-item nav-link"><i class="bi bi-shop fs-6"></i> Product</a>
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
    

    <!-- Services Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <!--<div class="border-start border-5 border-primary ps-5 mb-5" style="max-width: 600px;">
               <h2 class="text-primary text-uppercase">Our Excellent Services</h2>
            </div>-->
            <div class="row g-5">
                <div class="col-md-6">
                    <div class="service-item bg-light d-flex p-4">
						<i class="fa fa-wrench display-1 text-primary me-4" style = "font-size: 100px;"></i>
                        <div>
                            <h5 class="mb-3">Repairing</h5>
                            <a class="text-primary text-uppercase" href="services1.php" target = "_blank">Go to Form<i class="bi bi-chevron-right"></i></a>
                        </div>
                    </div>
							<a href = "history1.php" target = "_blank">
								<i class="bi bi-eye"></i> View Transaction History
							</a>
                </div>
						
                <div class="col-md-6">
                    <div class="service-item bg-light d-flex p-4">
						<i class="fa fa-trash-o display-1 text-primary me-4" style = "font-size: 100px;"></i>
                        <div>
                            <h5 class="mb-3">Cleaning</h5>
                            <a class="text-primary text-uppercase" href="services2.php" target = "_blank">Go to Form<i class="bi bi-chevron-right"></i></a>
                        </div>
                    </div>
					<a href = "history2.php" target = "_blank">
						<i class="bi bi-eye"></i> View Transaction History
					</a>
                </div>
				
                <div class="col-md-6">
                    <div class="service-item bg-light d-flex p-4">
						<i class="fa fa-cogs display-1 text-primary me-4" style = "font-size: 100px;"></i>
                        <div>
                            <h5 class="mb-3">Supply & Installation</h5>
                            <a class="text-primary text-uppercase" href="services3.php" target = "_blank">Go to Form<i class="bi bi-chevron-right"></i></a>
                        </div>
                    </div>
					<a href = "history3.php" target = "_blank">
						<i class="bi bi-eye"></i> View Transaction History
					</a>
                </div>
                <div class="col-md-6">
                    <div class="service-item bg-light d-flex p-4">
						<i class="fa fa-code-fork display-1 text-primary me-4" style = "font-size: 100px;"></i>
                        <div>
                            <h5 class="mb-3">Dismantling / Relocation</h5>
                            <a class="text-primary text-uppercase" href="services4.php" target = "_blank">Go to Form<i class="bi bi-chevron-right"></i></a>
                        </div>
                    </div>
					<a href = "history4.php" target = "_blank">
						<i class="bi bi-eye"></i> View Transaction History
					</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Services End -->

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
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>