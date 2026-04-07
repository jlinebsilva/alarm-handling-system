<?php include '../public/layouts/head.php' ?>
<?php include '../public/layouts/header.php' ?>

<?php
    require '../bootstrap/database.php';
    require '../models/Alarm.php';
    require '../models/Equipament.php';
    require '../models/AlarmClassification.php';
    
    $alarm = null;
    if (isset($_GET['alarm_id'])) {
        $alarm = Alarm::with(['equipament', 'classification'])->find($_GET['alarm_id']);
    }
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Visualizar alarme
                        <a href="alarms.php" class="btn btn-outline-danger float-end">
                            Voltar
                        </a>
                    </h4>
                </div>

                <div class="card-body">
                    <?php if ($alarm): ?>
                    <form action="" method="">
                        <input type="hidden" name="alarm_id" value="<?= $alarm->alarm_id ?>" >
                        <div class="mb-3">
                            <label for="">Equipamento Relacionado</label>
                            <input disabled type="text" name="alarm_equipament" value="<?= $alarm->equipament->equipament_serie_number ?? 'N/A' ?>" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">Data de Cadastro</label>
                            <input disabled type="datetime-local" name="alarm_register_date" value="<?= $alarm->alarm_register_date ?>" class="form-control">
                        </div>
                        
                        <label for="">Classificação</label>
                        <input disabled type="text" class="form-control mb-3" value="<?= $alarm->classification->name ?? 'N/A' ?>">

                        <div class="mb-3">
                            <label for="">Descrição do Alarme</label>
                            <input disabled type="text" name="alarm_description" value="<?= htmlspecialchars($alarm->alarm_description) ?>" class="form-control">
                        </div>
                        
                        <div class="mb-3">
                            <a href="alarm-update.php?alarm_id=<?= $alarm->alarm_id ?>" class="btn btn-outline-success">
                                Editar informações
                            </a>
                        </div>
                    </form>
                    <?php else: ?>
                        <h5>Alarme Não Encontrado</h5>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>