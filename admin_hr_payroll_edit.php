<?php
    include('includes/admin_header.php');

    //Check
    if(!isset($_GET['id'])) {
        setFlashMessage('error', 'Attendance does not exist!');
        redirect('admin_hr_payroll.php');
        exit();
    }
    $payroll = \App\Models\HR\Payroll::find($_GET['id']);

    if(isset($_POST['btnUpdate'])) {
        $employees = \App\Models\HR\Employee::active()->get();

        foreach($employees as $employee) {
            $id = $employee->id;
            $payslips = App\Models\HR\Payslip::where('employee_id', '=', $employee->id)
                ->where('payroll_id', '=', $payroll->id)->get();

            if($payslips->count() > 0) {
                \App\Models\HR\Payslip::where('employee_id', '=', $employee->id)
                    ->where('payroll_id', '=', $payroll->id)
                    ->update([
                        'rate' => $_POST['rate'][$id] ?? 0,
                        'noOfHours' => $_POST['attendances'][$id] ?? 0,
                        'overtime' => $_POST['overtimes'][$id] ?? 0,
                        'gross' => $_POST['gross'][$id] ?? 0,
                        'deductions' => $_POST['deductions'][$id] ?? 0,
                        'net' => $_POST['net'][$id] ?? 0
                    ]);
            } else {
                \App\Models\HR\Payslip::create([
                    'payroll_id' => $payroll->id,
                    'employee_id' => $employee->id,
                    'rate' => $_POST['rate'][$id] ?? 0,
                    'noOfHours' => $_POST['attendances'][$id] ?? 0,
                    'overtime' => $_POST['overtimes'][$id] ?? 0,
                    'gross' => $_POST['gross'][$id] ?? 0,
                    'deductions' => $_POST['deductions'][$id] ?? 0,
                    'net' => $_POST['net'][$id] ?? 0
                ]);
            }

            //dd($_POST);
        }
        setFlashMessage('success', 'Update success!');
        refresh();
        exit();
    }
?>
<div class="page-header d-print-none">
    <div class="container-fluid">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title" id="page-title">
                    Payroll: <?= $payroll->timeFrame() ?>
                </h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <span class=" d-sm-inline">
                        <a href="admin_hr_payroll.php" class="btn">
                            <i class="ti ti-arrow-back"></i> Back
                        </a>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-fluid">
        <form class="card" method="POST" novalidate>
            <div class="card-header">
                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item ms-auto">
<?php
                        // if($payroll->isOnProcess()) {
                        //     echo '<button type="button" class="btn btn-outline-primary" onclick="changeURL(\'main_payroll_print?id='.$payroll->id.'\'); ">Print</button>';
                        // }
                        if($payroll->isPending()) {
                            echo '<button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modal_finalize_payroll">Finalize</button>';
                        }
                        else if($payroll->isDone()) {
                            echo '<a type="button" class="btn btn-outline-primary" href="'.uploads($payroll->referenceFile).'" target="_blank" download>Download Reference File</a>';
                        }
?>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered table-hover">
                        <thead>
                            <th>Employee</th>
                            <th>Rate</th>
                            <th>No. of Hours</th>
                            <th>Overtime</th>
                            <th>Gross</th>
                            <th>Deductions</th>
                            <th>NET</th>
                        </thead>
                        <tbody>
<?php                       
                            $grossTotal = 0;
                            $deductionsTotal = 0;
                            $employees = \App\Models\HR\Employee::all();

                            foreach($employees as $employee) {
                                $payslip = \App\Models\HR\Payslip::where('employee_id', '=', $employee->id)->where('payroll_id', '=', $payroll->id)->first();
                                $attendancesSum = \App\Models\HR\Attendance::where('employee_id', '=', $employee->id)->whereBetween('attendance_date', [$payroll->dateStart, $payroll->dateEnd])->whereNot('type', 'Overtime')->sum('noOfHours');
                                $overtimesSum = \App\Models\HR\Attendance::where('employee_id', '=', $employee->id)->whereBetween('attendance_date', [$payroll->dateStart, $payroll->dateEnd])->where('type', 'Overtime')->sum('noOfHours');
                                $rate =  $employee->rate ?? $payslip->rate;

                                $attendancesSum = $attendancesSum ?? 0;
                                $noOfHours = $payslip->noOfHours ?? 0;
                                $attendanceHrs = ($attendancesSum != $noOfHours) ? $attendancesSum : $noOfHours;

                                $overtimesSum = $overtimesSum ?? 0;
                                $ot = $payslip->overtime ?? 0;
                                $overtime = ($overtimesSum != $ot) ? $overtimesSum : $ot;
                                $overtime = $overtime ?? $overtimesSum ?? 0;

                                $gross = ($attendanceHrs * $rate) + ($overtime * $rate);

                                $deductions = $payslip->deductions ?? 0;

                                $net = $gross - $deductions;

                                $grossTotal += $gross;
                                $deductionsTotal += $deductions;
?>
                                <tr id="<?= $employee->id ?>_row">
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <input type="text" step="0.01" value="<?=$employee->lastName?>, <?=$employee->firstName?>" class="form-control form-control-sm" readonly>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <input type="number" step="0.01" style="width: 80px;" name="rate[<?= $employee->id ?>]" id="<?=$employee->id?>_rate" value="<?=$rate?>" class="form-control form-control-sm text-center disabled" readonly>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <input type="number" ondblclick="changeURL('admin_hr_attendances.php?emp=<?=$employee->id?>&fr=<?=$payroll->dateStart?>&to=<?=$payroll->dateEnd?>');" step="0.01" style="width: 80px;" name="attendances[<?=$employee->id?>]" id="<?=$employee->id?>_attendances" value="<?=$attendanceHrs?>" class="form-control form-control-sm text-center disabled" readonly>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <input type="number" step="0.01" ondblclick="changeURL('admin_hr_attendances.php?emp=<?=$employee->id?>&type=Overtime&fr=<?=$payroll->dateStart?>&to=<?=$payroll->dateEnd?>');" style="width: 80px;" name="overtimes[<?=$employee->id?>]" id="<?=$employee->id?>_overtimes" value="<?=$overtime?>" class="form-control form-control-sm text-center disabled" readonly>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <input type="number" step="0.01" style="width: 80px;" name="gross[<?=$employee->id?>]" id="<?=$employee->id?>_gross" value="<?=$gross?>" class="form-control form-control-sm text-center disabled fw-bold gross" readonly>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <input type="number" step="0.01" style="width: 80px;" onchange="compute('<?=$employee->id?>', $(this));" onkeyup="compute('<?=$employee->id?>', $(this));" name="deductions[<?=$employee->id?>]" id="<?=$employee->id?>_deductions" value="<?=$deductions?>" class="form-control form-control-sm text-center fw-bold deductions">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <input type="number" step="0.01" style="width: 80px;" name="net[<?=$employee->id?>]" id="<?=$employee->id?>_net" value="<?=$net?>" class="form-control form-control-sm text-center fw-bolder disabled net" readonly>
                                        </div>
                                    </td>
                                </tr>
<?php
                            }

                            $netTotal = $grossTotal - $deductionsTotal;
?>
                            <tr>
                                <td colspan="4"></td>
                                <td class="text-center fw-bold" id="grossTotal"><?= number_format($grossTotal, 2); ?></td>
                                <td class="text-center fw-bold" id="deductionsTotal"><?= number_format($deductionsTotal, 2); ?></td>
                                <td class="text-center fw-bolder" id="netTotal"><?= number_format($netTotal, 2); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer text-center">
<?php
                if($payroll->isPending()) {
                    echo '<button type="submit" name="btnUpdate" class="btn btn-primary px-5">Update Payroll</button>';
                }
                else if($payroll->isOnProcess()) {
                    echo '<button type="button" class="btn btn-danger px-5 m-2 mx-3" data-bs-toggle="modal" data-bs-target="#modal_payrolls_revert">Revert to Pending Status</button>';
                    echo '<button type="button" class="btn btn-primary px-5 m-2 mx-3" data-bs-toggle="modal" data-bs-target="#modal_payrolls_upload">Upload Reference File</button>';
                    echo '<button type="submit" class="btn btn-yellow px-5 m-2 mx-3" name="btnNotify">Notify Student Assistants</button>';
                }
?>
            </div>
        </form>
    </div>
</div>
<div class="modal modal-blur fade" id="modal_confirmdelete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form method="POST" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this payroll?</p>
            </div>
            <div class="modal-footer">
                <a type="button" href="#" data-bs-dismiss="modal" class="btn btn-secondary">No</a>
                <button type="submit" name="btnConfirmDelete" class="btn btn-danger">Yes</button>
            </div>
        </form>
    </div>
</div>
<script>
    function changeURL(url) {
        window.open(
            url,
            '_blank','toolbar=no, location=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=800, height=600'
        );
    }
    function compute(id, evt = this) {
        id = '#' + id;

        var row = $(id + '_row');

        if(row.hasClass('bg-blue-lt') == false && evt.hasClass('bg-blue-lt') == false && evt.hasClass('text-white') == false) {
            row.addClass('bg-blue-lt');
            evt.addClass('bg-blue-lt').addClass('text-white');
        }

        if(evt.val().length == 0 || parseFloat(evt.val()) == NaN) {
            evt.val('0.00');
        }

        var _rate = parseFloat($(id + '_rate').val());
        var _attendances = parseFloat($(id + '_attendances').val());
        var _overtimes = parseFloat($(id + '_overtimes').val());
        var _gross = parseFloat($(id + '_gross').val());
        var _deductions = parseFloat($(id + '_deductions').val());

        var gross = (_rate * _attendances) + (_rate * _overtimes);
        var deductions = _deductions;
        var net = gross - deductions;

        $(id + '_gross').val( gross.toFixed(2) );
        $(id + '_net').val( net.toFixed(2) );

        var grossTotal = 0;
        var deductionsTotal = 0;
        var netTotal = 0;

        $('.gross').each(function(index, elem) {
            grossTotal += parseFloat(elem.value);
        });

        $('.net').each(function(index, elem) {
            netTotal += parseFloat(elem.value);
        });

        $('#grossTotal').html(grossTotal.toFixed(2));
        $('#netTotal').html(netTotal.toFixed(2));
    }
</script>
<script src="<?= plugins('tom-select/dist/js/tom-select.base.min.js')?>"></script>
<script src="<?= plugins('tinymce/tinymce.min.js'); ?>"></script>
<script>
    $(document).ready(function () {
        $('.form-select').each((key, element)=> {
            new TomSelect(element);
        });
        let options = {
            selector: '#remarks',
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
<?php
    include('includes/admin_footer.php');
?>