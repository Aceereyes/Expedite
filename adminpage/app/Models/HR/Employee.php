<?php
namespace App\Models\HR;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model {
    public $table = 'hr_employees';
    protected $primaryKey = 'id';
    protected $fillable = [
        'firstName', 'lastName', 'rate', 'email', 'password', 'department', 'position', 'active'
    ];
    public function employeeNumber() {
        $yearHired = \Carbon\Carbon::parse($this->created_at)->format('Y');
        return sprintf('%d-%04d', $yearHired, $this->id);
    }
    public function fullName() {
        return $this->firstName.' '.$this->lastName;
    }
    public function accessAll() {
        return $this->isAll();
    }
    public function isAll() {
        return $this->department == self::ALL;
    }
    public function isHRM() {
        return $this->department == self::HRM;
    }
    public function isCRM() {
        return $this->department == self::CRM;
    }
    public function isFRM() {
        return $this->department == self::FRM;
    }
    public function isChecker() {
        return $this->department == self::CHECKER;
    }
    
    public static function toId($employeeNumber) {
        $explodedId = explode('-', $employeeNumber);
        $rawId = $explodedId[1];
        return $rawId;
    }
    public static function fromEmployeeNumber($employeeNumber) {
        return self::find(self::toId($employeeNumber));
    }
    public function scopeActive($query) {
        return $query->where('active', '1');
    }
    
    public const ALL = 'All';
    public const HRM = 'HRM';
    public const CRM = 'CRM';
    public const FRM = 'FRM';
    public const CHECKER = 'Checker';
    
    public const DEPARTMENTS = [
        self::ALL, self::HRM, self::CRM, self::FRM, self::CHECKER
    ];
}
?>