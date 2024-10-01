<?php
    include('includes/guest_header.php');
?>
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title"><?= (isset($_GET['id'])) ? 'Partner' : 'Partners'; ?></h2>
                </div>
<?php
                if(isset($_GET['id'])) {
                    echo '<div class="col-auto ms-auto d-print-none">
                        <a href="partners.php" class="btn">
                            <i class="ti ti-arrow-back"></i> Back
                        </a>
                    </div>';
                }
?>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container">
<?php
            if(isset($_GET['id'])) {
                $partner = \App\Models\Partner::where('id', $_GET['id'])->first();
?>
                <div class="card mb-3">
                    <div class="card-body pb-4">
                        <h2 class="mb-4">Overview</h2>
                        
                        <div class="row align-items-center justify-content-center">
                            <span class="avatar avatar-xl" style="background-image: url('<?= $partner->getLogo() ?>')"></span>
                        </div>

                        <h3 class="card-title text-center h2 mt-4"><?= $partner->name ?></h3>

                        <div class="datagrid">
<?php
                            $datagrid_items = [
                                [
                                    'title' => 'Established in',
                                    'content' => \Carbon\Carbon::parse($partner->established)->format('F j, Y'),
                                ],
                                [
                                    'title' => 'Type',
                                    'content' => $partner->type,
                                ],
                                [
                                    'title' => 'People',
                                    'content' => $partner->employeeCount,
                                ],
                                [
                                    'title' => 'Website',
                                    'content' => $partner->website,
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
                        $content = $partner->background;
                        if($content != '') {
                            echo "<div class=\"mt-4\">
                                <div class=\"text-primary fw-bold h2 mb-2\">Partner Background</div>
                                <div>$content</div>
                            </div>";
                        }

                        $content = $partner->services;
                        if($content != '') {
                            echo "<div class=\"mt-4\">
                                <div class=\"text-primary fw-bold h2 mb-2\">Services</div>
                                <div>$content</div>
                            </div>";
                        }
                        
                        $content = $partner->expertise;
                        if($content != '') {
                            echo "<div class=\"mt-4\">
                                <div class=\"text-primary fw-bold h2 mb-2\">Expertise</div>
                                <div>$content</div>
                            </div>";
                        }
?>
                    </div>
                </div>
<?php
            } else {
                $partners = \App\Models\Partner::all();
                if($partners->count() > 0) {
                    echo "<div class=\"row row-cards\">";
                    foreach($partners as $item) {
                        $name = $item->name;
                        $logo = $item->getLogo();
                        $link = createUrl('partners.php', ['id' => $item->id]);
                        echo "<div class=\"col-md-6 col-lg-3 mb-3\">
                            <div class=\"card\">
                                <div class=\"card-body p-4 pb-2 text-center\">
                                    <span class=\"avatar avatar-xl mb-3 rounded\" style=\"background-image: url($logo)\"></span>
                                    <h3 class=\"m-0 mb-1\">
                                        <a href=\"#\">$name</a>
                                    </h3>
                                </div>
                                <div class=\"d-flex\"></div>
                                <a href=\"$link\" class=\"card-btn\">Profile</a>
                            </div>
                        </div>";
                    }
                    echo "</div>";
                } else {
                    echo '<div class="alert alert-info">There are no partners registered.</div>';
                }
            }
?>
        </div>
    </div>
<?php
    include('includes/guest_footer.php');
?>