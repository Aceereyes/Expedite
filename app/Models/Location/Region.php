<?php
namespace App\Models\Location;

use Illuminate\Database\Eloquent\Model;

class Region extends Model {
    public $table = 'location_regions';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'name', 'description'
    ];
}
?>