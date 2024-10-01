<?php
namespace App\Models\Freelancer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkExperience extends Model {
    public $table = 'freelancers_work_experiences';
    protected $primaryKey = 'id';
    protected $fillable = [
        'freelancer_id', 'institution', 'job_title', 'timeframe', 'dutiesAndResponsibilities'
    ];
    
    public function freelancer() : BelongsTo {
        return $this->belongsTo(\App\Models\Freelancer::class, 'freelancer_id', 'id');
    }    
}
?>