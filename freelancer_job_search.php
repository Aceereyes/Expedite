<?php
    include('includes/freelancer_header.php');
?>
<div class="page-body">
    <div class="container">
<?php
        $jobs_posted = \App\Models\Job::all();
        if($jobs_posted->count() > 0) {
?>
            <div class="row g-4">
                <form class="col-md-3">
                    <h2>Search</h2>
                    <div class="mb-3">
                        <div class="form-label">Category</div>
                        <select class="form-select" id="category" name="category[]" hidden>
                            <option value="" selected hidden>Select Category</option>
<?php
                            foreach(config('app.partner.skills') as $category => $skills) {
                                $selected = isset($_GET['category']) && in_array($category, $_GET['category']) ? 'selected' : '';
                                echo "<option value=\"$category\" $selected>$category</option>";
                            }
?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <div class="form-label">Skills</div>
                        <input type="text" class="form-control" id="skills" value="<?= $_GET['skills'] ?? '' ?>" name="skills">
                    </div>
                    <div class="mb-3">
                        <div class="form-label">Experience Level</div>
                        <select class="form-select form-select-multiple" name="experience[]" multiple>
<?php
                            foreach(config('freelancer.experience_levels') as $types) {
                                $selected = isset($_GET['experience']) && in_array($types, $_GET['experience']) ? 'selected' : '';
                                echo "<option value=\"$types\" $selected>$types</option>";
                            }
?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <div class="form-label">Price</div>
                        <select class="form-select form-select-single" name="price">
                            <option value="" selected hidden>Select Price</option>
<?php
                            foreach(config('price.ranges') as $range => $names) {
                                $selected = isset($_GET['price']) && $_GET['price'] == $range ? 'selected' : '';
                                echo "<option value=\"$range\" $selected>$names</option>";
                            }
?>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <div class="form-label">Minimum Age</div>
                                <select name="minAge" id="minAge" class="form-select tom-select" required>
<?php
                                    for($i = 18; $i <= 100; $i++) {
                                        $selected = ($i == $_GET['minAge']) ? 'selected' : '';
                                        echo "<option value=\"$i\" $selected>$i</option>";
                                    }
?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <div class="form-label">Maximum Age</div>
                                <select name="maxAge" id="maxAge" class="form-select tom-select" required>
<?php
                                    for($i = 18; $i <= 100; $i++) {
                                        $selected = ($i == $_GET['maxAge']) ? 'selected' : '';
                                        echo "<option value=\"$i\" $selected>$i</option>";
                                    }
?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-label">Languages</div>
                        <select class="form-select form-select-multiple" name="languages[]" multiple>
<?php
                            foreach(config('languages') as $lang) {
                                $selected = isset($_GET['languages']) && in_array($lang, $_GET['languages']) ? 'selected' : '';
                                echo "<option value=\"$lang\" $selected>$lang</option>";
                            }
?>
                        </select>
                    </div>
                    <!-- <div class="mb-3">
                        <div class="form-label">Sex</div>
                        <select class="form-select form-select-multiple" name="sex[]" multiple>
<?php
                            foreach(['Female', 'Male'] as $sex) {
                                $selected = isset($_GET['sex']) && in_array($sex, $_GET['sex']) ? 'selected' : '';
                                echo "<option value=\"$sex\" $selected>$sex</option>";
                            }
?>
                        </select>
                    </div> -->
                    <div class="mb-3">
                       <button type="submit" class="btn w-100 btn-primary">Search</button>
                    </div>
<?php
                    if(isset($_GET)) {
?>
                        <div class="mb-3">
                            <a href="freelancer_job_search.php" class="btn btn-outline-secondary w-100">Clear</a>
                        </div>
<?php
                    }
?>
                </form>
                <div class="col-md-9">
                    <div class="row g-2 align-items-center mb-3">
                        <div class="col">
                            <h2 class="page-title">Search</h2>
                        </div>
                    </div>
                    <!-- Card -->
                    <div class="row row-cards mb-3">
                        <div class="">
<?php
                        $posted_jobs = \App\Models\Job::where('active', 1);
                        if(isset($_GET['category'])) {
                            $posted_jobs->whereIn('category', $_GET['category']);
                        }
                        if(isset($_GET['experience'])) {
                            $posted_jobs->whereIn('experience', $_GET['experience']);
                        }
                        if(isset($_GET['skills'])) {
                            $skills = explode(',', $_GET['skills']);
                            $posted_jobs->where(function($q1) use ($skills) {
                                foreach($skills as $skill) {
                                    $q1->orWhere('skills', 'LIKE', "%$skill%");
                                }
                            });
                        }
                        if(isset($_GET['price'])) {
                            switch($_GET['price']) { 
                                case '< 1000': $posted_jobs->where('amount', '<', 1000); break;
                                case '1000-2000': $posted_jobs->whereBetween('amount', [1000, 2000]); break;
                                case '2000-3000': $posted_jobs->whereBetween('amount', [2000, 3000]); break;
                                case '3000-4000': $posted_jobs->whereBetween('amount', [3000, 4000]); break;
                                case '3000-4000': $posted_jobs->whereBetween('amount', [3000, 4000]); break;
                                case '> 5000': $posted_jobs->where('amount', '>', 5000); break;
                            }
                        }
                        if(isset($_GET['minAge']) && isset($_GET['maxAge'])) {
                            $posted_jobs->where('maxAge', '>=', $_GET['minAge'])
                                ->where('minAge', '<=', $_GET['maxAge']);
                        }
                        if(isset($_GET['languages'])) {
                            $languages = $_GET['languages'];
                            $posted_jobs->where(function($q1) use ($languages) {
                                foreach($languages as $language) {
                                    $q1->orWhere('language', 'LIKE', "%$language%");
                                }
                            });
                        }

                        $perPage = 10;
                        $posted_jobs = $posted_jobs->orderBy('created_at', 'desc')->paginate($perPage, ['*'], 'page', isset($_GET['page']) ? $_GET['page'] : 1);
                        //dd($posted_jobs);

                        if($posted_jobs->count() > 0) {
                            foreach($posted_jobs as $job) {
?>
                                <a href="freelancer_jobs_view.php?id=<?= $job->id; ?>" class="text-decoration-none text-dark">
                                    <div class="card hoverable mb-3">
                                        <div class="card-body">
                                            <h5 class="card-title m-0 text-primary"><?= $job->title; ?></h5>
                                            <h5 class="m-0"><?= $job->partner->name; ?></h5>
                                            <p class="card-text m-0">
                                                <small>Experience Level: <?= $job->experience; ?> | Est. Budget: PHP <b><?= number_format($job->amount, 2); ?></b> - Posted <?= $job->created_at->diffForHumans(); ?></small>
                                                <small class="d-block">
                                                    <span class="<?= (!$job->isValidAge(freelancer())) ? 'text-danger' : ''; ?>">Age Req.: <?= $job->ageRequirement() ?> | </span>
                                                    <span class="<?= (!$job->hasValidLanguages(freelancer())) ? 'text-danger' : ''; ?>">Language Req: <?= $job->language ?> | </span>
                                                    <span class="<?= (!$job->isValidSex(freelancer())) ? 'text-danger' : ''; ?>">Sex Req.: <?= $job->sex ?> </span>
                                                </small>
                                            </p>
                                            <div class="m-0 mt-2"><?= substr(strip_tags($job->description), 0, 200); ?>...</div>
<?php
                                            if(!empty($job->skills)) {
                                                echo '<div class="d-block mt-2">';
                                                foreach(explode(',', $job->skills) as $tag) {
                                                    $color = 'badge-outline text-blue';
                                                    if(isset($_GET['skills']) && in_array($tag, explode(',', $_GET['skills']))) {
                                                        $color = 'bg-blue-lt';
                                                    }
                                                    else if(in_array($tag, freelancer()->skillSet())) {
                                                        $color = 'bg-blue';
                                                    }
                                                    echo '<span class="badge '.$color.' px-3 me-2" href="#">'.$tag.'</span>';
                                                }
                                                echo '</div>';
                                            }
?>
                                            <div class="mt-2">
                                                <i class="ti ti-location"></i> <?= $job->partner->address() ?>
                                            </div>
                                            <div class="mt-2">
                                                Applications: <?= $job->applications->count(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </a>
<?php
                            }
?>
                            <div class="d-flex justify-content-center">
                                <ul class="pagination ">
                                    <li class="page-item mx-3">
                                        <a class="page-link <?= $posted_jobs->onFirstPage() ? 'disabled' : '' ?>" href="<?= createUrl('freelancer_job_search.php', array_merge($_GET, ['page' => $posted_jobs->currentPage() - 1])); ?>">
                                            <i class="ti chevron-left"></i> Previous
                                        </a>
                                    </li>
                                    <li class="page-item mx-3">
                                        <a class="page-link <?= $posted_jobs->onLastPage() ? 'disabled' : '' ?>" href="<?= createUrl('freelancer_job_search.php', array_merge($_GET, ['page' => $posted_jobs->currentPage() + 1])); ?>">
                                            <i class="ti chevron-right"></i> Next
                                        </a>
                                    </li>
                                </ul>
                            </div>
<?php
                        } else {
                            echo "<div class=\"alert alert-info\">There are no posted jobs at the moment.</div>";
                        }
?>
                        </div>
                    </div>
                </div>
            </div>
<?php
        } else {
            echo "<div class=\"alert alert-info\">There are no posted jobs at the moment.</div>";
        }
?>
    </div>
</div>
<script src="<?= plugins('tom-select/dist/js/tom-select.complete.min.js')?>"></script>
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
            options: <?= isset($_GET['category']) && strlen($_GET['category'][0]) ? json_encode($data[$_GET['category'][0]]) : '[]'; ?>,
            items: [
                <?= isset($_GET['skills']) ? "'".implode("', '", explode(',', $_GET['skills']) )."'" : null ?>
            ]
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

        $('.form-select-single').each((key, element)=> {
            new TomSelect(element);
        });
        $('.tom-select').each((key, element)=> {
            new TomSelect(element);
        });
        $('.form-select-multiple').each((key, element)=> {
            new TomSelect(element, {
                plugins: ['no_backspace_delete','remove_button', 'checkbox_options'],
            });
        });
    });
</script>
<?php
    include('includes/freelancer_footer.php');
?>