<?php
    include('includes/partner_header.php');
    
    
    // Validator
    if(isset($_POST['btnAddJob'])) {
        $validator = new App\Validation\Factory;
        $validation = $validator->validate($_POST, [
            'title:Title'                                          => 'required',
            'amount'                                               => 'required|min:1',
            'category'                                             => 'required',
            // 'closingDate:Closing Date'                             => 'required|before:'.\Carbon\Carbon::parse($_POST['deadline'])->addDay()->format('Y-m-d'),
            // 'deadline:Deadline'                                    => 'required',
            // 'experience:Experience'                                => 'required',
            // 'description:Description'                              => 'required',
            // 'responsibilities:Responsibilities'                    => 'required',
            // 'instructions:Instructions'                            => 'required',
            'skills:Skills'                                            => 'required'
        ]);
        if($validation->fails()) {
            setFlashMessage('error', 'Registration Error',
                [ 'html' => sprintf("'%s'", implode('<br/>', $validation->errors()->all())) ],
                [ 'timer' => '6000' ]
            );
            refresh();
        } else {
            $job = \App\Models\Job::create([
                'partner_id' => partner()->id,
                'title' => $_POST['title'],
                'amount' => $_POST['amount'],
                'category' => $_POST['category'],
                'closingDate' => $_POST['closingDate'],
                'deadline' => $_POST['deadline'],
                'experience' => $_POST['experience'],
                'description' => $_POST['description'],
                'responsibilities' => $_POST['responsibilities'],
                'instructions' => $_POST['instructions'],
                'active' => true,
                'skills' => is_array($_POST['skills']) ? implode(',', $_POST['skills']) : $_POST['skills'],
                'minAge' => $_POST['minAge'],
                'maxAge' => $_POST['maxAge'],
                'language' => is_array($_POST['language']) ? implode(',', $_POST['language']) : $_POST['language'],
                'sex' => is_array($_POST['sex']) ? implode(',', $_POST['sex']) : $_POST['sex'],
            ]);
            setFlashMessage('success', 'Job Added Succesfully!');
            redirect('partner_jobs.php');
        }
        exit();
    }
    // Validator End

?>
<div class="page-body">
    <div class="container">
        <div class="row g-2 align-items-center mb-3">
            <div class="col">
                <h2 class="page-title">
                    Add Job
                </h2>
            </div>
            <div class="col-auto ms-auto">
                <div class="btn-list">
                    <span class="d-sm-inline">
                        <a href="<?= base_url('partner_jobs.php'); ?>" class="btn"><i class="ti ti-arrow-back"></i> Back</a>
                    </span>
                </div>
            </div>
        </div>
        <form class="card" method="POST">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
                    <li class="nav-item">
                        <a href="#tabs-job-info" class="nav-link active" data-bs-toggle="tab">Information</a>
                    </li>
                    <li class="nav-item">
                        <a href="#tabs-job-description" class="nav-link" data-bs-toggle="tab">Description</a>
                    </li>
                    <li class="nav-item">
                        <a href="#tabs-job-task" class="nav-link" data-bs-toggle="tab">Task</a>
                    </li>
                    <li class="nav-item">
                        <a href="#tabs-job-requirements" class="nav-link" data-bs-toggle="tab">Requirements</a>
                    </li>
                    <li class="nav-item">
                        <a href="#tabs-job-submission" class="nav-link" data-bs-toggle="tab">Submit</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <!-- Information -->
                    <div class="tab-pane active show" id="tabs-job-info">
                        <div class="row">
                            <div class="col-sm-9">
                                <div class="mb-3">
                                    <div class="form-label">Job Title</div>
                                    <input type="text" class="form-control" name="title" required>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group mb-3">
                                    <div class="form-label">Amount</div>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            PHP
                                        </span>
                                        <input type="number" class="form-control" step="0.01" min="0" name="amount" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <div class="form-label">Category</div>
                                    <select class="form-select" id="category" name="category" required>
<?php
                                        foreach(config('app.partner.skills') as $category => $skills) {
                                            echo "<option value=\"$category\">$category</option>";
                                        }
?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <div class="form-label">Job Posting Closing Date</div>
                                    <input type="date" class="form-control" value="<?= date('Y-m-d'); ?>" name="closingDate" required>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <div class="form-label">Experience</div>
                                    <select class="form-select tom-select" name="experience" required>
<?php
                                        foreach(config('freelancer.experience_levels') as $types) {
                                            echo "<option value=\"$types\">$types</option>";
                                        }
?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="text-center my-4">
                            <button type="button" class="btn btn-primary mt-3 mx-3 px-5 next-tab-button">Next</button>
                        </div>
                    </div>
                    <!-- Description -->
                    <div class="tab-pane" id="tabs-job-description">
                        <div class="mb-3">
                            <div class="form-label">Job Description</div>
                            <textarea name="description" id="description" class="tinyMCE"></textarea>
                        </div>
                        <div class="mb-3">
                            <div class="form-label">Job Responsibilities</div>
                            <textarea name="responsibilities" id="responsibilities" class="tinyMCE"></textarea>
                        </div>
                        <div class="text-center my-4">
                            <button type="button" class="btn btn-secondary mt-3 mx-3 px-5 previous-tab-button">Previous</button>
                            <button type="button" class="btn btn-primary mt-3 px-5 next-tab-button">Next</button>
                        </div>
                    </div>
                    <!-- Description -->
                    <div class="tab-pane" id="tabs-job-task">
                        <div class="mb-3">
                            <div class="form-label">Task Open until</div>
                            <input type="date" class="form-control" value="<?= date('Y-m-d'); ?>" name="deadline" required>
                        </div>
                        <div class="mb-3">
                            <div class="form-label">Instructions for freelancers</div>
                            <textarea name="instructions" id="instructions" class="tinyMCE"></textarea>
                        </div>
                        <div class="text-center my-4">
                            <button type="button" class="btn btn-secondary mt-3 mx-3 px-5 previous-tab-button">Previous</button>
                            <button type="button" class="btn btn-primary mt-3 px-5 next-tab-button">Next</button>
                        </div>
                    </div>
                    <!-- Requirements -->
                    <div class="tab-pane" id="tabs-job-requirements">
                        <div class="mb-3">
                            <div class="form-label">Skills</div>
                            <input type="text" class="form-control" id="skills" name="skills">
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <div class="form-label">Minimum Age</div>
                                    <select name="minAge" id="minAge" class="form-select tom-select" required>
<?php
                                        for($i = 18; $i <= 100; $i++) {
                                            echo "<option value=\"$i\">$i</option>";
                                        }
?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <div class="form-label">Maximum Age</div>
                                    <select name="maxAge" id="maxAge" class="form-select tom-select" required>
<?php
                                        for($i = 18; $i <= 100; $i++) {
                                            echo "<option value=\"$i\">$i</option>";
                                        }
?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <div class="form-label">Language</div>
                                    <select name="language[]" id="language" class="form-select tom-select" required multiple>
<?php
                                        foreach(config('languages') as $i) {
                                            echo "<option value=\"$i\">$i</option>";
                                        }
?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <div class="form-label">Sex</div>
                                    <select name="sex[]" id="sex" class="form-select tom-select" required multiple>
<?php
                                         foreach(['Male', 'Female'] as $i) {
                                             echo "<option value=\"$i\">$i</option>";
                                         }
?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="text-center my-4">
                            <button type="button" class="btn btn-secondary mt-3 mx-3 px-5 previous-tab-button">Previous</button>
                            <button type="button" class="btn btn-primary mt-3 px-5 next-tab-button">Next</button>
                        </div>
                    </div>
                    <!-- Submit -->
                    <div class="tab-pane" id="tabs-job-submission">
                        <div class="alert-alert-info">
                            <p>By submitting this form, you acknowledge that the information provided is accurate and true to the best of your knowledge, in accordance with the terms and conditions of using Expedite.</p>
                            <p>Maintaining a fair and transparent hiring process is essential to ensure the trust and credibility of our platform for both freelancers and partners. We strongly discourage any unethical or dishonest behavior.</p>
                            <p>We appreciate your understanding and cooperation in adhering to these principles, as they contribute to the overall integrity and professionalism of our freelance job marketplace.</p>
                        </div>
                        <div class="text-center my-3">
                            <button type="button" class="btn btn-secondary mt-3 mx-3 px-5 previous-tab-button">Back</button>
                            <button type="submit" name="btnAddJob" class="btn btn-primary mt-3 px-5">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    var nextTabButtons = document.getElementsByClassName('next-tab-button');
    var previousTabButtons = document.getElementsByClassName('previous-tab-button');

    for(let i = 0; i < nextTabButtons.length; i++) {
        nextTabButtons[i].addEventListener('click', function () {
            const tabs = document.querySelectorAll('.nav-link');
            const activeTab = document.querySelector('.nav-link.active');
            const activeTabIndex = Array.from(tabs).indexOf(activeTab);

            // Activate the next tab
            const nextTabIndex = (activeTabIndex + 1) % tabs.length;
            tabs[nextTabIndex].click();
        });
    }
    for(let i = 0; i < previousTabButtons.length; i++) {
        previousTabButtons[i].addEventListener('click', function () {
            const tabs = document.querySelectorAll('.nav-link');
            const activeTab = document.querySelector('.nav-link.active');
            const activeTabIndex = Array.from(tabs).indexOf(activeTab);

            // Activate the next tab
            const nextTabIndex = (activeTabIndex - 1) % tabs.length;
            tabs[nextTabIndex].click();
        });
    }
</script>
<script src="<?= plugins('tom-select/dist/js/tom-select.complete.min.js')?>"></script>
<script src="<?= plugins('tinymce/tinymce.min.js'); ?>"></script>
<script>
    var category, skills, jsonData;
    $(document).ready(function () {
<?php
        $data = [];
        foreach(config('app.partner.skills') as $name => $skills) {
            foreach($skills as $skill) {
                $data[$name][] = ['value' => $skill, 'text' => $skill];
            }
        }
?>
        skills = new TomSelect('#skills', {
            plugins: ['no_backspace_delete','remove_button', 'checkbox_options'],
            persist: false,
            createOnBlur: false,
            create: false,
            // options: <?= isset($_GET['category']) ? json_encode($data[$_GET['category'][0]]) : '[]'; ?>,
            // items: [
            //     <?= isset($_GET['skills']) ? "'".implode("', '", explode(',', $_GET['skills']) )."'" : null ?>
            // ]
        });

        jsonData = <?= json_encode($data); ?>;
        category = new TomSelect('#category');
        category.on('change', function(value) {
            skills.clear();
            skills.clearOptions();
            for(var i = 0; i < jsonData[value].length; i++) {
                skills.addOption(jsonData[value]);
            }
        });

        $('.tom-select').each((key, element) => {
            new TomSelect(element);
        });

        let options = {
            selector: '.tinyMCE',
            height: 300,
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
<!-- Add this JavaScript code after the form -->
<?php
    include('includes/partner_footer.php');
?>