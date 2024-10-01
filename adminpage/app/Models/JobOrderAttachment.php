<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobOrderAttachment extends Model {
    public $table = 'job_orders_attachments';
    protected $primaryKey = 'id';
    protected $fillable = [
        'job_order_id', 'file_name'
    ];
}
?>