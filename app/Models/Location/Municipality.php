<?php
namespace App\Models\Location;

use Illuminate\Database\Eloquent\Model;

class Municipality extends Model {
    public $table = 'location_municipalities';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'province_id', 'name'
    ];
}
?>