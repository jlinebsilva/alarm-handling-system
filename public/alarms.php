<?php include_once '../public/layouts/head.php' ?>
<?php include_once '../public/layouts/header.php' ?>

<?php
require '../bootstrap/database.php';
require '../models/Alarm.php';

$alarms = Alarm::with(['equipament', 'classification'])->get();
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Lista de Alarmes</h4>
                    <div class="d-flex gap-2">
                        <a href="alarm-occurrences.php" class="btn btn-dark float-end">Atuados</a>
                        <a href="alarm-create.php" class="btn btn-primary float-end">Adicionar</a>
                    </div>
                </div>

                <div class="card-body">
                    <?php if (count($alarms) > 0): ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Descrição do Alarme</th>
                                <th>Data de Cadastro</th>
                                <th>Equipamento Relacionado</th>
                                <th>Classificação</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($alarms as $alarm): ?>
                            <tr>
                                <td><?= htmlspecialchars($alarm->alarm_description) ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($alarm->alarm_register_date)) ?></td>
                                <td><?= $alarm->equipament->equipament_serie_number ?? 'N/A' ?></td>
                                <td><?= $alarm->classification->name ?? 'N/A' ?></td>
                                <td>
                                    <a href="alarm-details.php?alarm_id=<?= $alarm->alarm_id ?>" class="btn btn-secondary btn-sm">
                                        Visualizar
                                    </a>
                                    <form action="../actions/alarm_actions.php" method="post" class="d-inline">
                                        <input type="hidden" name="alarm_id" value="<?= $alarm->alarm_id ?>">
                                        <button type="submit" name="delete_alarm" class="btn btn-danger btn-sm ms-2" onclick="return confirm('Tem certeza que deseja excluir este alarme?');">
                                            Apagar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php else: ?>
                        <p>Nenhum Alarme Encontrado</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>  
</div>
    
<?php include_once '../public/layouts/footer.php' ?>