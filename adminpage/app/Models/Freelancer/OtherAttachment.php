<?php
namespace App\Models\Freelancer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OtherAttachment extends Model {
    public $table = 'freelancers_other_attachments';
    protected $primaryKey = 'id';
    protected $fillable = [
        'freelancer_id', 'type', 'issuer', 'name'
    ];
    
    public function freelancer() : BelongsTo {
        return $this->belongsTo(\App\Models\Freelancer::class, 'freelancer_id', 'id');
    }    
}
?>