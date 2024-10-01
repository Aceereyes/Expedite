<?php
namespace App\Models\CRM;
use Illuminate\Database\Eloquent\Model;

class FAQ extends Model {
    public $table = 'crm_faqs';

    protected $primaryKey = 'id';

    protected $fillable = [
        'title', 'content', 'active'
    ];
    public function scopeActive($query) {
        return $query->where('active', true);
    }
}
?>