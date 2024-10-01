<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model {
    public $table = 'jobs';
    protected $primaryKey = 'id';
    protected $fillable = [
        'partner_id', 'title', 'amount', 'category', 'closingDate', 'deadline', 'experience', 'description', 'responsibilities', 'requirements', 'instructions', 'active', 'skills',
        'minAge', 'maxAge', 'language', 'sex'
    ];
    public function ageRequirement() {
        if($this->minAge == $this->maxAge) {
            return sprintf('%d yrs. old', $this->minAge);
        }
        return sprintf('%d - %d yrs. old', $this->minAge, $this->maxAge);
    }
    public function partner() {
        return $this->belongsTo(\App\Models\Partner::class, 'partner_id', 'id');
    }
    public function scopeActive($query) {
        return $query->where('active', true);
    }
    public function applications() {
        return $this->hasMany(\App\Models\JobApplication::class);
    }
    public function color() {
        return $this->active ? 'green' : 'red';
    }
    public function skillSet() {
        if(empty($this->skills)) {
            return [];
        }
        return explode(',', $this->skills);
    }
    public function validSexs() {
        if(empty($this->sex)) {
            return [];
        }
        return explode(',', $this->sex);
    }
    public function validLanguages() {
        if(empty($this->language)) {
            return [];
        }
        return explode(',', $this->language);
    }
    public function hasValidSkills(\App\Models\Freelancer $freelancer) {
        foreach($this->skillSet() as $skill) {
            if(in_array($skill, $freelancer->skillSet())) {
                return true;
            }
        }
        
        return false;
    }
    public function isValidSex(\App\Models\Freelancer $freelancer) {
        return in_array($freelancer->gender, $this->validSexs());
    }
    public function hasValidLanguages(\App\Models\Freelancer $freelancer) {
        foreach($freelancer->languageProficiencies as $language) {
            return in_array($language->language, $this->validLanguages());
        }
        return false;
    }
    public function isValidAge(\App\Models\Freelancer $freelancer) {
        $bday = \Carbon\Carbon::parse($freelancer->dateOfBirth);
        return $bday->age >= $this->minAge && $bday->age <= $this->maxAge;
    }
}
?>