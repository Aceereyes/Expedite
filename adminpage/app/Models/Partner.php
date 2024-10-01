<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Partner extends Model {
    public $table = 'partners';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name', 'email', 'password', 'type', 'established', 'employeeCount', 'website',
        'region_id', 'province_id', 'municipality_id', 'barangay_id', 'logo', 'background', 'services', 'expertise', 'initialSetup'
    ];

    public function address() {
        return sprintf("Barangay %s, %s, %s, %s", $this->barangay->name, $this->municipality->name, $this->province->name, $this->region->name);
    }

    public function region() : BelongsTo {
        return $this->belongsTo(\App\Models\Location\Region::class, 'region_id', 'id');
    }
    public function province() : BelongsTo {
        return $this->belongsTo(\App\Models\Location\Province::class, 'province_id', 'id');
    }
    public function municipality() : BelongsTo {
        return $this->belongsTo(\App\Models\Location\Municipality::class, 'municipality_id', 'id');
    }
    public function barangay() : BelongsTo {
        return $this->belongsTo(\App\Models\Location\Barangay::class, 'barangay_id', 'id');
    }

    public function getLogo() {
        return (!empty($this->logo)) ? uploads($this->logo) : images('logo.png');
    }
    public function payables() : HasMany {
        return $this->hasMany(\App\Models\Partner\Payable::class);
    }
    public function jobs() : HasMany {
        return $this->hasMany(\App\Models\Job::class, 'partner_id', 'id');
    }
    public function job_applications() : HasMany {
        return $this->hasMany(\App\Models\JobApplication::class, 'partner_id', 'id');
    }
    public function job_orders() : HasMany {
        return $this->hasMany(\App\Models\JobOrder::class, 'partner_id', 'id');
    }
}
?>