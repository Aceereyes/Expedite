<?php
// Initialize the session
session_start();
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin_guest"]) && $_SESSION["loggedin_guest"] === true){
    header("location: index.php");
    exit;
}
// Include config file
include 'adminpage/_connections/_database_connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<?php
//student no and username auto generate
$checkID=mysqli_query($conn, "SELECT * FROM user_admins ORDER BY user_id DESC");
$checkautoID=mysqli_fetch_array($checkID);
$auto_id = $checkautoID['user_auto_id'];
$query = mysqli_query($conn, "SELECT count(*) AS id FROM user_admins");
$values = mysqli_fetch_assoc($query);
$autoID = $values['id'];
$count = '1000';
$countnum = '1';
$adminadd = $count + $autoID;
$staff_year = date("Y");
//student password auto generate
function generateRandomString($length = 10){
	$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
		}
?>
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
                <a href="index.php" class="nav-item nav-link">Home</a>
                <a href="about.php" class="nav-item nav-link">About</a>
                <a href="service.php" class="nav-item nav-link">Service</a>
                <a href="product.php" class="nav-item nav-link">Product</a>
                <a href="contact.php" class="nav-item nav-link">Contact</a>
                <a href="login.php" class="nav-item nav-link nav-contact bg-primary text-white px-5 ms-lg-5">Login <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->


    <!-- Contact Start -->
    <div class="container-fluid pt-5">
        <div class="container">
            <div class="border-start border- border-primary ps-5 mb-5" style="max-width: 600px;">
                <h1 class="text-primary text-uppercase">Create Account</h1>
                <h4 class="text-primary text-uppercase">
				</h4>
					<?php 
						function add_administrator_user_account(){
							if(isset($_POST['create_account'])){
								date_default_timezone_set("Asia/Manila");
								include 'adminpage/_connections/_database_connection.php';
								//QUERY
								include 'adminpage/_user_accounts/_guest_add.php';
							}
						}
						add_administrator_user_account();
					?>
            </div>
            <div class="row g-5">
                <div class="col-lg-12">
					<form method="post" autocomplete = "OFF" enctype="multipart/form-data">
                        <div class="row g-3">
							<h4>User's Information</h4>
							<input required id = "user_autoid" name="user_autoid" class="form-control input-sm" type="hidden" value = "<?php if($auto_id == 0){ echo $count;}else{ echo $adminadd; } ?>">
							<input required class="form-control" name="user_staffid" id = "user_staffid" type="hidden" value = "<?php if($autoID == 0){echo $staff_year;echo '-';echo $adminadd; }else{echo $staff_year;echo '-';echo $adminadd;}?>" readonly>
                            <?php $startDate = time();$today = date('Y-m-d', strtotime('-1 day', $startDate));?>
							<input required class="form-control" name="user_staffdateregistration" id = "user_staffdateregistration" type="hidden" value = "<?php echo $today; ?>" readonly>
							<div class="col-4">
								<input type="text" name="user_staff_first_name" placeholder="First Name" style="height: 55px;" class="form-control bg-light border-0 px-4" required>
                            </div>
                            <div class="col-4">
								<input type="text" name="user_staff_middle_name" placeholder="Middle Name" style="height: 55px;" class="form-control bg-light border-0 px-4" required>
                            </div>
                            <div class="col-4">
								<input type="text" name="user_staff_last_name" placeholder="Last Name" style="height: 55px;" class="form-control bg-light border-0 px-4" required>
                            </div>
                            <div class="col-6">
								<input type="text" name="user_staff_contact" placeholder="Contact No." style="height: 55px;" class="form-control bg-light border-0 px-4" required>
                            </div>
                            <div class="col-6">
								<input type="email" name="user_staff_email" placeholder="Email" style="height: 55px;" class="form-control bg-light border-0 px-4" required>
                            </div>
                            <div class="col-12">
								<label>Photo:</label>
								<input type="file" name = "user_staff_photo" id="user_staff_photo" class="form-control bg-light border-0 px-4">
                            </div>
							<h4>Account Credentials</h4>
                            <div class="col-4">
								<input type="text" name="user_staff_username" placeholder="Username" style="height: 55px;" class="form-control bg-light border-0 px-4" required>
                            </div>
                            <div class="col-4">
								<input type="text" name="user_staff_password" placeholder="Password" style="height: 55px;" class="form-control bg-light border-0 px-4" required>
                            </div>
                            <div class="col-4">
								<input type="text" name="repassword" placeholder="Re-Password" style="height: 55px;" class="form-control bg-light border-0 px-4" required>
                            </div>
                            <div class="col-12">
								<button type="submit" name = "create_account" class="btn btn-primary w-100 py-3"><i class="fa fa-unlock"></i> Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->

					<script>
					function myFunction1() {
						var x = document.getElementById("myInput1");
							if (x.type === "password") {
								x.type = "text";
							  } else {
								x.type = "password";
							  }
						}
					</script>

    <!-- Footer Start -->
    <div class="container-fluid bg-light mt-5 py-5">
        <div class="container pt-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-uppercase border-start border-5 border-primary ps-3 mb-4">Get In Touch</h5>
                    <p class="mb-4">No dolore ipsum accusam no lorem. Invidunt sed clita kasd clita et et dolor sed dolor</p>
                    <p class="mb-2"><i class="bi bi-geo-alt text-primary me-2"></i>123 Street, New York, USA</p>
                    <p class="mb-2"><i class="bi bi-envelope-open text-primary me-2"></i>info@example.com</p>
                    <p class="mb-0"><i class="bi bi-telephone text-primary me-2"></i>+012 345 67890</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-uppercase border-start border-5 border-primary ps-3 mb-4">Quick Links</h5>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-body mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Home</a>
                        <a class="text-body mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>About Us</a>
                        <a class="text-body mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Our Services</a>
                        <a class="text-body mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Meet The Team</a>
                        <a class="text-body mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Latest Blog</a>
                        <a class="text-body" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Contact Us</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-uppercase border-start border-5 border-primary ps-3 mb-4">Popular Links</h5>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-body mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Home</a>
                        <a class="text-body mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>About Us</a>
                        <a class="text-body mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Our Services</a>
                        <a class="text-body mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Meet The Team</a>
                        <a class="text-body mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Latest Blog</a>
                        <a class="text-body" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Contact Us</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-uppercase border-start border-5 border-primary ps-3 mb-4">Newsletter</h5>
                    <form action="">
                        <div class="input-group">
                            <input type="text" class="form-control p-3" placeholder="Your Email">
                            <button class="btn btn-primary">Sign Up</button>
                        </div>
                    </form>
                    <h6 class="text-uppercase mt-4 mb-3">Follow Us</h6>
                    <div class="d-flex">
                        <a class="btn btn-outline-primary btn-square me-2" href="#"><i class="bi bi-twitter"></i></a>
                        <a class="btn btn-outline-primary btn-square me-2" href="#"><i class="bi bi-facebook"></i></a>
                        <a class="btn btn-outline-primary btn-square me-2" href="#"><i class="bi bi-linkedin"></i></a>
                        <a class="btn btn-outline-primary btn-square" href="#"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>
                <div class="col-12 text-center text-body">
                    <a class="text-body" href="">Terms & Conditions</a>
                    <span class="mx-1">|</span>
                    <a class="text-body" href="">Privacy Policy</a>
                    <span class="mx-1">|</span>
                    <a class="text-body" href="">Customer Support</a>
                    <span class="mx-1">|</span>
                    <a class="text-body" href="">Payments</a>
                    <span class="mx-1">|</span>
                    <a class="text-body" href="">Help</a>
                    <span class="mx-1">|</span>
                    <a class="text-body" href="">FAQs</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark text-white-50 py-4">
        <div class="container">
            <div class="row g-5">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-md-0">&copy; <a class="text-white" href="#">Your Site Name</a>. All Rights Reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-0">Designed by <a class="text-white" href="https://htmlcodex.com">HTML Codex</a></p>
                </div>
            </div>
        </div>
    </div>
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