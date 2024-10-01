<?php
    include('includes/guest_header.php');
?>

    <div class="page-body">
        <div class="container rounded">
            <div class="row">
                <div class="col-lg-12 rounde">
                    <div class="card mb-3 rounded" style="width: 100%; position: relative;">
                        <img src="<?= images('banner.gif') ?>" alt="Sample Image" class="img-fluid rounded">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <div class="card mb-3" style="width: auto; height: auto; background: linear-gradient(to bottom right, rgba(81,163,226,0.7), rgba(214,220,225,0.7)); border-radius: 10px; margin: 10px; text-align: center;">
                        <div class="card-body">
                        <img src="<?= images('fb.png'); ?>" alt="Facebook QR" style="display: block; margin: 0 auto; width: 100%; height: 100%; object-fit: cover;">
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card mb-3" style="width: auto; height: auto; background: linear-gradient(to bottom right, rgba(81,163,226,0.7), rgba(214,220,225,0.7)); border-radius: 10px; margin: 10px; text-align: center;">
                        <div class="card-body" >
                        <img src="<?= images('insta.png'); ?>" alt="Instagram QR" style="display: block; margin: 0 auto; width: 100%; height: 100%; object-fit: cover;">
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card mb-3" style="width: auto; height: auto; background: linear-gradient(to bottom right, rgba(81,163,226,0.7), rgba(214,220,225,0.7)); border-radius: 10px; margin: 10px; text-align: center;">
                        <div class="card-body">
                        <img src="<?= images('twitter.png'); ?>" alt="Twitter QR" style="display: block; margin: 0 auto; width: 100%; height: 100%; object-fit: cover;">
                        </div>
                    </div>
                </div>
            </div>

            <!-- INSURING -->

            <section class="bg-half-170 bg-light pb-0 d-table w-100" style="background: url('assets/images/future 2.png') center center;">
            <div class="container">
                <div class="row mt-5 align-items-center">
                    <div class="col-lg-7 col-md-6">
                        <div class="title-heading">
                        <h4 class="display-3 mb-4 fw-bold title-dark text-center"> Insuring Your Future <br> From Today </h4>
                        <p class="para-desc text-muted text-center">From banking to wealth management and securities distribution, we dedicated financial services the teams serve all major sectors.</p>
                            <div class="mt-4 pt-2 text-center pb-3"> <!-- Added pb-3 class for bottom padding -->
                                <a href="join_us.php" class="btn btn-lg btn-pills btn-primary">Work with us</a>
                            </div>
                        </div>
                    </div><!--end col-->

                    <div class="col-lg-5 col-md-6 mt-5 mt-sm-0">
                        <img src="images/corporate01.png" class="img-fluid" alt="">
                    </div>
                </div><!--end row-->
            </div> <!--end container-->
            </section>

            <!-- INSURING END -->

            <!-- EXPLORE -->

            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="card mb-3">
                        <div class="row">
                            <div class="col-lg-7">
                                <img src="<?= images('bg1.png'); ?>" alt="Sample Image" class="img-fluid">
                            </div>
                            <div class="col-lg-5 d-flex align-items-center justify-content-center" style="background-image: url('assets/images/magnify.png'); background-size: cover; background-position: center;">
                                <div class="card-body">
                                    <div class="card-title display-4 h1" style="font-size: 36px; color: #333;">Explore</div>
                                    <div class="card-subtitle mb-2 text-muted h2" style="font-size: 24px; color: #666;">Step 1</div>
                                    <div class="card-text lead h2" style="font-size: 20px; color: #666;">Discover diverse opportunities for freelancers and job partners.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- EXAMINE -->

            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="card mb-3">
                        <div class="row">
                            <div class="col-lg-7">
                                <img src="<?= images('bg2.png'); ?>" alt="Sample Image" class="img-fluid">
                            </div>
                            <div class="col-lg-5 d-flex align-items-center justify-content-center" style="background-image: url('assets/images/exam.png'); background-size: cover; background-position: center;">
                                <div class="card-body text-right"> <!-- Added text-right class to align the text to the right -->
                                    <div class="card-title display-4 h1" style="font-size: 36px; color: #333;">Examine</div>
                                    <div class="card-subtitle mb-2 text-muted h2" style="font-size: 24px; color: #666;">Step 2</div>
                                    <div class="card-text lead h2" style="font-size: 20px; color: #666;">Thoroughly evaluate candidates to make informed hiring decisions.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            

            <!-- EXPERIENCE -->

            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="card mb-3">
                        <div class="row">
                            <div class="col-lg-7">
                                <img src="<?= images('bg3.png'); ?>" alt="Sample Image" class="img-fluid">
                            </div>
                            <div class="col-lg-5 d-flex align-items-center justify-content-center" style="background-image: url('assets/images/coins.png'); background-size: cover; background-position: center;">
                                <div class="card-body">
                                <div class="card-title display-4 h1" style="font-size: 36px; color: #333;">Experience</div>
                                <div class="card-subtitle mb-2 text-muted h2" style="font-size: 24px; color: #666;">Step 3</div>
                                <div class="card-text lead h2" style="font-size: 20px; color: #666;">Create a seamless job experience, fostering successful collaborations.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php
    include('includes/guest_footer.php');
?>