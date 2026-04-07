<?php
session_start();

require '../bootstrap/database.php';
require '../models/AlarmOccurrence.php';
require '../models/Alarm.php';
require '../models/Log.php';

date_default_timezone_set('America/Sao_Paulo');
$action_moment = time();

if (isset($_POST['create_occurrence'])) {
    try {
        AlarmOccurrence::create([
            'alarm_id' => $_POST['alarm_id'],
            'started_at' => date('Y-m-d H:i:s', $action_moment),
            'status' => 'ativo'
        ]);

        Log::create([
            'action' => 'CREATE',
            'entity' => 'alarm_occurrence',
            'description' => 'Ocorrência criada para alarme ID: ' . $_POST['alarm_id'],
            'created_at' => date('Y-m-d H:i:s', $action_moment)
        ]);

        $_SESSION['message'] = 'Ocorrência registrada com sucesso!';
    } catch (Exception $e) {
        $_SESSION['message'] = 'Erro ao registrar ocorrência';
    }

    header('Location: ../public/alarm-occurrences.php');
    exit;
}

if (isset($_POST['close_occurrence'])) {
    try {
        $occurrence = AlarmOccurrence::find($_POST['occurrence_id']);
        if ($occurrence) {
            $occurrence->update([
                'ended_at' => date('Y-m-d H:i:s', $action_moment),
                'status' => 'resolvido'
            ]);

            Log::create([
                'action' => 'UPDATE',
                'entity' => 'alarm_occurrence',
                'description' => 'Ocorrência encerrada ID: ' . $_POST['occurrence_id'],
                'created_at' => date('Y-m-d H:i:s', $action_moment)
            ]);

            $_SESSION['message'] = 'Ocorrência encerrada com sucesso!';
        }
    } catch (Exception $e) {
        $_SESSION['message'] = 'Erro ao encerrar ocorrência';
    }

    header('Location: ../public/alarm-occurrences.php');
    exit;
}

?>