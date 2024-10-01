<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model {
    public $table = 'admins';
    protected $primaryKey = 'id';
    protected $fillable = [
        'firstName', 'lastName', 'email', 'password', 'department'
    ];
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