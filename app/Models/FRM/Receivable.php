<?php
namespace App\Models\FRM;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Receivable extends Model {
    protected $table = 'frm_receivables';
    protected $primaryKey = 'id';
    protected $fillable = [
        'partner_id', 'freelancer_id', 'job_order_id', 'amount', 'description'
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
}
?>