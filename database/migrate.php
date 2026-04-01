<?php
require_once 'bootstrap/database.php';

use Illuminate\Database\Capsule\Manager as Capsule;

// ALARMS
if (!Capsule::schema()->hasTable('alarms')) {
    Capsule::schema()->create('alarms', function ($table) {
        $table->increments('alarm_id');
        $table->text('alarm_description');
        $table->dateTime('alarm_register_date');
        $table->string('alarm_equipament');
        $table->string('alarm_classification');
    });

    echo "Tabela alarms criada<br>";
}

// EQUIPAMENTS
if (!Capsule::schema()->hasTable('equipaments')) {
    Capsule::schema()->create('equipaments', function ($table) {
        $table->increments('equipament_id');
        $table->string('equipament_serie_number');
        $table->dateTime('equipament_register_date');
        $table->string('equipament_type');
    });

    echo "Tabela equipaments criada<br>";
}

?>