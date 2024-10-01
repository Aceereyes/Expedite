<?php
namespace App\Models\Freelancer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LanguageProficiency extends Model {
    public $table = 'freelancers_language_proficiencies';
    protected $primaryKey = 'id';
    protected $fillable = [
        'freelancer_id', 'language', 'speaking', 'writing', 'reading'
    ];
    
    public function freelancer() : BelongsTo {
        return $this->belongsTo(\App\Models\Freelancer::class, 'freelancer_id', 'id');
    }    
}
?>