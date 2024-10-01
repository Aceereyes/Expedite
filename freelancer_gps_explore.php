<?php
    include('includes/freelancer_header.php');
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
                            <select class="form-select" id="partnerList">
                                <option value="">Select Partner</option>
                                <?php
                                $partners = [];
                                if (isset($_GET['id'])) {
                                    $partner = \App\Models\Partner::where('id', $_GET['id'])->first();
                                    if ($partner) {
                                        $partners[] = $partner;
                                    }
                                } else {
                                    $partners = \App\Models\Partner::all();
                                }

                                foreach ($partners as $partner) {
                                    echo "<option value=\"{$partner->id}\"" . (isset($_GET['id']) && $_GET['id'] == $partner->id ? " selected" : "") . ">{$partner->fullName()}</option>";
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
    include('includes/freelancer_footer.php');
?>