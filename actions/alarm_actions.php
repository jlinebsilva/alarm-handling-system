<?php
session_start();

require '../bootstrap/database.php';
require '../models/Alarm.php';
require '../models/Log.php';

date_default_timezone_set('America/Sao_Paulo');
$action_moment = time();


if (isset($_POST['create_alarm'])) {
    try {
        Alarm::create([
            'alarm_description' => $_POST['alarm_description'],
            'alarm_classification_id' => $_POST['classification_id'],
            'equipament_id' => $_POST['equipament_id'],
            'alarm_register_date' => date('Y-m-d H:i:s', $action_moment),
        ]);

        Log::create([
            'action' => 'CREATE',
            'entity' => 'alarm',
            'description' => 'Alarme criado: ' . $_POST['alarm_description'],
            'created_at' => date('Y-m-d H:i:s', $action_moment)
        ]);

        $_SESSION['message'] = 'Alarme criado com sucesso!';

    } catch (Exception $e) {
        $_SESSION['message'] = 'Erro ao criar alarme' . $e->getMessage();
        die($e->getMessage());
    }

    header('Location: ../public/alarms.php');
    exit;
}

if (isset($_POST['update_alarm'])) {
    try {
        $alarm = Alarm::find($_POST['alarm_id']);

        $alarm->update([
            'alarm_description' => $_POST['alarm_description'],
            'alarm_classification_id' => $_POST['classification_id'],
            'equipament_id' => $_POST['equipament_id']
        ]);

        Log::create([
            'action' => 'UPDATE',
            'entity' => 'alarm',
            'description' => 'Alarme atualizado ID: ' . $_POST['alarm_id'],
            'created_at' => date('Y-m-d H:i:s', $action_moment)
        ]);

        $_SESSION['message'] = 'Alarme atualizado com sucesso!';

    } catch (Exception $e) {
        $_SESSION['message'] = 'Erro ao atualizar alarme';
    }

    header('Location: ../public/alarms.php');
    exit;
}

if (isset($_POST['delete_alarm'])) {
    try {
        Alarm::destroy($_POST['alarm_id']);

        Log::create([
            'action' => 'DELETE',
            'entity' => 'alarm',
            'description' => 'Alarme deletado ID: ' . $_POST['alarm_id'],
            'created_at' => date('Y-m-d H:i:s', $action_moment)
        ]);

        $_SESSION['message'] = 'Alarme deletado com sucesso!';

    } catch (Exception $e) {
        $_SESSION['message'] = 'Erro ao deletar alarme';
    }

    header('Location: ../public/alarms.php');
    exit;
}

?>