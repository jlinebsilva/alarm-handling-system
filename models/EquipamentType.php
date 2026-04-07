<?php 

use Illuminate\Database\Eloquent\Model;

class EquipamentType extends Model {
    protected $table = 'equipament_types';

    public $timestamps = false;

    protected $fillable = ['name'];

    public function equipaments() {
        return $this->hasMany(Equipament::class, 'equipament_type_id');
    }
}

?>