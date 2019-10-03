<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav text-center">
    <form class="form-inline ml-3">
      <li class="nav-item d-none d-sm-inline-block">
        <!-- SEARCH FORM -->
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Buscar" aria-label="Buscar">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
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
            <span class="btn btn-navbar">
              <i class="far fa-calendar-alt"></i>
            </span>
          </div>
          <input class="form-control form-control-navbar text-white-50" type="text" id="reservation" aria-label="r">
        </div>
      <!-- /Calendario -->
      </li>
      </form>
      <!-- Meter dentro del form -->
      <li class="nav-item d-none d-sm-inline-block">
        <div class="form-inline ml-2">
          <a href="<?php echo base_url()."index.php/buscarcasa"; ?>"><button type="submit" class="btn btn-navbar btn-secondary btn-sm">Buscar</button></a>
        </div>
      </li>
    </ul>
  

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header">3 Notificaciones</span>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 Nuevos Reportes
            <span class="float-right text-muted text-sm">2 dias</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">Ver Todas Las Notificaciones</a>
        </div>
      </li>
    </ul>
  </nav>




  