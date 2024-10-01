<?php
    include('includes/admin_header.php');
?>
<div class="page-header d-print-none">
    <div class="container-fluid">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title" id="page-title">
                    Payrolls
                </h2>
            </div>
<?php
            $employees = \App\Models\HR\Employee::all();
            if($employees->count() > 0) {
?>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <span class=" d-sm-inline">
                            <a href="#" class="btn" data-bs-toggle="modal" data-bs-target="#modal_payrolls_create">
                                <i class="ti ti-plus"></i> New
                            </a>
                        </span>
                    </div>
                </div>
<?php
            }
?>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-fluid">
        <div class="row">
<?php
            $payrolls = \App\Models\HR\Payroll::all();
            if($payrolls->count() > 0) {
                foreach($payrolls as $payroll) {
                    echo '<div class="col-sm-3">
                        <a href="admin_hr_payroll_edit.php?id='.$payroll->id.'" class="card card-link card-link-pop">
                            <div class="ribbon bg-'.\App\Models\HR\Payroll::getColor($payroll->status).'">'.$payroll->status.'</div>
                            <div class="card-body">
                                <span class="small d-block mb-2">Payment Period: </span>
                                <span class="d-block lead">
                                    Start: <b class="fw-bold">'.date_format(new DateTime($payroll->dateStart), 'F d, Y').'</b><br/>
                                    End: <b class="fw-bold">'.date_format(new DateTime($payroll->dateEnd), 'F d, Y').'</b><br/>
                                </span>
                            </div>
                        </a>
                    </div>';
                }
            } else {
                echo '<div class="col-sm-12">
                    <div class="alert alert-danger" role="alert">
                        <div class="d-flex">
                            <div>
                                <i class="ti ti-alert-circle"></i>
                            </div>
                            <div>
                                <h4 class="alert-title">I\'m so sorry&hellip;</h4>
                                <div class="text-muted">There are no payrolls available as of the moment.</div>
                            </div>
                        </div>
                    </div>
                </div>';
            }
?>
        </div>
    </div>
</div>
<?php
    modal('admin_payrolls_create');
    include('includes/admin_footer.php');
?>