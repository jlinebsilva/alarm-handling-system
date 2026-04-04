<?php 
use Illuminate\Database\Eloquent\Model;

class Log extends Model {
    public $timestamps = false;

    protected $fillable = [
        'action',
        'entity',
        'description',
        'created_at'
    ];
}
?>