<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterviewSchedule extends Model {
    public $table = 'interview_schedules';
    protected $primaryKey = 'id';
    protected $fillable = [
        'partner_id', 'freelancer_id', 'job_id', 'job_application_id', 'start', 'end', 'note',
    ];
    public function application() {
        return $this->belongsTo(\App\Models\JobApplication::class, 'job_application_id', 'id');
    }
    public function partner() {
        return $this->belongsTo(\App\Models\Partner::class, 'partner_id', 'id');
    }
    public function freelancer() {
        return $this->belongsTo(\App\Models\Freelancer::class, 'freelancer_id', 'id');
    }
    public function job() {
        return $this->belongsTo(\App\Models\Job::class, 'job_id', 'id');
    }
    public function createJobOrder() {
        return \App\Models\JobOrder::create([
            'freelancer_id' => $this->freelancer_id,
            'partner_id' => $this->partner_id,
            'job_id' => $this->job_id,
            'status' => \App\Models\JobOrder::PENDING
        ]);
    }

    
}
?>