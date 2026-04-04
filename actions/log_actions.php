<?php 
session_start();

require '../bootstrap/database.php';
require '../models/Log.php';

date_default_timezone_set('America/Sao_Paulo');
$moment = time();

use Log;

Log::create([
    'action' => 'CREATE',
    'entity' => 'alarm',
    'description' => 'Alarme criado: ' . $_POST['alarm_description'],
    'created_at' => date('Y-m-d H:i:s', $moment),

])
?>