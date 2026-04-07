<?php include '../public/layouts/head.php' ?>
<?php include '../public/layouts/header.php' ?>

<?php
    require '../bootstrap/database.php';
    require '../models/Equipament.php';
    require '../models/EquipamentType.php';

    $equipament = null;
    if (isset($_GET['equipament_id'])) {
        $equipament = Equipament::find($_GET['equipament_id']);
    }
?>


<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Editar equipamento
                        <a href="equipaments.php" class="btn btn-outline-danger float-end">
                            Voltar
                        </a>
                    </h4>
                </div>

                <div class="card-body">
                    <?php if ($equipament): ?>
                    <form action="../actions/equipaments_actions.php" method="POST">
                        <input type="hidden" name="equipament_id" value="<?= $equipament->equipament_id ?>" >
                        <div class="mb-3">
                            <label for="">Número de Série</label>
                            <input type="text" name="equipament_serie_number" value="<?= htmlspecialchars($equipament->equipament_serie_number) ?>" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="">Data de Cadastro</label>
                            <input type="datetime-local" name="equipament_register_date" value="<?= $equipament->equipament_register_date ?>" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="">Selecione um Tipo</label>
                            <select class="form-select mb-3" name="equipament_type_id" required>
                                <option value="">Selecione um tipo</option>
                                <?php foreach (EquipamentType::all() as $type): ?>
                                    <option value="<?= $type->id ?>" <?= $type->id == $equipament->equipament_type_id ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($type->name) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <button type="submit" name="update_equipament" class="btn btn-warning">
                                Salvar alterações
                            </button>
                        </div>
                    </form>
                    <?php else: ?>
                        <h5>Equipamento Não Encontrado</h5>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</div>
    
<?php include '../public/layouts/footer.php' ?>