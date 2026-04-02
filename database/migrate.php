<?php 
require_once 'bootstrap/database.php';

use Illuminate\Database\Capsule\Manager as Capsule;


// EQUIPAMENT TYPES 
if (!Capsule::schema()->hasTable('equipament_types')) {
    Capsule::schema()->create('equipament_types', function ($table) {
        $table->increments('id');
        $table->string('name');
    });

    echo "equipament_types CRIADA\n";
}

// ALARM CLASSIFICATIONS
if (!Capsule::schema()->hasTable('alarm_classifications')) {
    Capsule::schema()->create('alarm_classifications', function ($table) {
        $table->increments('id');
        $table->string('name');
    });

    echo "alarm_classifications CRIADA\n";
}


// EQUIPAMENTS
if (!Capsule::schema()->hasTable('equipaments')) {
    Capsule::schema()->create('equipaments', function ($table) {
        $table->increments('equipament_id');
        $table->string('equipament_serie_number');
        $table->timestamp('equipament_register_date')->useCurrent();

        $table->unsignedInteger('equipament_type_id');
        $table->foreign('equipament_type_id')
            ->references('id')
            ->on('equipament_types');
    });

    echo "equipaments CRIADA\n";
}

// ALARMS
if (!Capsule::schema()->hasTable('alarms')) {
    Capsule::schema()->create('alarms', function ($table) {
        $table->increments('alarm_id');
        $table->text('alarm_description');
        $table->timestamp('alarm_register_date')->useCurrent();

        $table->boolean('is_active')->default(true);

        $table->unsignedInteger('equipament_id');
        $table->foreign('equipament_id')
            ->references('equipament_id')
            ->on('equipaments')
            ->onDelete('cascade');

        $table->unsignedInteger('classification_id');
        $table->foreign('classification_id')
            ->references('id')
            ->on('alarm_classifications');
    });

    echo "alarms CRIADA\n";
}


// ALARM OCCURRENCES
if (!Capsule::schema()->hasTable('alarm_occurrences')) {
    Capsule::schema()->create('alarm_occurrences', function ($table) {
        $table->increments('id');

        $table->unsignedInteger('alarm_id');
        $table->foreign('alarm_id')
            ->references('alarm_id')
            ->on('alarms')
            ->onDelete('cascade');

        $table->timestamp('started_at');
        $table->timestamp('ended_at')->nullable();
        $table->string('status');

        $table->timestamps();
    });

    echo "alarm_occurrences CRIADA\n";
}

// LOGS
if (!Capsule::schema()->hasTable('logs')) {
    Capsule::schema()->create('logs', function ($table) {
        $table->increments('id');
        $table->string('action');
        $table->string('entity');
        $table->text('description');
        $table->timestamp('created_at')->useCurrent();
    });

    echo "logs CRIADA\n";
}


// SEED - EQUIPAMENT TYPES
if (Capsule::table('equipament_types')->count() == 0) {
    Capsule::table('equipament_types')->insert([
        ['name' => 'Tensão'],
        ['name' => 'Corrente'],
        ['name' => 'Óleo']
    ]);

    echo "equipament_types POPULADA\n";
}

// SEED - ALARM CLASSIFICATIONS
if (Capsule::table('alarm_classifications')->count() == 0) {
    Capsule::table('alarm_classifications')->insert([
        ['name' => 'Urgente'],
        ['name' => 'Emergente'],
        ['name' => 'Ordinário']
    ]);

    echo "alarm_classifications POPULADA\n";
}


echo "\n✅ MIGRATION FINALIZADA";

?>