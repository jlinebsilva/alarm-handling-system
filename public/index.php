<?php include_once '../public/layouts/head.php' ?>
<?php include_once '../public/layouts/header.php' ?>

<?php 
require '../src/Config/connection.php';

$alarms = [];
$alarmQuery = mysqli_query($connection, "SELECT * FROM alarms");

if ($alarmQuery) {
    $alarms = mysqli_fetch_all($alarmQuery, MYSQLI_ASSOC);
}

$equipaments = [];
$equipQuery = mysqli_query($connection, "SELECT * FROM equipaments");

if ($equipQuery) {
    $equipaments = mysqli_fetch_all($equipQuery, MYSQLI_ASSOC);
}
?>

<!-- ALARMS -->
<div class="container mt-4">
  <?php include 'message.php'?>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4>Últimos Alarmes
            <a href="alarm-create.php" class="btn btn-primary float-end">Adicionar</a>
          </h4>
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
                <td><?= htmlspecialchars($alarm['alarm_description']) ?></td>
                <td><?= date('d/m/Y H:i', strtotime($alarm['alarm_register_date'])) ?></td>
                <td><?= htmlspecialchars($alarm['alarm_equipament']) ?></td>
                <td><?= htmlspecialchars($alarm['alarm_classification']) ?></td>
                <td>
                  <a href="alarm-details.php?alarm_id=<?= $alarm['alarm_id'] ?>" class="btn btn-secondary btn-sm">
                    Visualizar
                  </a>
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

  <!-- EQUIPAMENTS -->
  <div class="row mt-5">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4>Últimos Equipamentos
            <a href="/public/equipament-create.php" class="btn btn-primary float-end">Adicionar</a>
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
                <td><?= htmlspecialchars($equip['equipament_type']) ?></td>
                <td>
                  <a href="equipament-details.php?equipament_id=<?= $equip['equipament_id'] ?>" class="btn btn-secondary btn-sm">
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