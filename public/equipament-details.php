<?php include '../public/layouts/head.php' ?>
<?php include '../public/layouts/header.php' ?>

<?php
    require '../bootstrap/database.php';
    require '../models/Equipament.php';
    require '../models/EquipamentType.php';

    $equipament = null;
    if (isset($_GET['equipament_id'])) {
        $equipament = Equipament::with('type')->find($_GET['equipament_id']);
    }
?>


<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Visualizar equipamento
                        <a href="equipaments.php" class="btn btn-outline-danger float-end">
                            Voltar
                        </a>
                    </h4>
                </div>

                <div class="card-body">
                    <?php if ($equipament): ?>
                    <form action="" method="">
                        <input type="hidden" name="equipament_id" value="<?= $equipament->equipament_id ?>" >
                        <div class="mb-3">
                            <label for="">Número de Série</label>
                            <input disabled type="text" name="equipament_serie_number" value="<?= htmlspecialchars($equipament->equipament_serie_number) ?>" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">Data de Cadastro</label>
                            <input disabled type="datetime-local" name="equipament_register_date" value="<?= $equipament->equipament_register_date ?>" class="form-control">
                        </div>
                        
                        <div class="mb-3">
                            <label for="">Tipo</label>
                            <input disabled type="text" class="form-control" value="<?= htmlspecialchars($equipament->type->name ?? 'N/A') ?>">
                        </div>
                        
                        <div class="mb-3">
                            <a href="equipament-update.php?equipament_id=<?= $equipament->equipament_id ?>" class="btn btn-outline-success">
                                Editar informações
                            </a>
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