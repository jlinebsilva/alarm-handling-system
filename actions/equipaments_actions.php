<?php
session_start();

require '../bootstrap/database.php';
require '../models/Equipament.php';
require '../models/Log.php';

date_default_timezone_set('America/Sao_Paulo');
$action_moment = time();


if (isset($_POST['create_equipament'])) {
    try {
        Equipament::create([
            'equipament_serie_number' => $_POST['equipament_serie_number'],
            'equipament_register_date' => date('Y-m-d H:i:s', $action_moment),
            'equipament_type_id' => $_POST['equipament_type_id']
            ]);

            Log::create([
                'action' => 'CREATE',
                'entity' => 'equipament',
                'description' => 'Equipamento criado: ' . $_POST['equipament_serie_number'],
                'created_at' => date('Y-m-d H:i:s', $action_moment)
            ]);

            $_SESSION['message'] = 'Equipamento Criado com Sucesso!';

        } catch (Exception $e) {
            $_SESSION['message'] = 'Erro ao criar equipamento';
        }

        header('Location: ../public/equipaments.php');
        exit;
}

if (isset($_POST['update_equipament'])) {
    try {
        $equip = Equipament::find($_POST['equipament_id']);

        $equip->update([
            'equipament_serie_number' => $_POST['equipament_serie_number'],
            'equipament_type_id' => $_POST['equipament_type_id']
        ]);

        Log::create([
            'action' => 'UPDATE',
            'entity' => 'equipament',
            'description' => 'Equipamento atualizado ID: ' . $_POST['equipament_id'],
            'created_at' => date('Y-m-d H:i:s', $action_moment)
        ]);

        $_SESSION['message'] = 'Equipamento atualizado com sucesso!';

    } catch (Exception $e) {
        $_SESSION['message'] = 'Erro ao atualizar equipamento';
    }

    header('Location: ../public/equipaments.php');
    exit;
}

if (isset($_POST['delete_equipament'])) {
    try {
        Equipament::destroy($_POST['equipament_id']);

        Log::create([
            'action' => 'DELETE',
            'entity' => 'equipament',
            'description' => 'Equipamento deletado ID: ' . $_POST['equipament_id'],
            'created_at' => date('Y-m-d H:i:s', $action_moment)
        ]);

        $_SESSION['message'] = 'Equipamento deletado com sucesso!';

    } catch (Exception $e) {
        $_SESSION['message'] = 'Erro ao deletar equipamento';
    }

    header('Location: ../public/equipaments.php');
    exit;
}

?>