<?php
    include('includes/guest_header.php');
?>
<style>
.card-no-border {
    border:none
}
.card-img-top {
    width: auto;
    height: auto;
    margin: 10px;
    border-radius: 8px;
}
</style>

<div class="page-body">
    <div class="container">
        <div class="page-title mb-3">
            About Us
        </div>
    </div>
    
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
            <div class="card mb-3 card-no-border" style="background: linear-gradient(to right, #F1F5F9, #87C0D8)">
                <div class="row">
                <div class="col-lg-6">
                    <img src="<?= images('mission.png'); ?>" alt="Sample Image" class="card-img-top ms-3" style="margin: 20px;">
                </div>
                <div class="col-lg-6 d-flex align-items-center justify-content-center">
                    <div class="card-body text-center">
                    <h1 class="card-title display-4 mb-3 me-5" style="font-size: 3rem;">Mission</h1>
                    <p class="card-text lead mt-4 me-5" style="font-size: 1rem;">Expedite's objective is to transform the freelancing sector by offering a simplified and accelerated platform that links businesses with highly experienced freelancers. We want to remove the hurdles that prevent efficient cooperation and provide freelancers the tools they need to perform their services swiftly and seamlessly. Through a hassle-free freelance experience, we hope to increase productivity, minimize project turnaround time, and assure customer satisfaction.</p>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mt-3 mb-3">
            <div class="col-lg-12">
            <div class="card mb-3 card-no-border" style="background: linear-gradient(to right, #87C0D8, #F1F5F9)">
                <div class="row">
                <div class="col-lg-6">
                    <img src="<?= images('vision.png'); ?>" alt="Sample Image" class="card-img-top ms-3" style="margin: 20px;">
                </div>
                <div class="col-lg-6 d-flex align-items-center justify-content-center">
                    <div class="card-body text-center">
                    <h1 class="card-title display-4 mb-3 me-5" style="font-size: 3rem;">Vision</h1>
                    <p class="card-text lead mt-4 me-5" style="font-size: 1rem;">Our vision is to be the leading platform for accelerated freelancing services, known for our dedication to speed, quality, and customer satisfaction. We foresee a future in which organizations can readily access top-tier freelancing talent, shorten project schedules, and achieve their objectives more quickly than ever before. We try to be a trusted partner for organizations looking for quick solutions, as well as to provide freelancers with the tools and resources they need to flourish in a fast-paced, results-driven workplace. We aspire to revolutionize the freelancing environment and impact the future of work through cutting-edge technology and a devoted community.</p>
                    </div></p>
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