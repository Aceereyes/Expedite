<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model {
    public $table = 'job_applications';
    protected $primaryKey = 'id';
    protected $fillable = [
        'partner_id', 'freelancer_id', 'job_id', 'status'
    ];
    public function isPending() {
        return $this->status == self::PENDING;
    }
    public function freelancer() {
        return $this->belongsTo(\App\Models\Freelancer::class, 'freelancer_id', 'id');
    }
    public function job() {
        return $this->belongsTo(\App\Models\Job::class, 'job_id', 'id');
    }
    public function partner() {
        return $this->belongsTo(\App\Models\Partner::class, 'partner_id', 'id');
    }
    public static function isApplied($freelancer, $job) {
        return \App\Models\JobApplication::where([
            'freelancer_id' => $freelancer,
            'job_id' => $job
        ])->exists();
    }
    public function color() {
        switch($this->status) {
            case self::PENDING: return 'orange'; break;
            case self::ACCEPTED: return 'green'; break;
            case self::DECLINED: return 'red'; break;
        }
    }
    public const PENDING = 'Pending';
    public const ACCEPTED = 'Accepted';
    public const DECLINED = 'Declined';
}
?>