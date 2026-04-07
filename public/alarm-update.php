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
                        <h4>Editar alarme
                            <a href="alarms.php" class="btn btn-outline-danger float-end">
                                Voltar
                            </a>
                        </h4>
                    </div>

                    <div class="card-body">
                        <?php if ($alarm): ?>
                        <form action="../actions/alarm_actions.php" method="POST">
                            <input type="hidden" name="alarm_id" value="<?= $alarm->alarm_id ?>" >
                            <div class="mb-3">
                                <label for="">Descrição do Alarme</label>
                                <input type="text" name="alarm_description" value="<?= htmlspecialchars($alarm->alarm_description) ?>" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="">Data de Cadastro</label>
                                <input type="datetime-local" name="alarm_register_date" value="<?= $alarm->alarm_register_date ?>" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="">Equipamento Relacionado</label>
                                <select name="equipament_id" class="form-select" required>
                                    <option value="">Selecione um equipamento</option>
                                    <?php 
                                        $equipaments = Equipament::all();
                                        foreach ($equipaments as $equip): 
                                    ?>
                                        <option value="<?= $equip->equipament_id ?>" <?= $equip->equipament_id == $alarm->equipament_id ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($equip->equipament_serie_number) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="">Selecione uma Classificação</label>
                                <select class="form-select" name="classification_id" required>
                                    <option value="">Selecione uma classificação</option>
                                    <?php 
                                        $classifications = AlarmClassification::all();
                                        foreach ($classifications as $c): 
                                    ?>
                                        <option value="<?= $c->id ?>" <?= $c->id == $alarm->alarm_classification_id ? 'selected' : '' ?>>
                                            <?= $c->name ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <button type="submit" name="update_alarm" class="btn btn-warning">
                                    Salvar alterações
                                </button>
                            </div>
                        </form>
                        <?php else: ?>
                            <h5>Alarme não encontrado</h5>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<?php include '../public/layouts/footer.php' ?>