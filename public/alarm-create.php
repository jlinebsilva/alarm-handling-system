<?php include '../public/layouts/head.php' ?>
<?php include '../public/layouts/header.php' ?>

<?php
require '../bootstrap/database.php';
require '../models/Equipament.php';
require '../models/AlarmClassification.php';

$equipaments = Equipament::all();
$classifications = AlarmClassification::all();

?>

<div class="container my-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Adicionar alarme
                        <a href="alarms.php" class="btn btn-outline-danger float-end">Voltar</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="../actions/alarm_actions.php" method="post">
                        <div class="mb-3">
                            <label for="">Equipamento Relacionado</label>
                            <select class="form-select mb-3" name="equipament_id" required>
                            <option value="">Selecione um equipamento</option>

                            <?php foreach ($equipaments as $equip): ?>
                                <option value="<?= $equip->equipament_id ?>">
                                    <?= htmlspecialchars($equip->equipament_serie_number) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        </div>
                                                
                        <div class="mb-3">
                            <label for="">Selecione uma Classificação</label>
                            <select class="form-select" name="classification_id" required>
                                <option value="">Selecione uma classificação</option>
                                <?php foreach ($classifications as $c): ?>
                                    <option value="<?= $c->id ?>">
                                        <?= $c->name ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="">Descrição do Alarme</label>
                            <input type="text" name="alarm_description" class="form-control">
                        </div>

                        <div class="mb-3">
                            <button type="submit" name="create_alarm" class="btn btn-primary">
                                Salvar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../public/layouts/footer.php'?>