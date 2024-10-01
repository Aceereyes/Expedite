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
    $_SESSION['admin'] = get_class($_SESSION['admin'])::find(admin()->id);
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
        <aside class="navbar navbar-vertical navbar-expand-lg navbar-dark">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu" aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <h1 class="navbar-brand navbar-brand-autodark pt-lg-3">
                    <a href="admin_dashboard.php" class="text-decoration-none">
                        <img src="<?= images('logo.png'); ?>" class="navbar-brand-image">
                        <span class="navbar-brand-text"><?= config('app.web_title'); ?></span>
                    </a>
                </h1>
                

                <hr class="m-0 border-bottom">
                <div class="navbar-nav flex-row d-lg-none">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                            <span class="avatar avatar-sm" style="background-image: url('<?= images('user.jpg'); ?>')"></span>
                            <div class="d-xl-block ps-2">
                                <div><?= admin()->fullName() ?></div>
                                <div class="mt-1 small text-muted">Admin</div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <a href="main_cpass" class="dropdown-item">Change Password</a>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#modal_logout" class="dropdown-item">
                                Logout
                            </a>
                        </div>
                    </div>
                </div>
                <div class="collapse navbar-collapse" id="sidebar-menu">
                    <ul class="navbar-nav pt-lg-3">
<?php
                        include('includes/admin_sidebar.php');
                        foreach($_CONFIG['sidebar'] as $item) {
                            if($item['access']) {
                                if(array_key_exists('submenu', $item)) {
?>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                                <i class="<?= $item['icon'] ?>" style="font-size: 20px;"></i>
                                            </span>
                                            <span class="nav-link-title">
                                                <?= $item['title'] ?>
                                            </span>
                                        </a>
                                        <div class="dropdown-menu">
<?php
                                            foreach ($item['submenu'] as $subitem) {
                                                if($subitem['access']) {
                                                    echo '<a class="dropdown-item" href="'.$subitem['route'].'">'.$subitem['title'].'</a>';
                                                }
                                            }
?>
                                        </div>
                                    </li>
<?php
                                } else {
                                    if($item['access']) {
?>
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?= $item['route']; ?>" >
                                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                                    <i class="<?= $item['icon']; ?>" style="font-size: 20px;"></i>
                                                </span>
                                                <span class="nav-link-title">
                                                    <?= $item['title']; ?>
                                                </span>
                                            </a>
                                        </li>
<?php
                                    }
                                }
                            }
                        }
?>
                    </ul>
                </div>
            </div>
        </aside>
        
        <header class="navbar navbar-expand-md navbar-light d-none d-lg-flex d-print-none">
            <div class="container-fluid justify-content-end">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-nav flex-row order-md-last">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                            <span class="avatar avatar-sm" style="background-image: url('<?= images('user.jpg'); ?>')"></span>
                            <div class="d-xl-block ps-2">
                                <div><?= admin()->fullName() ?></div>
                                <div class="mt-1 small text-muted">Admin</div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#modal_cpass" class="dropdown-item">
                                Change Password
                            </a>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#modal_logout" class="dropdown-item">
                                Logout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

		<div class="page-wrapper">