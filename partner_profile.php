<?php
    include('includes/partner_header.php');

    if(isset($_POST['btnUpdate'])) {
        $storage = new \Upload\Storage\FileSystem('uploads');
        $file = new \Upload\File('logo', $storage);
        $file->setName(uniqid());
        
        try {
            if($file->isUploadedFile()) {
                $file->upload();
                partner()->update(['logo' => $file->getNameWithExtension()]);
            }

            partner()->update([
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'type' => $_POST['type'],
                'established' => $_POST['established'],
                'employeeCount' => $_POST['employeeCount'],
                'website' => $_POST['website'],
                'region_id' => $_POST['region'],
                'province_id' => $_POST['province'],
                'municipality_id' => $_POST['municipality'],
                'barangay_id' => $_POST['barangay'],
                'background' => $_POST['background'],
                'services' => $_POST['services'],
                'expertise' => $_POST['expertise'],
                'initialSetup' => false
            ]);
            setFlashMessage('success', "Profile has been updated successfully!");
        } catch (\Exception $e) {
            setFlashMessage('error', "File upload error!");
        }
        refresh();
        exit();
    }
?>
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="row g-0">
                    <div class="col-3 d-md-block border-end">
                        <div class="card-body">
<?php
                            include('includes/partner_profile_sidebar.php');
?>
                        </div>
                    </div>
                    <form method="POST" class="col d-flex flex-column" enctype="multipart/form-data">
                        <div class="card-body pb-4">
                            <h2 class="mb-4">My Profile</h2>
                            
                            <div class="row align-items-center justify-content-center">
                                <span class="avatar avatar-xl" style="background-image: url('<?= partner()->getLogo() ?>')"></span>
                            </div>

                            <h3 class="card-title mt-4">Partner Information</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div class="form-label">Name</div>
                                        <input type="text" class="form-control" name="name" value="<?= partner()->name; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Partner Type</label>
                                        <select class="form-select tom-select" name="type" required>
<?php
                                            foreach(config('app.partner.skills') as $types => $skills) {
                                                $selected = (partner()->type == $types) ? 'selected' : '';
                                                echo "<option value=\"$types\" $selected>$types</option>";
                                            }
?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div class="form-label">Date Established</div>
                                        <input type="date" class="form-control" name="established" value="<?= partner()->established; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div class="form-label">Employee Count</div>
                                        <select class="form-select tom-select" name="employeeCount" required>
<?php
                                            foreach(['1-10', '11-100', '200+', '300+', '1000+'] as $types) {
                                                $selected = (partner()->employeeCount == $types) ? 'selected' : '';
                                                echo "<option value=\"$types\" $selected>$types</option>";
                                            }
?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <h3 class="card-title mt-2">Address and Contact Info</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div class="form-label">Email Address</div>
                                        <input type="email" class="form-control" name="email" value="<?= partner()->email; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div class="form-label">Website</div>
                                        <input type="email" class="form-control" name="website" value="<?= partner()->email; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <div class="form-label">Region</div>
                                        <select class="form-select" id="region" name="region" required>
<?php
                                            $regions = \App\Models\Location\Region::all();
                                            foreach($regions as $region) {
                                                $selected = ($region->id == partner()->region_id) ? 'selected' : '';
                                                echo "<option value=\"$region->id\" $selected>$region->name</option>";
                                            }
?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <div class="form-label">Province</div>
                                        <select class="form-select" id="province" name="province" required>
<?php
                                            if(partner()->province_id != null) {
                                                $provinces = \App\Models\Location\Province::where('region_id', partner()->region_id)->get();
                                                foreach($provinces as $province) {
                                                    $selected = ($province->id == partner()->province_id) ? 'selected' : '';
                                                    echo "<option value=\"$province->id\" $selected>$province->name</option>";
                                                }
                                            }
?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <div class="form-label">City/Municipality</div>
                                        <select class="form-select" id="municipality" name="municipality" required>
<?php
                                            if(partner()->municipality_id != null) {
                                                $municipalities = \App\Models\Location\Municipality::where('province_id', partner()->province_id)->get();
                                                foreach($municipalities as $municipality) {
                                                    $selected = ($municipality->id == partner()->municipality_id) ? 'selected' : '';
                                                    echo "<option value=\"$municipality->id\" $selected>$municipality->name</option>";
                                                }
                                            }
?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <div class="form-label">Barangay</div>
                                        <select class="form-select" id="barangay" name="barangay" required>
<?php
                                            if(partner()->barangay_id != null) {
                                                $barangays = \App\Models\Location\Barangay::where('municipality_id', partner()->municipality_id)->get();
                                                foreach($barangays as $barangay) {
                                                    $selected = ($barangay->id == partner()->barangay_id) ? 'selected' : '';
                                                    echo "<option value=\"$barangay->id\" $selected>$barangay->name</option>";
                                                }
                                            }
?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-label">Logo</div>
                                <input type="file" class="form-control" name="logo" accept=".png, .jpg, .jpeg" name="logo">
                            </div>
                            <div class="mb-3">
                                <div class="form-label">Partner background</div>
                                <textarea name="background" id="background" class="tinyMCE"><?= partner()->background; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <div class="form-label">Partner services</div>
                                <textarea name="services" id="services" class="tinyMCE"><?= partner()->services; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <div class="form-label">Partner expertise</div>
                                <textarea name="expertise" id="expertise" class="tinyMCE"><?= partner()->expertise; ?></textarea>
                            </div>

                        </div>
                        <div class="card-footer bg-transparent mt-auto">
                            <div class="btn-list justify-content-center">
                                <button type="submit" name="btnUpdate" class="btn btn-primary px-5">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= plugins('tom-select/dist/js/tom-select.base.min.js')?>"></script>
    <script src="<?= plugins('tinymce/tinymce.min.js'); ?>"></script>
    <script>
        $(document).ready(function () {
            $('.tom-select').each((key, element)=> {
                new TomSelect(element);
            });

            let options = {
                selector: '.tinyMCE',
                height: 200,
                menubar: 'insert | format',
                promotion: false,
                statusbar: false,
                readonly: false,
                plugins: 'image',
                toolbar: 'undo redo | formatselect | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat',
                content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; font-size: 14px; -webkit-font-smoothing: antialiased; }'
            }
            if (localStorage.getItem("tablerTheme") === 'dark') {
                options.skin = 'oxide-dark';
                options.content_css = 'dark';
            }
            tinyMCE.init(options);
        });
    </script>
    <script>
        var region = new TomSelect('#region');
        var province = new TomSelect('#province');
        var municipality = new TomSelect('#municipality');
        var barangay = new TomSelect('#barangay');

        function getProvinces() {
            $.ajax({
                type: "POST",
                url: "ajax.php?node=location&action=getProvince",
                data: {
                    region_id: $('#region').val()
                },
                success: function(data) {
                    var provinces = JSON.parse(data);
                    province.addOptions(provinces);
                    
                }
            });
        }
        function getMunicipalities() {
            $.ajax({
                type: "POST",
                url: "ajax.php?node=location&action=getMunicipality",
                data: {
                    province_id: $('#province').val()
                },
                success: function(data) {
                    var municipalities = JSON.parse(data);
                    municipality.addOptions(municipalities);
                    
                }
            });
        }
        function getBarangays() {
            $.ajax({
                type: "POST",
                url: "ajax.php?node=location&action=getBarangay",
                data: {
                    municipality_id: $('#municipality').val()
                },
                success: function(data) {
                    var barangays = JSON.parse(data);
                    barangay.addOptions(barangays);
                }
            });
        }
        region.on('change', function(value) {
            province.clearOptions();
            municipality.clearOptions();
            barangay.clearOptions();

            province.clear();
            municipality.clear();
            barangay.clear();

            getProvinces();
        });
        province.on('change', function(value) {
            municipality.clearOptions();
            barangay.clearOptions();

            municipality.clear();
            barangay.clear();
            
            getMunicipalities();
        });
        municipality.on('change', function(value) {
            barangay.clear();
            barangay.clearOptions();

            getBarangays();
        });
    </script>
<?php
    include('includes/partner_footer.php');
?>