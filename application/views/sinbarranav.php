<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark navbar-dark">

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Notifications Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        <span class="badge badge-warning navbar-badge"><?php echo $numAlertas; ?> </span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-header"><?php echo $numAlertas; ?> Notificaciones</span>
        <a href="#" class="dropdown-item">
          <i class="fas fa-file mr-2"></i> <?php echo $numAlertas . " Nuevas " . $tipoAlerta; ?>
          <span class="float-right text-muted text-sm"><?php //dias? 
                                                        ?></span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item dropdown-footer">Ver Todas Las Notificaciones</a>
      </div>
    </li>
  </ul>
</nav>