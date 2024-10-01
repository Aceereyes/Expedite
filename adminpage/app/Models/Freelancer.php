<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Freelancer extends Model {
    public $table = 'freelancers';
    protected $primaryKey = 'id';
    protected $fillable = [
        'firstName', 'lastName', 'gender', 'dateOfBirth', 'email', 'password', 'region_id', 'province_id', 'municipality_id', 'barangay_id', 'phone', 'about', 'avatar', 'initialSetup', 'skills','otp',
    ];

    public function fullName() {
        return $this->firstName.' '.$this->lastName;
    }
    public function address() {
        return sprintf("Barangay %s, %s, %s, %s", $this->barangay->name ?? '', $this->municipality->name ?? '', $this->province->name ?? '', $this->region->name ?? '');
    }
    public function getAvatar() {
        return (!empty($this->avatar)) ? uploads($this->avatar) : images('user.jpg');
    }

    public function region() : BelongsTo {
        return $this->belongsTo(\App\Models\Location\Region::class, 'region_id', 'id');
    }
    public function province() : BelongsTo {
        return $this->belongsTo(\App\Models\Location\Province::class, 'province_id', 'id');
    }
    public function municipality() : BelongsTo {
        return $this->belongsTo(\App\Models\Location\Municipality::class, 'municipality_id', 'id');
    }
    public function barangay() : BelongsTo {
        return $this->belongsTo(\App\Models\Location\Barangay::class, 'barangay_id', 'id');
    }

    public function academicQualifications() : HasMany {
        return $this->hasMany(\App\Models\Freelancer\AcademicQualification::class);
    }
    public function professionalQualifications() : HasMany {
        return $this->hasMany(\App\Models\Freelancer\ProfessionalQualification::class);
    }
    public function languageProficiencies() : HasMany {
        return $this->hasMany(\App\Models\Freelancer\LanguageProficiency::class);
    }
    public function trainingAndWorkshops() : HasMany {
        return $this->hasMany(\App\Models\Freelancer\TrainingAndWorkshop::class);
    }
    public function workExperiences() : HasMany {
        return $this->hasMany(\App\Models\Freelancer\WorkExperience::class);
    }
    public function receivables() : HasMany {
        return $this->hasMany(\App\Models\Freelancer\Receivable::class, 'freelancer_id', 'id');
    }
    public function applications() : HasMany {
        return $this->hasMany(\App\Models\JobApplication::class, 'freelancer_id', 'id');
    }
    public function job_orders() : HasMany {
        return $this->hasMany(\App\Models\JobOrder::class, 'freelancer_id', 'id');
    }
    
    public function skillSet() {
        if(empty($this->skills)) {
            return [];
        }
        return explode(',', $this->skills);
    }
}
?>