<?php include 'head.php' ?>

<?php 
  $current_page_name = basename($_SERVER['PHP_SELF']);

  function isPageActive($page) {
    global $current_page_name;
    return ($current_page_name == $page) ? 'active bg-secondary' : '';
  }
?>

<div class="container">
  <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
    <a href="../public/index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
      <i class="bi bi-shield-check me-2" style="font-size: 1.8rem;" ></i>
      <span class="fs-3">Gerenciamento de Alarmes</span>
    </a>

    <ul class="nav nav-pills">
      <li class="nav-item">
        <a href="../public/index.php" aria-current="page"
          class="nav-link <?php echo isPageActive('index.php') ?>"
        >
          Home
        </a>
      </li>
      <li class="nav-item">
        <a href="../public/alarms.php" 
          class="nav-link <?php echo isPageActive('alarms.php') ?>"
        >
          Alarmes
        </a>
      </li>
      <li class="nav-item">
        <a href="../public/equipaments.php"
          class="nav-link <?php echo isPageActive('equipaments.php') ?>"
        >
          Equipamentos
        </a>
      </li>
      <li class="nav-item">
        <a href="../public/logs.php"
          class="nav-link <?php echo isPageActive('logs.php') ?>"
        >
          Logs
        </a>
      </li>
    </ul>
  </header>
</div>

<body class="bg-body-tertiary">