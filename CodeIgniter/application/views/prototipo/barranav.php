<body class="hold-transition sidebar-mini-collapse">
<div class="wrapper">
<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo base_url()."index.php/"; ?>prototipo" class="nav-link">Inicio</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Buscar" aria-label="Buscar">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
      <!-- Calendario -->
      <div class="form-inline ml-2">
        <div class="input-group input-group-sm">
          <div class="input-group-prepend">
            <span class="btn btn-navbar">
              <i class="far fa-calendar-alt"></i>
            </span>
          </div>
          <input class="form-control form-control-navbar" type="text" id="reservation">
        </div>
      <!-- /Calendario -->
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav m-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="<?php echo base_url()."assets/"; ?>#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header">3 Notificaciones</span>
          <div class="dropdown-divider"></div>
          <a href="<?php echo base_url()."assets/"; ?>#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 Nuevos Reportes
            <span class="float-right text-muted text-sm">2 dias</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?php echo base_url()."assets/"; ?>#" class="dropdown-item dropdown-footer">Ver todas las notificaciones</a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->