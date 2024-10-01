<?php
namespace App\Models\Location;

use Illuminate\Database\Eloquent\Model;

class Barangay extends Model {
    public $table = 'location_barangays';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'municipality_id', 'name'
    ];
}
?>