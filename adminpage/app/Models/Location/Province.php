<?php
namespace App\Models\Location;

use Illuminate\Database\Eloquent\Model;

class Province extends Model {
    public $table = 'location_provinces';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'region_id', 'name'
    ];
}
?>