<?php
    if(isset($_POST['btnCreate'])) {
        \App\Models\HR\Payroll::create([
            'status' => App\Models\HR\Payroll::PENDING,
            'dateStart' => $_POST['dateStart'],
            'dateEnd' => $_POST['dateEnd']
        ]);
        setFlashMessage('success', 'Payroll has been created successfully!');
        refresh();
        exit();
    }
?>
<div class="modal modal-blur fade" id="modal_payrolls_create" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form method="POST" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Payroll</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Date Start</label>
                            <input type="date" name="dateStart" class="form-control" value="<?= (date('Y-m-d') <= date('Y-m-15')) ? date('Y-m-01') : date('Y-m-16'); ?>" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Date End</label>
                            <input type="date" name="dateEnd" class="form-control" value="<?= (date('Y-m-d') > date('Y-m-15')) ? date('Y-m-t') : date('Y-m-15'); ?>" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="btnCreate" class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>
</div>