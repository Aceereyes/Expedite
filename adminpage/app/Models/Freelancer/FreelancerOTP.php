<?php
namespace App\Models\Freelancer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AcademicQualification extends Model {
    public $table = 'freelancersOTPs';
    protected $primaryKey = 'id';
    protected $fillable = [
         'OTP',
    ];
    
    public function freelancer() : BelongsTo {
        return $this->belongsTo(\App\Models\Freelancer::class, 'freelancer_id', 'id');
    }
}
?>