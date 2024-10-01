<?php
namespace App\Models\Freelancer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TrainingAndWorkshop extends Model {
    public $table = 'freelancers_trainings_workshops';
    protected $primaryKey = 'id';
    protected $fillable = [
        'freelancer_id', 'training', 'institution', 'timeframe'
    ];
    
    public function freelancer() : BelongsTo {
        return $this->belongsTo(\App\Models\Freelancer::class, 'freelancer_id', 'id');
    }    
}
?>