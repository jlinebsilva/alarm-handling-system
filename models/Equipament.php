<?php

use Illuminate\Database\Eloquent\Model;

class Equipament extends Model {
    protected $table = 'equipaments';
    protected $primaryKey = 'equipament_id';

    public $timestamps = false;

    public function alarms() {
        return $this->hasMany(Alarm::class, 'equipament_id');
    }

    public function type() {
        return $this->belongsTo(EquipamentType::class, 'equipament_type_id');
    }

    protected $fillable = [
        'equipament_serie_number',
        'equipament_register_date',
        'equipament_type_id'
    ];
}

?>