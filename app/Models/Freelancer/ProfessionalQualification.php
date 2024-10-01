<?php
namespace App\Models\Freelancer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProfessionalQualification extends Model {
    public $table = 'freelancers_professional_qualifications';
    protected $primaryKey = 'id';
    protected $fillable = [
        'freelancer_id', 'institution', 'title', 'timeframe'
    ];
    
    public function freelancer() : BelongsTo {
        return $this->belongsTo(\App\Models\Freelancer::class, 'freelancer_id', 'id');
    }    
}
?>