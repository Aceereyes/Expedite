<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JobOrder extends Model {
    public $table = 'job_orders';
    protected $primaryKey = 'id';
    protected $fillable = [
        'freelancer_id', 'partner_id', 'job_id', 'composed', 'status', 'reason', 'submitted_at'
    ];
    public function scopeSubmitted($query) {
        return $query->whereNotNull('submitted_at');
    }
    public function freelancer() : BelongsTo {
        return $this->belongsTo(\App\Models\Freelancer::class, 'freelancer_id', 'id');
    }
    public function partner() : BelongsTo{
        return $this->belongsTo(\App\Models\Partner::class, 'partner_id', 'id');
    }
    public function job() : BelongsTo {
        return $this->belongsTo(\App\Models\Job::class, 'job_id', 'id');
    }
    public function attachments() : HasMany {
        return $this->hasMany(\App\Models\JobOrderAttachment::class, 'job_order_id', 'id');
    }
    public function isPending() {
        return $this->status == self::PENDING;
    }
    public function isAccepted() {
        return $this->status == self::ACCEPTED;
    }
    public function isDeclined() {
        return $this->status == self::DECLINED;
    }
    public function color() {
        switch($this->status) {
            case self::PENDING: return 'orange'; break;
            case self::ACCEPTED: return 'green'; break;
            case self::DECLINED: return 'red'; break;
        }
    }
    public function getCharge(){ 
        return $this->job->amount * \App\Interfaces\Globals::EXPEDITE_CHARGE_PERCENTAGE;
    }
    public function getTotal() {
        return $this->job->amount;
    }
    public function getTotalWithCharge() {
        return $this->getTotal() + $this->getCharge();
    }
    public function getDeadline($format = 'F d, Y h:i:s  A') {;
        return $this->job->deadline != null ? \Carbon\Carbon::parse($this->job->deadline)->format($format) : '-';
    }
    public function submissionDateTime($format = 'F d, Y h:i:s  A') {;
        return $this->submitted_at != null ? \Carbon\Carbon::parse($this->submitted_at)->format($format) : '-';
    }
    public const PENDING = 'Pending';
    public const ACCEPTED = 'Accepted';
    public const DECLINED = 'Declined';
}
?>