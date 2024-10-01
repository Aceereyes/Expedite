<?php
    include('app/bootstrap.php');

    if(isset($_SESSION['freelancer'])) {
        redirect('freelancer_dashboard.php');
        exit();
    }
    else if(isset($_SESSION['partner'])) {
        redirect('partner_dashboard.php');
        exit();
    }
    else if(isset($_SESSION['admin'])) {
        redirect('admin_dashboard.php');
        exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="icon" type="image/png" href="<?= images('logo.png'); ?>"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?= config('app.web_title'); ?></title>
	<link rel="stylesheet" href="<?= css('tabler-icons.css'); ?>">
    <link rel="stylesheet" href="<?= css('app.css'); ?>">
	<link rel="stylesheet" href="<?= plugins('toastr/toastr.min.css'); ?>">
	<link rel="stylesheet" href="<?= plugins('sweetalert2/sweetalert2.css'); ?>">
	<link rel="stylesheet" href="<?= css('tabler-vendors.css'); ?>">
    <link rel="stylesheet" href="<?= css('custom.css'); ?>">
	<script src="<?= plugins('jquery/jquery.min.js'); ?>"></script>
	<script src="<?= plugins('toastr/toastr.min.js'); ?>"></script>
	<script src="<?= plugins('sweetalert2/sweetalert2.js'); ?>"></script>
    <script src="<?= js('app.js'); ?>"></script>
</head>
<body class="theme-light">
    <div class="preloader">
        <div class="page page-center">
            <div class="container container-slim py-4">
                <div class="text-center">
                    <div class="mb-3">
                        <a href="#" class="navbar-brand navbar-brand-autodark"><img src="<?= images('logo.png'); ?>" height="36" alt=""></a>
                    </div>
                    <div class="text-muted mb-3 fw-bolder"><?= config('app.web_title'); ?></div>
                    <div class="progress progress-sm">
                        <div class="progress-bar progress-bar-indeterminate"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<div class="page">
        <!-- Navbar -->
        <header class="navbar navbar-expand-md navbar-dark d-print-none">
            <div class="container-xl">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                    <a href=".">
                        <img src="<?= images('logo.png'); ?>" height="32" alt="Logo" class="navbar-brand-image">
                    </a>
                </h1>
                <!-- Start Modal-->

                <div class="navbar-nav flex-row order-md-last">
                    <div class="nav-item d-md-flex me-3">
                        <div class="btn-list">     
                            <a data-toggle="modal" data-target="#loginModal" href="<?= base_url('login_freelancer.php'); ?>" class="btn btn-dark" rel="noreferrer">Login</a>
                            <a data-toggle="modal" data-target="#registerModal" href="<?= base_url('register_freelancer.php'); ?>" class="btn btn-dark" rel="noreferrer">Register</a>
                        </div>
                    </div>
                </div>

                <div id="loginModal" class="modal fade login-box-wrapper" tabindex="-1" style="display: none;" data-backdrop="static" data-keyboard="false" data-replace="true">
                    <div class="modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title text-center">Log-in to your Account</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row gap-20">
                                    <div class="col-sm-6 col-md-6">
                                        <a href="login.php" class="btn btn-primary btn-block">Log-in as User</a>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <a href="admin-login.php" class="btn btn-primary btn-block">Log-in as Administrator</a>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer text-center">
                                <p>Don't have an account? <a data-toggle="modal" href="#registerModal">Register</a></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="registerModal" class="modal fade login-box-wrapper" tabindex="-1" style="display: none;" data-backdrop="static" data-keyboard="false" data-replace="true">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title text-center">Create your account for free</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row gap-20">
                            <div class="col-sm-6 col-md-6">
                                <a href="register.php?p=Employer" class="btn btn-facebook btn-block mb-5-xs">Register as Employer</a>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <a href="register.php?p=Employee" class="btn btn-facebook btn-block mb-5-xs">Register as Freelancer</a>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer text-center">
                        <button type="button" data-dismiss="modal" class="btn btn-primary btn-inverse">Close</button>
                    </div>
                </div>

                <!-- End Modal-->
            </div>
        </header>
        <div class="navbar-expand-md">
            <div class="collapse navbar-collapse" id="navbar-menu">
                <div class="navbar navbar-light">
                    <div class="container-xl">
                        <ul class="navbar-nav">
<?php
                            $links = [
                                'Home' => base_url('index.php'),
                                // 'Job List' => base_url('job_list.php'),
                                'Partners' => base_url('partners.php'),
                                // 'Freelancers' => base_url('freelancers.php'),
                                'About Us' => base_url('about_us.php'),
                                'Contact Us' => base_url('contact_us.php'),
                                'FAQs' => base_url('faqs.php'),
                                'Join Us' => base_url('join_us.php'),
                            ];
                            
                            foreach($links as $name => $link) {
                                echo "<li class=\"nav-item\">
                                    <a class=\"nav-link\" href=\"$link\">
                                        <span class=\"nav-link-title\">
                                            $name
                                        </span>
                                    </a>
                                </li>";
                            }
?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

		<div class="page-wrapper">