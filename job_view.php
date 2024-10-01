<?php
    include('includes/guest_header.php');

    //Check
    if(!isset($_GET['id'])) {
        setFlashMessage('error', 'Record does not exist!');
        //alert('Account does not exist!');
        redirect('index.php');
        exit();
    }
    $job = \App\Models\Job::find($_GET['id']);
?>
<div class="page-body">
    <div class="container">
        <div class="row g-2 align-items-center mb-3">
            <div class="col">
                <h2 class="page-title">View Job</h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <a href="job_list.php" class="btn">
                    <i class="ti ti-arrow-back"></i> Back
                </a>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-body pb-4">
                <div class="row align-items-center justify-content-center">
                    <span class="avatar avatar-xl" style="background-image: url('<?= $job->partner->getLogo() ?>')"></span>
                </div>

                <h2 class="text-center h2 mt-4"><?= $job->title ?></h2>
                <h3 class="text-center h3 mt-4">at <?= $job->partner->name ?></h3>

                <div class="datagrid">
<?php
                    $datagrid_items = [
                        [
                            'title' => 'Experience',
                            'content' => $job->experience
                        ],
                        [
                            'title' => 'Closing Date',
                            'content' => \Carbon\Carbon::parse($job->closingDate)->format('F d, Y'),
                        ],
                        [
                            'title' => 'Category',
                            'content' => $job->category,
                        ],
                        [
                            'title' => 'Posted on',
                            'content' => \Carbon\Carbon::parse($job->created_at)->format('F d, Y'),
                        ],
                    ];
                    foreach($datagrid_items as $item) {
                        $title = $item['title'];
                        $content = $item['content'];
                        
                        echo "<div class=\"datagrid-item\">
                            <div class=\"datagrid-title\">$title</div>
                            <div class=\"datagrid-content\">$content</div>
                        </div>";
                    }
?>
                </div>
<?php
                $content = $job->description;
                if($content != '') {
                    echo "<div class=\"mt-4\">
                        <div class=\"text-primary fw-bold h2 mb-2\">Job Description</div>
                        <div>$content</div>
                    </div>";
                }

                $content = $job->responsibilities;
                if($content != '') {
                    echo "<div class=\"mt-4\">
                        <div class=\"text-primary fw-bold h2 mb-2\">Responsibilities</div>
                        <div>$content</div>
                    </div>";
                }
                
                $content = $job->requirements;
                if($content != '') {
                    echo "<div class=\"mt-4\">
                        <div class=\"text-primary fw-bold h2 mb-2\">Requirements</div>
                        <div>$content</div>
                    </div>";
                }
?>
            </div>
        </div>
    </div>
</div>
<script src="<?= plugins('tom-select/dist/js/tom-select.base.min.js')?>"></script>
<script>
    $(document).ready(function () {
        $('.form-select').each((key, element)=> {
            new TomSelect(element);
        });
    });
</script>
<?php
    include('includes/guest_footer.php');
?>