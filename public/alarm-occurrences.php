<?php
require '../bootstrap/database.php';
require '../models/AlarmOccurrence.php';
require '../models/Alarm.php';
require '../models/Equipament.php';

$search = $_GET['search'] ?? '';
$order = $_GET['order'] ?? 'started_at';
$direction = $_GET['direction'] ?? 'desc';

$query = AlarmOccurrence::with('alarm.equipament');

if ($search) {
    $query->whereHas('alarm', function ($q) use ($search) {
        $q->where('alarm_description', 'like', "%$search%");
    });
}

$occurrences = $query->orderBy($order, $direction)->get();
?>

<?php include './layouts/head.php'; ?>
<?php include './layouts/header.php'; ?>

<div class="container mt-4">
    <h3>Alarmes Atuados</h3>

    <!-- FILTRO -->
    <form method="GET" class="mb-3">
        <div class="d-flex gap-2">
            <input type="text" name="search" class="form-control" placeholder="Buscar por descrição..." value="<?= $search ?>">
            <button class="btn btn-primary">Filtrar</button>
        </div>
    </form>

    <!-- TOP 3 -->
    <?php
    use Illuminate\Database\Capsule\Manager as DB;

    $topAlarms = DB::table('alarm_occurrences')
        ->select('alarm_id', DB::raw('COUNT(*) as total'))
        ->groupBy('alarm_id')
        ->orderByDesc('total')
        ->limit(3)
        ->get();
    ?>

    <div class="mb-3">
        <h5>Top 3 Alarmes mais atuados:</h5>
        <ul>
            <?php foreach ($topAlarms as $top): 
                $alarm = \Alarm::find($top->alarm_id);
            ?>
                <li>
                    <?= $alarm->alarm_description ?> (<?= $top->total ?> vezes)
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <!-- TABELA -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th><a href="?order=started_at">Entrada</a></th>
                <th><a href="?order=ended_at">Saída</a></th>
                <th>Status</th>
                <th>Alarme</th>
                <th>Equipamento</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($occurrences as $o): ?>
            <tr>
                <td><?= date('d/m/Y H:i', strtotime($o->started_at)) ?></td>
                <td><?= $o->ended_at ? date('d/m/Y H:i', strtotime($o->ended_at)) : '-' ?></td>
                <td>
                    <span class="badge bg-<?= $o->status === 'ativo' ? 'danger' : 'success' ?>">
                        <?= $o->status ?>
                    </span>
                </td>
                <td><?= $o->alarm->alarm_description ?></td>
                <td><?= $o->alarm->equipament->equipament_serie_number ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include './layouts/footer.php'; ?>