<?php
    include('app/bootstrap.php');

    if(isset($_SESSION['partner'])) {
        redirect('partner_dashboard.php');
        exit();
    }
    else if(isset($_SESSION['admin'])) {
        redirect('admin_dashboard.php');
        exit();
    }
    
    $_SESSION['freelancer'] = \App\Models\Freelancer::find(freelancer()->id);
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
    <div class="navbar-nav flex-row order-md-last">
        <div class="nav-item dropdown">
            <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                <div style="margin-right: 10px;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-currency-peso" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M8 19v-14h3.5a4.5 4.5 0 1 1 0 9h-3.5"></path>
                        <path d="M18 8h-12"></path>
                        <path d="M18 11h-12"></path>
                    </svg>
                </div>
                <div style="margin-right: 10px;" >
                    <!-- Add the email icon here -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M3 9l9 6l9 -6l-9 -6l-9 6"></path>
                        <path d="M21 9v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10"></path>
                        <path d="M3 19l6 -6"></path>
                        <path d="M15 13l6 6"></path>
                    </svg>
                </div>
                <div style="margin-right: 10px;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6"></path>
                        <path d="M9 17v1a3 3 0 0 0 6 0v-1"></path>
                    </svg>
                </div>
                <span class="avatar avatar-sm" style="background-image: url('<?= freelancer()->getAvatar() ?>')"></span>
                <div class="d-xl-block ps-2">
                    <div><?= freelancer()->fullName() ?></div>
                    <div class="mt-1 small text-muted">Freelancer</div>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <a href="<?= base_url('freelancer_profile.php') ?>" class="dropdown-item">Profile</a>
                <a href="<?= base_url('freelancer_cpass.php') ?>" class="dropdown-item">Change Password</a>
                <div class="dropdown-divider"></div>
                <a href="#" data-bs-toggle="modal" data-bs-target="#modal_logout" class="dropdown-item">Logout</a>
            </div>
        </div>
    </div>
</div>
        </header>

<?php
        $links = [
            'Home' => base_url('freelancer_dashboard.php'),
            'Job Orders' => base_url('freelancer_job_orders.php'),
            'Applied Jobs' => base_url('freelancer_jobs_applied.php'),
            'Wallet' => base_url('freelancer_funds.php'),
            'Examine' => base_url('freelancer_examine.php'),
            'Profile' => base_url('freelancer_profile.php'),
            'Explore' => base_url('freelancer_gps_explore.php'),
        ];

        if(freelancer()->initialSetup) {
            unset($links);
        }

        if(isset($links) && count($links) > 0) {
?>
            <div class="navbar-expand-md">
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <div class="navbar navbar-light">
                        <div class="container-xl">
                            <ul class="navbar-nav">
<?php
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
<?php
        }
?>
		<div class="page-wrapper">