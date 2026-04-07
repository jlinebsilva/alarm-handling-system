<?php

use Illuminate\Database\Eloquent\Model;

class AlarmClassification extends Model {
    protected $table = 'alarm_classifications';

    public $timestamps = false;

    protected $fillable = ['name'];
}

?>