<?php
namespace App\Models\HR;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model {
    protected $table = 'hr_payrolls';
    protected $primaryKey = 'id';
    protected $fillable = [
        'dateStart', 'dateEnd', 'status'
    ];

    public function isPending() {
        return $this->status == self::PENDING;
    }
    public function isOnProcess() {
        return $this->status == self::ON_PROCESS;
    }
    public function isDone() {
        return $this->status == self::DONE;
    }
    public function timeFrame() {
        return sprintf("%s - %s", \Carbon\Carbon::parse($this->dateStart)->format('F d, Y'), \Carbon\Carbon::parse($this->dateEnd)->format('F d, Y'));
    }
    public static function getColor($status) {
        $color = 'red';
        switch($status) {
            case self::PENDING: $color = 'red'; break;
            case self::ON_PROCESS: $color = 'yellow'; break;
            case self::DONE: $color = 'green'; break;
        }
        return $color;
    }
    public const PENDING = 'Pending';
    public const ON_PROCESS = 'On Process';
    public const DONE = 'Done';
}
?>