<?php
    include('app/bootstrap.php');

    if(isset($_SESSION['freelancer'])) {
        redirect('freelancer_dashboard.php');
        exit();
    }
    else if(isset($_SESSION['admin'])) {
        redirect('admin_dashboard.php');
        exit();
    }
    $_SESSION['partner'] = \App\Models\Partner::find(partner()->id);
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
                            <span class="avatar avatar-sm" style="background-image: url('<?= partner()->getLogo() ?>')"></span>
                            <div class="d-xl-block ps-2">
                                <div><?= partner()->name ?></div>
                                <div class="mt-1 small text-muted">Partner</div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <a href="<?= base_url('partner_profile.php') ?>" class="dropdown-item">Profile</a>
                            <a href="<?= base_url('partner_cpass.php') ?>" class="dropdown-item">Change Password</a>
                            <div class="dropdown-divider"></div>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#modal_logout" class="dropdown-item">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
<?php
        $links = [
            'Active Jobs' => base_url('partner_dashboard.php'),
            'Freelancers' => base_url('freelancers.php'),
            'Jobs Posted' => base_url('partner_jobs.php'),
            'Calendar' => base_url('partner_calendar.php'),
            'Funds' => base_url('partner_funds.php'),
            'Explore' => base_url('partner_gps_explore.php'),
            'Examine' => base_url('partner_examine.php')
        ];

        if(partner()->initialSetup) {
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