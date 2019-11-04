<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark">
  <!-- Left navbar links -->
  <ul class="navbar-nav text-center">
    <form class="form-inline ml-1" action="<?php echo base_url() . 'index.php/buscarcasa'; ?>" method="get">
      <li class="nav-item d-none d-sm-inline-block">
        <!-- SEARCH FORM -->
        <div class="input-group input-group-sm">
          <input class="form-control" type="search" placeholder="Buscar" aria-label="Buscar" name="poblacion">
          <div class="input-group-append">
            <button class="btn btn-navbar badge-dark" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <!-- Calendario -->
        <div class="form-inline ml-2">
          <div class="input-group input-group-sm">
            <div class="input-group-prepend">
              <span class="btn btn-navbar badge-dark">
                <i class="fas fa-calendar-alt"></i>
              </span>
            </div>
            <input class="form-control" type="text" id="reservation" aria-label="r" name="fechas">
          </div>
        </div>
        <!-- /Calendario -->
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <div class="form-inline ml-2">
          <div class="input-group input-group-sm">
            <input class="form-control" type="number" aria-label="r" name="cantidad" placeholder="Cantidad de personas" min="1">
          </div>
        </div>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <div class="form-inline ml-2">
          <button type="submit" class="btn btn-secondary btn-sm">Buscar</button>
        </div>
      </li>
    </form>
  </ul>


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
       
         <?php echo $notiAlerta ?>
         
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item dropdown-footer">Ver Todas Las Notificaciones</a>
      </div>
    </li>
  </ul>
</nav>