<?php

use Illuminate\Database\Eloquent\Model;

class Alarm extends Model {
    protected $table = 'alarms';
    protected $primaryKey = 'alarm_id';

    public $timestamps = false;

    protected $fillable = [
        'alarm_description',
        'alarm_register_date',
        'equipament_id',
        'alarm_classification_id',
        'is_active',
    ];

    public function equipament() {
        return $this->belongsTo(Equipament::class, 'equipament_id');
    }

    public function classification() {
        return $this->belongsTo(AlarmClassification::class, 'alarm_classification_id');
    }

}

?>