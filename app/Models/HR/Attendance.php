<?php
namespace App\Models\HR;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model {
    protected $table = 'hr_attendances';
    protected $primaryKey = 'id';
    protected $fillable = [
        'employee_id', 'type', 'attendance_date', 'timeIn', 'timeOut', 'noOfHours', 'remarks'
    ];
    public function employee() : BelongsTo
    {
        return $this->belongsTo(\App\Models\HR\Employee::class, 'employee_id', 'id');
    }
}
?>