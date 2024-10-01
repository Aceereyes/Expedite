<?php
namespace App\Models\Freelancer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AcademicQualification extends Model {
    public $table = 'freelancers_academic_qualifications';
    protected $primaryKey = 'id';
    protected $fillable = [
        'freelancer_id', 'institution', 'course', 'level', 'timeframe'
    ];
    
    public function freelancer() : BelongsTo {
        return $this->belongsTo(\App\Models\Freelancer::class, 'freelancer_id', 'id');
    }
    
    public const LEVELS = [
        'Advanced Diploma', 'Certificate', 'Degree', 'Diploma', 'Master Degree', 'PhD', 'Post Graduate Diploma'
    ];
}
?>