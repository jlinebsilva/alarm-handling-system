<?php
require '../bootstrap/database.php';
require '../models/AlarmOccurrence.php';
require '../models/Alarm.php';
require '../models/Equipament.php';

$search = $_GET['search'] ?? '';
$order = $_GET['order'] ?? 'started_at';
$direction = $_GET['direction'] ?? 'desc';

$alarms = Alarm::with('equipament')->latest('alarm_id')->get();

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

    <div class="card mb-4">
        <div class="card-header">
            <h5>Registrar alarme atuado</h5>
        </div>
        <div class="card-body">
            <?php if (count($alarms) > 0): ?>
            <form action="../actions/alarm_occurrences.php" method="post" class="row g-2 align-items-end">
                <div class="col-md-8">
                    <label class="form-label">Selecione um alarme</label>
                    <select name="alarm_id" class="form-select" required>
                        <option value="">Selecione um alarme existente</option>
                        <?php foreach ($alarms as $alarm): ?>
                            <option value="<?= $alarm->alarm_id ?>">
                                <?= htmlspecialchars($alarm->alarm_description) ?> - <?= htmlspecialchars($alarm->equipament->equipament_serie_number ?? 'N/A') ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" name="create_occurrence" class="btn btn-primary w-100">
                        Registrar ocorrência
                    </button>
                </div>
            </form>
            <?php else: ?>
                <p class="mb-0">Não há alarmes cadastrados. Cadastre um alarme antes de registrar ocorrências.</p>
            <?php endif; ?>
        </div>
    </div>

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
                <th>Ações</th>
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
                <td>
                    <?php if ($o->status === 'ativo'): ?>
                        <form action="../actions/alarm_occurrences.php" method="post" class="d-inline">
                            <input type="hidden" name="occurrence_id" value="<?= $o->id ?>">
                            <button type="submit" name="close_occurrence" class="btn btn-success btn-sm">
                                Encerrar
                            </button>
                        </form>
                    <?php else: ?>
                        -
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include './layouts/footer.php'; ?>