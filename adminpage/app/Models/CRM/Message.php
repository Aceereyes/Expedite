<?php
namespace App\Models\CRM;
use Illuminate\Database\Eloquent\Model;

class Message extends Model {
    public $table = 'crm_messages';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 'email', 'subject', 'message', 'done'
    ];
    public function scopeDone($query) {
        return $query->where('done', true);
    }
    public function scopeNotDone($query) {
        return $query->where('done', false);
    }
}
?>