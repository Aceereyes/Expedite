<?php
    include('includes/freelancer_header.php');

    if(isset($_POST['btnUpdate'])) {

        $storage = new \Upload\Storage\FileSystem('uploads');
        $file = new \Upload\File('avatar', $storage);
        $file->setName(uniqid());
        
        try {
            if($file->isUploadedFile()) {
                $file->upload();
                freelancer()->update(['avatar' => $file->getNameWithExtension()]);
            }

            freelancer()->update([
                'firstName' => $_POST['firstName'],
                'lastName' => $_POST['lastName'],
                'gender' => $_POST['gender'],
                'dateOfBirth' => $_POST['dateOfBirth'],
                'email' => $_POST['email'],
                'phone' => $_POST['phone'],
                'region_id' => $_POST['region'],
                'province_id' => $_POST['province'],
                'municipality_id' => $_POST['municipality'],
                'barangay_id' => $_POST['barangay'],
                'about' => $_POST['about'],
                'initialSetup' => 0,
                'skills' => $_POST['skills']
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
                            include('includes/freelancer_profile_sidebar.php');
?>
                        </div>
                    </div>
                    <form method="POST" class="col d-flex flex-column" enctype="multipart/form-data">
                        <div class="card-body pb-4">
                            <h2 class="mb-4">My Profile</h2>
                            
                            <div class="row align-items-center justify-content-center">
                                <span class="avatar avatar-xl" style="background-image: url('<?= freelancer()->getAvatar() ?>')"></span>
                            </div>

                            <h3 class="card-title mt-4">Skills</h3>
                            <div class="mb-3">
                                <div class="form-label">My Skills</div>
                                <input type="text" class="form-control" value="<?= freelancer()->skills ?>" id="skills" name="skills" required>
                            </div>

                            <h3 class="card-title mt-4">Personal Information</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div class="form-label">First Name</div>
                                        <input type="text" class="form-control" name="firstName" value="<?= freelancer()->firstName; ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div class="form-label">Last Name</div>
                                        <input type="text" class="form-control" name="lastName" value="<?= freelancer()->lastName; ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div class="form-label">Sex</div>
                                        <select class="form-select tom-select" name="gender" required>
<?php
                                            foreach(['Male', 'Female'] as $types) {
                                                $selected = ($types == freelancer()->gender) ? 'selected' : '';
                                                echo "<option value=\"$types\" $selected>$types</option>";
                                            }
?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div class="form-label">Date of Birth</div>
                                        <input type="date" class="form-control" name="dateOfBirth" value="<?= freelancer()->dateOfBirth; ?>" required>
                                    </div>
                                </div>
                            </div>

                            <h3 class="card-title mt-2">Address and Contact Info</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div class="form-label">Email Address</div>
                                        <input type="email" class="form-control" name="email" value="<?= freelancer()->email; ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div class="form-label">Phone</div>
                                        <input type="text" class="form-control" name="phone" value="<?= freelancer()->phone; ?>" required>
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
                                                $selected = ($region->id == freelancer()->region_id) ? 'selected' : '';
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
                                            if(freelancer()->province_id != null) {
                                                $provinces = \App\Models\Location\Province::where('region_id', freelancer()->region_id)->get();
                                                foreach($provinces as $province) {
                                                    $selected = ($province->id == freelancer()->province_id) ? 'selected' : '';
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
                                            if(freelancer()->municipality_id != null) {
                                                $municipalities = \App\Models\Location\Municipality::where('province_id', freelancer()->province_id)->get();
                                                foreach($municipalities as $municipality) {
                                                    $selected = ($municipality->id == freelancer()->municipality_id) ? 'selected' : '';
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
                                            if(freelancer()->barangay_id != null) {
                                                $barangays = \App\Models\Location\Barangay::where('municipality_id', freelancer()->municipality_id)->get();
                                                foreach($barangays as $barangay) {
                                                    $selected = ($barangay->id == freelancer()->barangay_id) ? 'selected' : '';
                                                    echo "<option value=\"$barangay->id\" $selected>$barangay->name</option>";
                                                }
                                            }
?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="form-label">Avatar</div>
                                <input type="file" class="form-control" name="avatar" accept=".png, .jpg, .jpeg" name="avatar">
                            </div>

                            <div class="mb-3">
                                <div class="form-label">About Me</div>
                                <textarea name="about" id="about"><?= freelancer()->about; ?></textarea>
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
    <script src="<?= plugins('tom-select/dist/js/tom-select.complete.min.js')?>"></script>
    <script src="<?= plugins('tinymce/tinymce.min.js'); ?>"></script>
    <script>
        $(document).ready(function () {
            $('#skills').each((key, element)=> {
                var jsonData = [
<?php
                    foreach(config('app.partner.skills') as $keys) {
                        foreach($keys as $skills) {
                            echo json_encode(['value' => $skills, 'text' => $skills]).',';
                        }
                    }
?>
                ];
                new TomSelect(element, {
                    plugins: ['no_backspace_delete','remove_button', 'checkbox_options'],
                    persist: false,
                    createOnBlur: false,
                    create: true,
                    options: jsonData
                });
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            //Select
            $('.tom-select').each((key, element)=> {
                new TomSelect(element);
            });

            //About
            let options = {
                selector: '#about',
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
    include('includes/freelancer_footer.php');
?>