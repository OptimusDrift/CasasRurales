<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <!-- link del usuario -->
  <a href="<?php echo base_url() . "index.php/paginaInicial"; ?>" class="brand-link">
    <!-- link de la imagen del logo -->
    <img src="<?php echo base_url() . "assets/"; ?>dist/img/WoodenHouse.png" alt="WoodenHouse Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Wooden House</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="info">
        <h5 class="card-text" style="color:#cccccc"><?php echo ($_SESSION['nombre'] . " " . $_SESSION["apellido"]); ?></h5>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="paginaInicial" class="nav-link <?php echo $inicioactivo ?>">
            <i class="far fas fa-home nav-icon"></i>
            <p>Inicio</p>
          </a>
        </li>
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview <?php echo $misPropiedadesOpen ?>">
          <a href="<?php echo base_url() . "assets/"; ?>#" class="nav-link <?php echo $misalquileresactivo ?>">
            <i class="nav-icon fas fa-building"></i>
            <p>
              Mis Propiedades
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo base_url() . "index.php/"; ?>reservaspendientes" class="nav-link <?php echo $reservapendienteactivo ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Reservas Pendientes</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url() . "index.php/"; ?>controladorPropiedades" class="nav-link <?php echo $propiedadactivo ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Ver Propiedades</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url() . "index.php/"; ?>mispaquetes" class="nav-link <?php echo $paqueteactivo ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Mis Paquetes</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview <?php echo $MisReservasOpen ?>">
          <a href="<?php echo base_url() . "assets/"; ?>#" class="nav-link <?php echo $misreservaactivo ?>">
            <i class="nav-icon fas ion-ios-book"></i>
            <p>
              Mis Reservas
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo base_url() . "index.php/ReservasrealizadasCI"; ?>" class="nav-link <?php echo $reservaactivo ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Reservas Realizadas</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="<?php echo base_url() . "index.php/CloseSession"; ?>#" class="nav-link active bg-gradient-red">
            <i class="nav-item fas fa-door-closed"></i>
            <p>
              Cerrar sesion
              <i class="right fas fa-exclamation-triangle"></i>
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>