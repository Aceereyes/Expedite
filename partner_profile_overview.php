<?php
    include('includes/partner_header.php');
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
                    <div class="col d-flex flex-column">
                        <div class="card-body pb-4">
                            <h2 class="mb-4">Overview</h2>
                            
                            <div class="row align-items-center justify-content-center">
                                <span class="avatar avatar-xl" style="background-image: url('<?= partner()->getLogo() ?>')"></span>
                            </div>

                            <h3 class="card-title text-center h2 mt-4"><?= partner()->name ?></h3>

                            <div class="datagrid">
<?php
                                $datagrid_items = [
                                    [
                                        'title' => 'Established in',
                                        'content' => \Carbon\Carbon::parse(partner()->established)->format('F j, Y'),
                                    ],
                                    [
                                        'title' => 'Type',
                                        'content' => partner()->type,
                                    ],
                                    [
                                        'title' => 'People',
                                        'content' => partner()->employeeCount,
                                    ],
                                    [
                                        'title' => 'Website',
                                        'content' => partner()->website,
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
                            $content = partner()->background;
                            if($content != '') {
                                echo "<div class=\"mt-4\">
                                    <div class=\"text-primary fw-bold h2 mb-2\">Partner Background</div>
                                    <div>$content</div>
                                </div>";
                            }

                            $content = partner()->services;
                            if($content != '') {
                                echo "<div class=\"mt-4\">
                                    <div class=\"text-primary fw-bold h2 mb-2\">Services</div>
                                    <div>$content</div>
                                </div>";
                            }
                            
                            $content = partner()->expertise;
                            if($content != '') {
                                echo "<div class=\"mt-4\">
                                    <div class=\"text-primary fw-bold h2 mb-2\">Expertise</div>
                                    <div>$content</div>
                                </div>";
                            }
?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    include('includes/partner_footer.php');
?>
