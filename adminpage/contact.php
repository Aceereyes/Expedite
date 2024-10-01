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
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow-sm py-3 py-lg-0 px-3 px-lg-0">
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


    <!-- Contact Start -->
    <div class="container-fluid pt-5">
        <div class="container">
            <div class="border-start border-5 border-primary ps-5 mb-5" style="max-width: 600px;">
                <h2 class="text-primary text-uppercase">Please Feel Free To Contact Us</h2>
            </div>
            <div class="row g-5">
                <div class="col-lg-7">
						<?php
							if(isset($_POST['send_message'])){
								
								$contactinformation = mysqli_query($conn, "SELECT * FROM contactinformation WHERE id = '1'");
								$contactinformation_view = mysqli_fetch_array($contactinformation);
								$contactinfo = $contactinformation_view['email'];
								$businesstime = $contactinformation_view['businesstime'];
								
								$name = $_POST['name'];
								$email = $_POST['email'];
								$subject = $_POST['subject'];
								$message = $_POST['message'];
								$date = date("F d, Y - h:i A");
								
								include 'mail.php';
								include 'mail_sender.php';
								
								mysqli_query($conn, "INSERT INTO inbox (name,email,subject,message,date)VALUES('$name','$email','$subject','$message','$date')");
								echo 'Message Sent.';
							}
						?>
                    <form method = "POST">
                        <div class="row g-3">
                            <div class="col-12">
                                <input type="text" class="form-control bg-light border-0 px-4" placeholder="Your Name" name = "name" style="height: 55px;">
                            </div>
                            <div class="col-12">
                                <input type="email" class="form-control bg-light border-0 px-4" placeholder="Your Email" name = "email" style="height: 55px;">
                            </div>
                            <div class="col-12">
                                <input type="text" class="form-control bg-light border-0 px-4" placeholder="Subject" name = "subject" style="height: 55px;">
                            </div>
                            <div class="col-12">
                                <textarea class="form-control bg-light border-0 px-4 py-3" rows="8" name = "message" placeholder="Message"></textarea>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" name = "send_message" type="submit">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
		<?php
			$contactinformation = mysqli_query($conn, "SELECT * FROM contactinformation WHERE id = '1'");
			$contactinformation_view = mysqli_fetch_array($contactinformation);
			$contactinfo = $contactinformation_view['contactinfo'];
			$contactno = $contactinformation_view['contactno'];
			$email = $contactinformation_view['email'];
			$googlemap_link = $contactinformation_view['googlemap_link'];
			$address = $contactinformation_view['address'];
		?>
                <div class="col-lg-5">
                    <div class="bg-light mb-5 p-5">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-geo-alt fs-1 text-primary me-3"></i>
                            <div class="text-start">
                                <h6 class="text-uppercase mb-1">Our Office</h6>
                                <span><?php echo ''.$address.''; ?></span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-envelope-open fs-1 text-primary me-3"></i>
                            <div class="text-start">
                                <h6 class="text-uppercase mb-1">Email Us</h6>
                                <span><a href="mailto:<?php echo ''.$email.''; ?>"><?php echo ''.$email.''; ?></a></span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-4">
                            <i class="bi bi-phone-vibrate fs-1 text-primary me-3"></i>
                            <div class="text-start">
                                <h6 class="text-uppercase mb-1">Call Us</h6>
                                <span><a href="tel:<?php echo ''.$contactno.''; ?>"><?php echo ''.$contactno.''; ?></a></span>
                            </div>
                        </div>
						<iframe class="position-relative w-100"
                                src="<?php echo ''.$googlemap_link.''; ?>"
                                frameborder="0" style="height: 205px; border:0;" allowfullscreen="" aria-hidden="false"
                                tabindex="0"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->


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