<?php
namespace App\Models\HR;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payslip extends Model {
    protected $table = 'hr_payslips';
    protected $primaryKey = 'id';
    protected $fillable = [
        'payroll_id', 'employee_id', 'rate', 'noOfHours', 'overtime', 'gross', 'deductions', 'net'
    ];

    public function payroll() : BelongsTo {
        return $this->belongsTo(\App\Models\Payroll::class, 'student_assistant_id', 'id');
    }
    public function studentAssistant() : BelongsTo {
        return $this->belongsTo(\App\Models\StudentAssistant::class, 'student_assistant_id', 'id');
    }
}
?>