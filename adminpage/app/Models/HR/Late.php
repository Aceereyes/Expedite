<?php
namespace App\Models\HR;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Late extends Model {
    protected $table = 'hr_lates';
    protected $primaryKey = 'id';
    protected $fillable = [
        'employee_id', 'date', 'time', 'equivalent_time'
    ];
    public function employee() : BelongsTo {
        return $this->belongsTo(\App\Models\HR\Employee::class, 'employee_id', 'id');
    }


    /*
        OLD WAY
        $testQuery = $conn->query('SELECT * FROM tbl_hr_lates WHERE id='10' AND date='2023-01-27'');
        $result = $testQuery->fetch_assoc();
        echo $result['employee_id'];


        NEW AND EASY WAY
        $late = \App\Models\HR\Late::where('id', 10)->where('date', '2023-01-27')->first();
        echo $late->date;
        echo $late->equivalent_time;
        echo $late->employee->firstName;
    */
}
?>