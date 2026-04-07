<?php include '../public/layouts/head.php' ?>
<?php include '../public/layouts/header.php' ?>

<?php
require '../bootstrap/database.php';
require '../models/EquipamentType.php';

$types = EquipamentType::all();
?>

<div class="container my-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Adicionar equipamento
                        <a href="equipaments.php" class="btn btn-outline-danger float-end">Voltar</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="../actions/equipaments_actions.php" method="post">
                        <div class="mb-3">
                            <label for="">Número de Série</label>
                            <input type="text" name="equipament_serie_number" class="form-control" required>
                        </div>
                                    
                        <label for="">Selecione um Tipo</label>
                        <select class="form-select mb-3" name="equipament_type_id" required>
                            <option value="">Selecione um tipo</option>
                            <?php foreach ($types as $type): ?>
                                <option value="<?= $type->id ?>">
                                    <?= $type->name ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <div class="mb-3">
                            <button type="submit" name="create_equipament" class="btn btn-primary">
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