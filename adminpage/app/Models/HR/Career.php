<?php
namespace App\Models\HR;
use Illuminate\Database\Eloquent\Model;

class Career extends Model {
    public $table = 'hr_careers';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title', 'description'
    ];
}
?>