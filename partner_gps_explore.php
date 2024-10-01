<?php
    include('includes/partner_header.php');
    
?>
<div class="page-body">
    <div class="container">
        <div class="row g-2 align-items-center mb-3">
            <div class="col">
                <h2 class="page-title">
                    GPS
                </h2>
            </div>
            <div class="col-auto ms-auto">
                <div class="btn-list">
                    <span class="d-sm-inline">
                        <a href="<?= base_url("partner_dashboard.php"); ?>" class="btn"><i class="ti ti-arrow-left"></i> Back</a>
                    </span>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div id="map" style="height: 500px;"></div>
            </div>
        </div>

        <div class="card">
            <div class="col-md-6">
            
            </div>
        </div>

        <div class="row" style="padding-top: 20px;">
            <div class="col-md-6">
                <div class="card">
                <div class="card-body">
                    <div class="form-group">
                    <button class="btn btn-primary" id="searchLocationBtn">Search Location</button>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                <div class="card-body">
                    <div class="form-group">
                    <select class="form-select" id="freelancerList">
                        <option value="">Select Freelancer</option>
                        <?php
                                    if(isset($_GET['id'])) {
                                        $freelancer = \App\Models\Freelancer::where('id', $_GET['id'])->first();
                                    }

                                    $freelancers = \App\Models\Freelancer::all();

                                    foreach($freelancers as $freelancer) {
                                        echo "<option value=\"{$freelancer->id}\">{$freelancer->fullName()}</option>";

                                        if(isset($_GET['id']) && $_GET['id'] == $freelancer->id) {
                                            echo "<option value=\"{$freelancer->id}\" selected>{$freelancer->fullName()}</option>";
                                        }
                                    }
                        ?>
                    </select>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
    include('includes/partner_footer.php');
?>