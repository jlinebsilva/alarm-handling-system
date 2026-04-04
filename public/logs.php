<?php
require '../bootstrap/database.php';
require '../models/Log.php';

$search = $_GET['search'] ?? '';
$order = $_GET['order'] ?? 'created_at';
$direction = $_GET['direction'] ?? 'desc';

$query = Log::query();

if ($search) {
    $query->where('description', 'like', "%$search%");
}

$logs = $query->orderBy($order, $direction)->get();
?>

<?php include './layouts/head.php'; ?>
<?php include './layouts/header.php'; ?>

<div class="container mt-4">
    <h3>Logs do Sistema</h3>

    <!-- FILTRO -->
    <form method="GET" class="mb-3">
        <div class="d-flex gap-2">
            <input type="text" name="search" class="form-control" placeholder="Buscar..." value="<?= $search ?>">
            <button class="btn btn-primary">Filtrar</button>
        </div>
    </form>

    <!-- TABELA -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th><a href="?order=action">Ação</a></th>
                <th><a href="?order=entity">Entidade</a></th>
                <th>Descrição</th>
                <th><a href="?order=created_at">Data</a></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($logs as $log): ?>
            <tr>
                <td><?= $log->action ?></td>
                <td><?= $log->entity ?></td>
                <td><?= $log->description ?></td>
                <td><?= date('d/m/Y H:i', strtotime($log->created_at)) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include './layouts/footer.php'; ?>