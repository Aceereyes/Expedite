<?php
    include('includes/admin_header.php');
?>
<div class="page-header d-print-none">
    <div class="container-fluid">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title" id="page-title">
                    Dashboard
                </h2>
            </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-fluid">
        <div class="alert alert-info">
            <div class="alert-title">
                Welcome <?= admin()->fullName() ?? null ?>
            </div>
            <div class="text-muted">
                You are logged in!
            </div>
        </div>
        <div class="row g-2">
        <div class="col-sm-6 col-lg-3">
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <!-- FIRST CARD -->
                <div class="subheader">Revenue</div>
                            <div class="ms-auto lh-1">
                                <div class="dropdown">
                                    <a class="dropdown-toggle text-secondary" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Last 7 days</a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item active" href="#">Last 7 days</a>
                                        <a class="dropdown-item" href="#">Last 30 days</a>
                                        <a class="dropdown-item" href="#">Last 3 months</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-baseline">
                            <div class="h1 mb-0 me-2">₱4,300</div>
                            <div class="me-auto">
                                <span class="text-green d-inline-flex align-items-center lh-1">
                                    8% <!-- Download SVG icon from http://tabler-icons.io/i/trending-up -->
                                </span>
                            </div>
                        </div>
                    </div>
                    <div id="chart-revenue-bg" style="min-height: 16px;">

                    </div>
                </div>
            </div>
            <!-- SECOND CARD -->
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="subheader">All Users</div>
                            <div class="ms-auto lh-1">
                            </div>
                        </div>
                        <div class="d-flex align-items-baseline">
                            <div class="h1 mb-3 me-2">119</div>
                            <div class="me-auto">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Third Card -->
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="subheader">Partner User</div>
                            <div class="ms-auto lh-1">
                            </div>
                        </div>
                        <div class="d-flex align-items-baseline">
                            <div class="h1 mb-3 me-2">19</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- FOURTH CARD -->
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="subheader">Freelancer User</div>
                            <div class="ms-auto lh-1">

                            </div>
                        </div>
                        <div class="d-flex align-items-baseline">
                            <div class="h1 mb-3 me-2">100</div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- END OF CARDS -->
        
<br>

<div class="col-12">
                <div class="row row-cards">
                  <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                      <div class="card-body">
                        <div class="row align-items-center">
                          <div class="col-auto">
                            <span class="bg-instagram text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-instagram" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 4m0 4a4 4 0 0 1 4 -4h8a4 4 0 0 1 4 4v8a4 4 0 0 1 -4 4h-8a4 4 0 0 1 -4 -4z" /><path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M16.5 7.5l0 .01" /></svg>                            </span>
                          </div>
                          <div class="col">
                            <div class="font-weight-medium">
                              15 Followers
                            </div>
                            <div class="text-secondary">
                              18 Likes
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                      <div class="card-body">
                        <div class="row align-items-center">
                          <div class="col-auto">
                            <span class="bg-youtube text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-youtube-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 3a5 5 0 0 1 5 5v8a5 5 0 0 1 -5 5h-12a5 5 0 0 1 -5 -5v-8a5 5 0 0 1 5 -5zm-9 6v6a1 1 0 0 0 1.514 .857l5 -3a1 1 0 0 0 0 -1.714l-5 -3a1 1 0 0 0 -1.514 .857z" stroke-width="0" fill="currentColor" /></svg>                            </span>
                          </div>
                          <div class="col">
                            <div class="font-weight-medium">
                              6 Views
                            </div>
                            <div class="text-secondary">
                              1 Subscribed
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                      <div class="card-body">
                        <div class="row align-items-center">
                          <div class="col-auto">
                            <span class="bg-twitter text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M22 4.01c-1 .49 -1.98 .689 -3 .99c-1.121 -1.265 -2.783 -1.335 -4.38 -.737s-2.643 2.06 -2.62 3.737v1c-3.245 .083 -6.135 -1.395 -8 -4c0 0 -4.182 7.433 4 11c-1.872 1.247 -3.739 2.088 -6 2c3.308 1.803 6.913 2.423 10.034 1.517c3.58 -1.04 6.522 -3.723 7.651 -7.742a13.84 13.84 0 0 0 .497 -3.753c0 -.249 1.51 -2.772 1.818 -4.013z"></path></svg>
                            </span>
                          </div>
                          <div class="col">
                            <div class="font-weight-medium">
                              7 Followers
                            </div>
                            <div class="text-secondary">
                              Today
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                      <div class="card-body">
                        <div class="row align-items-center">
                          <div class="col-auto">
                            <span class="bg-facebook text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-facebook -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3"></path></svg>
                            </span>
                          </div>
                          <div class="col">
                            <div class="font-weight-medium">
                              35 Likes
                            </div>
                            <div class="text-secondary">
                               54 Followers
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

<br>
<!-- kevin -->
<div class="col-md-0 col-lg-0">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Social Media Traffic</h3>
                  </div>
                  <table class="table card-table table-vcenter">
                    <thead>
                      <tr>
                        <th>Network</th>
                        <th colspan="2">Visitors</th>
                      </tr>
                    </thead>
                    <tbody>
                        <td>Facebook</td>
                        <td>206</td>
                        <td class="w-50">
                          <div class="progress progress-xs">
                            <div class="progress-bar bg-primary" style="width: 12.72%"></div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Instagram</td>
                        <td>100</td>
                        <td class="w-50">
                          <div class="progress progress-xs">
                            <div class="progress-bar bg-primary" style="width: 7.08%"></div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Twitter</td>
                        <td>96</td>
                        <td class="w-50">
                          <div class="progress progress-xs">
                            <div class="progress-bar bg-primary" style="width: 5.07%"></div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Youtube</td>
                        <td>69</td>
                        <td class="w-50">
                          <div class="progress progress-xs">
                            <div class="progress-bar bg-primary" style="width: 2.6%"></div>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
<br>
              <div class="col-md-0 col-lg-0 ">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Tasks</h3>
                  </div>
                  <div class="table-responsive">
                    <table class="table card-table table-vcenter">
                      <tbody><tr>
                        <td class="w-1 pe-0">
                          <input type="checkbox" class="form-check-input m-0 align-middle" aria-label="Select task" checked="">
                        </td>
                        <td class="w-100">
                          <a href="#" class="text-reset">Extend the data model.</a>
                        </td>
                        <td class="text-nowrap text-secondary">
                          <!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z"></path><path d="M16 3v4"></path><path d="M8 3v4"></path><path d="M4 11h16"></path><path d="M11 15h1"></path><path d="M12 15v3"></path></svg>
                          August 05, 2021
                        </td>
                        <td class="text-nowrap">
                          <a href="#" class="text-secondary">
                            <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>
                            2/7
                          </a>
                        </td>
                        <td class="text-nowrap">
                          <a href="#" class="text-secondary">
                            <!-- Download SVG icon from http://tabler-icons.io/i/message -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M8 9h8"></path><path d="M8 13h6"></path><path d="M18 4a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-5l-5 3v-3h-2a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12z"></path></svg>
                            3</a>
                        </td>
                        <td>
                          <span class="avatar avatar-sm" style="background-image: url(./static/avatars/000m.jpg)"></span>
                        </td>
                      </tr>
                      <tr>
                        <td class="w-1 pe-0">
                          <input type="checkbox" class="form-check-input m-0 align-middle" aria-label="Select task">
                        </td>
                        <td class="w-100">
                          <a href="#" class="text-reset">Verify the event flow.</a>
                        </td>
                        <td class="text-nowrap text-secondary">
                          <!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z"></path><path d="M16 3v4"></path><path d="M8 3v4"></path><path d="M4 11h16"></path><path d="M11 15h1"></path><path d="M12 15v3"></path></svg>
                          January 01, 2019
                        </td>
                        <td class="text-nowrap">
                          <a href="#" class="text-secondary">
                            <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>
                            3/10
                          </a>
                        </td>
                        <td class="text-nowrap">
                          <a href="#" class="text-secondary">
                            <!-- Download SVG icon from http://tabler-icons.io/i/message -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M8 9h8"></path><path d="M8 13h6"></path><path d="M18 4a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-5l-5 3v-3h-2a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12z"></path></svg>
                            6</a>
                        </td>
                        <td>
                          <span class="avatar avatar-sm">JL</span>
                        </td>
                      </tr>
                      <tr>
                        <td class="w-1 pe-0">
                          <input type="checkbox" class="form-check-input m-0 align-middle" aria-label="Select task">
                        </td>
                        <td class="w-100">
                          <a href="#" class="text-reset">Database backup and maintenance</a>
                        </td>
                        <td class="text-nowrap text-secondary">
                          <!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z"></path><path d="M16 3v4"></path><path d="M8 3v4"></path><path d="M4 11h16"></path><path d="M11 15h1"></path><path d="M12 15v3"></path></svg>
                          December 28, 2018
                        </td>
                        <td class="text-nowrap">
                          <a href="#" class="text-secondary">
                            <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>
                            0/6
                          </a>
                        </td>
                        <td class="text-nowrap">
                          <a href="#" class="text-secondary">
                            <!-- Download SVG icon from http://tabler-icons.io/i/message -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M8 9h8"></path><path d="M8 13h6"></path><path d="M18 4a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-5l-5 3v-3h-2a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12z"></path></svg>
                            1</a>
                        </td>
                        <td>
                          <span class="avatar avatar-sm" style="background-image: url(./static/avatars/002m.jpg)"></span>
                        </td>
                      </tr>
                      <tr>
                        <td class="w-1 pe-0">
                          <input type="checkbox" class="form-check-input m-0 align-middle" aria-label="Select task" checked="">
                        </td>
                        <td class="w-100">
                          <a href="#" class="text-reset">Identify the implementation team.</a>
                        </td>
                        <td class="text-nowrap text-secondary">
                          <!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z"></path><path d="M16 3v4"></path><path d="M8 3v4"></path><path d="M4 11h16"></path><path d="M11 15h1"></path><path d="M12 15v3"></path></svg>
                          November 11, 2020
                        </td>
                        <td class="text-nowrap">
                          <a href="#" class="text-secondary">
                            <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>
                            6/10
                          </a>
                        </td>
                        <td class="text-nowrap">
                          <a href="#" class="text-secondary">
                            <!-- Download SVG icon from http://tabler-icons.io/i/message -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M8 9h8"></path><path d="M8 13h6"></path><path d="M18 4a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-5l-5 3v-3h-2a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12z"></path></svg>
                            12</a>
                        </td>
                        <td>
                          <span class="avatar avatar-sm" style="background-image: url(./static/avatars/003m.jpg)"></span>
                        </td>
                      </tr>
                      <tr>
                        <td class="w-1 pe-0">
                          <input type="checkbox" class="form-check-input m-0 align-middle" aria-label="Select task">
                        </td>
                        <td class="w-100">
                          <a href="#" class="text-reset">Define users and workflow</a>
                        </td>
                        <td class="text-nowrap text-secondary">
                          <!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z"></path><path d="M16 3v4"></path><path d="M8 3v4"></path><path d="M4 11h16"></path><path d="M11 15h1"></path><path d="M12 15v3"></path></svg>
                          November 14, 2021
                        </td>
                        <td class="text-nowrap">
                          <a href="#" class="text-secondary">
                            <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>
                            3/7
                          </a>
                        </td>
                        <td class="text-nowrap">
                          <a href="#" class="text-secondary">
                            <!-- Download SVG icon from http://tabler-icons.io/i/message -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M8 9h8"></path><path d="M8 13h6"></path><path d="M18 4a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-5l-5 3v-3h-2a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12z"></path></svg>
                            5</a>
                        </td>
                        <td>
                          <span class="avatar avatar-sm" style="background-image: url(./static/avatars/000f.jpg)"></span>
                        </td>
                      </tr>
                      <tr>
                        <td class="w-1 pe-0">
                          <input type="checkbox" class="form-check-input m-0 align-middle" aria-label="Select task" checked="">
                        </td>
                        <td class="w-100">
                          <a href="#" class="text-reset">Check Pull Requests</a>
                        </td>
                        <td class="text-nowrap text-secondary">
                          <!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z"></path><path d="M16 3v4"></path><path d="M8 3v4"></path><path d="M4 11h16"></path><path d="M11 15h1"></path><path d="M12 15v3"></path></svg>
                          February 11, 2021
                        </td>
                        <td class="text-nowrap">
                          <a href="#" class="text-secondary">
                            <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>
                            2/9
                          </a>
                        </td>
                        <td class="text-nowrap">
                          <a href="#" class="text-secondary">
                            <!-- Download SVG icon from http://tabler-icons.io/i/message -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M8 9h8"></path><path d="M8 13h6"></path><path d="M18 4a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-5l-5 3v-3h-2a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12z"></path></svg>
                            3</a>
                        </td>
                        <td>
                          <span class="avatar avatar-sm" style="background-image: url(./static/avatars/001f.jpg)"></span>
                        </td>
                      </tr>
                    </tbody></table>
                  </div>
                </div>
              </div>

<br>

              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Invoices</h3>
                  </div>
                  <div class="card-body border-bottom py-3">
                    <div class="d-flex">
                      <div class="text-secondary">
                        Show
                        <div class="mx-2 d-inline-block">
                          <input type="text" class="form-control form-control-sm" value="8" size="3" aria-label="Invoices count">
                        </div>
                        entries
                      </div>
                      <div class="ms-auto text-secondary">
                        Search:
                        <div class="ms-2 d-inline-block">
                          <input type="text" class="form-control form-control-sm" aria-label="Search invoice">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                      <thead>
                        <tr>
                          <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select all invoices"></th>
                          <th class="w-1">No. <!-- Download SVG icon from http://tabler-icons.io/i/chevron-up -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm icon-thick" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M6 15l6 -6l6 6"></path></svg>
                          </th>
                          <th>Invoice Subject</th>
                          <th>Client</th>
                          <th>VAT No.</th>
                          <th>Created</th>
                          <th>Status</th>
                          <th>Price</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                          <td><span class="text-secondary">001401</span></td>
                          <td><a href="invoice.html" class="text-reset" tabindex="-1">Design Works</a></td>
                          <td>
                            <span class="flag flag-xs flag-country-us me-2"></span>
                            Carlson Limited
                          </td>
                          <td>
                            87956621
                          </td>
                          <td>
                            15 Dec 2017
                          </td>
                          <td>
                            <span class="badge bg-success me-1"></span> Paid
                          </td>
                          <td>₱887</td>
                          <td class="text-end">
                            <span class="dropdown">
                              <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                              <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">
                                  Action
                                </a>
                                <a class="dropdown-item" href="#">
                                  Another action
                                </a>
                              </div>
                            </span>
                          </td>
                        </tr>
                        <tr>
                          <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                          <td><span class="text-secondary">001402</span></td>
                          <td><a href="invoice.html" class="text-reset" tabindex="-1">UX Wireframes</a></td>
                          <td>
                            <span class="flag flag-xs flag-country-gb me-2"></span>
                            Adobe
                          </td>
                          <td>
                            87956421
                          </td>
                          <td>
                            12 Apr 2017
                          </td>
                          <td>
                            <span class="badge bg-warning me-1"></span> Pending
                          </td>
                          <td>₱1200</td>
                          <td class="text-end">
                            <span class="dropdown">
                              <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                              <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">
                                  Action
                                </a>
                                <a class="dropdown-item" href="#">
                                  Another action
                                </a>
                              </div>
                            </span>
                          </td>
                        </tr>
                        <tr>
                          <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                          <td><span class="text-secondary">001403</span></td>
                          <td><a href="invoice.html" class="text-reset" tabindex="-1">New Dashboard</a></td>
                          <td>
                            <span class="flag flag-xs flag-country-de me-2"></span>
                            Bluewolf
                          </td>
                          <td>
                            87952621
                          </td>
                          <td>
                            23 Oct 2017
                          </td>
                          <td>
                            <span class="badge bg-warning me-1"></span> Pending
                          </td>
                          <td>₱534</td>
                          <td class="text-end">
                            <span class="dropdown">
                              <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                              <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">
                                  Action
                                </a>
                                <a class="dropdown-item" href="#">
                                  Another action
                                </a>
                              </div>
                            </span>
                          </td>
                        </tr>
                        <tr>
                          <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                          <td><span class="text-secondary">001404</span></td>
                          <td><a href="invoice.html" class="text-reset" tabindex="-1">Landing Page</a></td>
                          <td>
                            <span class="flag flag-xs flag-country-br me-2"></span>
                            Salesforce
                          </td>
                          <td>
                            87953421
                          </td>
                          <td>
                            2 Sep 2017
                          </td>
                          <td>
                            <span class="badge bg-secondary me-1"></span> Due in 2 Weeks
                          </td>
                          <td>₱1500</td>
                          <td class="text-end">
                            <span class="dropdown">
                              <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                              <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">
                                  Action
                                </a>
                                <a class="dropdown-item" href="#">
                                  Another action
                                </a>
                              </div>
                            </span>
                          </td>
                        </tr>
                        <tr>
                          <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                          <td><span class="text-secondary">001405</span></td>
                          <td><a href="invoice.html" class="text-reset" tabindex="-1">Marketing Templates</a></td>
                          <td>
                            <span class="flag flag-xs flag-country-pl me-2"></span>
                            Printic
                          </td>
                          <td>
                            87956621
                          </td>
                          <td>
                            29 Jan 2018
                          </td>
                          <td>
                            <span class="badge bg-danger me-1"></span> Paid Today
                          </td>
                          <td>₱648</td>
                          <td class="text-end">
                            <span class="dropdown">
                              <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                              <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">
                                  Action
                                </a>
                                <a class="dropdown-item" href="#">
                                  Another action
                                </a>
                              </div>
                            </span>
                          </td>
                        </tr>
                        <tr>
                          <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                          <td><span class="text-secondary">001406</span></td>
                          <td><a href="invoice.html" class="text-reset" tabindex="-1">Sales Presentation</a></td>
                          <td>
                            <span class="flag flag-xs flag-country-br me-2"></span>
                            Tabdaq
                          </td>
                          <td>
                            87956621
                          </td>
                          <td>
                            4 Feb 2018
                          </td>
                          <td>
                            <span class="badge bg-secondary me-1"></span> Due in 3 Weeks
                          </td>
                          <td>₱300</td>
                          <td class="text-end">
                            <span class="dropdown">
                              <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                              <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">
                                  Action
                                </a>
                                <a class="dropdown-item" href="#">
                                  Another action
                                </a>
                              </div>
                            </span>
                          </td>
                        </tr>
                        <tr>
                          <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                          <td><span class="text-secondary">001407</span></td>
                          <td><a href="invoice.html" class="text-reset" tabindex="-1">Logo &amp; Print</a></td>
                          <td>
                            <span class="flag flag-xs flag-country-us me-2"></span>
                            Apple
                          </td>
                          <td>
                            87956621
                          </td>
                          <td>
                            22 Mar 2018
                          </td>
                          <td>
                            <span class="badge bg-success me-1"></span> Paid Today
                          </td>
                          <td>₱2500</td>
                          <td class="text-end">
                            <span class="dropdown">
                              <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                              <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">
                                  Action
                                </a>
                                <a class="dropdown-item" href="#">
                                  Another action
                                </a>
                              </div>
                            </span>
                          </td>
                        </tr>
                        <tr>
                          <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                          <td><span class="text-secondary">001408</span></td>
                          <td><a href="invoice.html" class="text-reset" tabindex="-1">Icons</a></td>
                          <td>
                            <span class="flag flag-xs flag-country-pl me-2"></span>
                            Tookapic
                          </td>
                          <td>
                            87956621
                          </td>
                          <td>
                            13 May 2018
                          </td>
                          <td>
                            <span class="badge bg-success me-1"></span> Paid Today
                          </td>
                          <td>₱940</td>
                          <td class="text-end">
                            <span class="dropdown">
                              <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                              <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">
                                  Action
                                </a>
                                <a class="dropdown-item" href="#">
                                  Another action
                                </a>
                              </div>
                            </span>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="card-footer d-flex align-items-center">
                    <p class="m-0 text-secondary">Showing <span>1</span> to <span>8</span> of <span>16</span> entries</p>
                    <ul class="pagination m-0 ms-auto">
                      <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                          <!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M15 6l-6 6l6 6"></path></svg>
                          prev
                        </a>
                      </li>
                      <li class="page-item"><a class="page-link" href="#">1</a></li>
                      <li class="page-item active"><a class="page-link" href="#">2</a></li>
                      <li class="page-item"><a class="page-link" href="#">3</a></li>
                      <li class="page-item"><a class="page-link" href="#">4</a></li>
                      <li class="page-item"><a class="page-link" href="#">5</a></li>
                      <li class="page-item">
                        <a class="page-link" href="#">
                          next <!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 6l6 6l-6 6"></path></svg>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>

        <div class="col-md-0 col-lg-0">
            <div class="container-fluid">
                <div class="card">
                  <div class="card-header">

                    <div class="card-title">
                        <h4 class="mb-0">Teams </h4>
                    </div>    
                    </div><div class="table-responsive">
                        <table class="text-nowrap table">
                            <thead class="table-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>

                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <td class="align-middle">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <img src="/images/avatar/avatar-4.jpg" alt="" class="avatar-md avatar rounded-circle">
                                            </div>
                                            <div class="ms-3 lh-1">
                                                <h5 class=" mb-1">Jun Auamo</h5>
                                                <p class="mb-0">alamojgd@gmail.com</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">Principal</td>
                                    <td class="align-middle">
                                        <div class="dropdown">
                                            <a class="text-muted text-primary-hover" href="/">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="15px" height="15px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-muted">
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                    <td class="align-middle">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <img src="images/aron.png" alt="" class="avatar-md avatar rounded-circle">
                                            </div>
                                            <div class="ms-3 lh-1">
                                                <h5 class=" mb-1">Aaron Christian Delos Reyes</h5>
                                                <p class="mb-0">delosreyes.aaron@ncst.edu.ph</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">Project Director</td>
                                    <td class="align-middle">
                                        <div class="dropdown">
                                            <a class="text-muted text-primary-hover" href="/">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="15px" height="15px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-muted">
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <img src="images/kevin.jpg" alt="" class="avatar-md avatar rounded-circle">
                                            </div>
                                            <div class="ms-3 lh-1">
                                                <h5 class=" mb-1">John Kevin Golveo</h5>
                                                <p class="mb-0">golveo.johnkevin@ncst.edu.ph</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">Front End Developer</td>
                                    <td class="align-middle">
                                        <div class="dropdown">
                                            <a class="text-muted text-primary-hover" href="/">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="15px" height="15px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-muted">
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <img src="images/niel.jpg" alt="" class="avatar-md avatar rounded-circle">
                                            </div>
                                            <div class="ms-3 lh-1">
                                                <h5 class=" mb-1">Niel Adrian Lopez</h5>
                                                <p class="mb-0">lopez.nieladrian@ncst.edu.ph</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">Information Technology (IT) Programmer</td>
                                    <td class="align-middle">
                                        <div class="dropdown">
                                            <a class="text-muted text-primary-hover" href="/">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="15px" height="15px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-muted">
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <img src="images/jan.jpg" alt="" class="avatar-md avatar rounded-circle">
                                            </div>
                                            <div class="ms-3 lh-1">
                                                <h5 class=" mb-1">Jan Michael Nicerio</h5>
                                                <p class="mb-0">nicerio.janmichael@ncst.edu.ph</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">Information Technology (IT) Programmer</td>
                                    <td class="align-middle">
                                        <div class="dropdown">
                                            <a class="text-muted text-primary-hover" href="/">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="15px" height="15px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-muted">
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>


                  </div>
                </div>
            </div>       
        </div>

<!-- Kevin -->
</div>
</div>
<?php
    include('includes/admin_footer.php');
?>