<?php
session_start();

require '../bootstrap/database.php';
require '../models/Alarm.php';

$id = $_GET['id'];

$alarm = Alarm::find($id);

$alarm->is_active = !$alarm->is_active;
$alarm->save();

header('Location: ../public/alarms.php');
?>