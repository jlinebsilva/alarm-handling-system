<?php include_once '../public/layouts/head.php' ?>
<?php include_once '../public/layouts/header.php' ?>

<?php 
require '../bootstrap/database.php';
require '../models/Equipament.php';

$equipaments = Equipament::with('type')->get();

?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Lista de Equipamentos
                        <a href="equipament-create.php" class="btn btn-primary float-end">Adicionar</a>
                    </h4>
                </div>

                <div class="card-body">
                    <?php if (count($equipaments) > 0): ?>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Série</th>
                            <th>Data</th>
                            <th>Tipo</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach($equipaments as $equip): ?>
                            <tr>
                                <td><?= htmlspecialchars($equip['equipament_serie_number']) ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($equip['equipament_register_date'])) ?></td>
                                <td><?= htmlspecialchars($equip->type->name ?? 'N/A') ?></td>
                                <td><a href="equipament-details.php?equipament_id=<?= $equip->equipament_id ?>" class="btn btn-secondary btn-sm">
                                    Visualizar
                                </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php else: ?>
                        <p>Nenhum Equipamento Encontrado</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>  
</div>
    
<?php include_once '../public/layouts/footer.php' ?>