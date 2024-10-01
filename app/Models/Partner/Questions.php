<?php
namespace App\Models\Partner;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Questions extends Model {
    protected $table = 'partners_questions';
    protected $primaryKey = 'id';
    protected $fillable = [
        'partner_id', 'freelancer_id', 'job_order_id', 'questions', 'description'
    ];
    public function partner() : BelongsTo
    {
        return $this->belongsTo(\App\Models\Partner::class, 'partner_id', 'id');
    }
    public function freelancer() : BelongsTo
    {
        return $this->belongsTo(\App\Models\Freelancer::class, 'freelancer_id', 'id');
    }
    public function job_order() : BelongsTo
    {
        return $this->belongsTo(\App\Models\JobOrder::class, 'job_order_id', 'id');
    }

    public function scopeActive($query) {
        return $query->where('active', true);
    }
}
?>