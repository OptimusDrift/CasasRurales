<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <!-- link del usuario -->
    <a href="<?php echo base_url()."assets/"; ?>" class="brand-link">
    <!-- link de la imagen del logo -->
      <img src="<?php echo base_url()."assets/"; ?>dist/img/WoodenHouse.png" alt="WoodenHouse Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Wooden house</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="<?php echo base_url()."assets/"; ?>#" class="d-block">Juan Pablo</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
                <a href="prototipo" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inicio</p>
                </a>
              </li>
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="<?php echo base_url()."assets/"; ?>#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Tus Alquileres
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url()."index.php/"; ?>reservaspendientes" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Reservas Pendientes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url()."index.php/"; ?>propiedadespropietario" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Mis Propiedades</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url()."index.php/"; ?>paquetes" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Mis Paquetes</p>
                </a>
              </li>
            </ul>
          </li>
                    <li class="nav-item has-treeview menu-open">
            <a href="<?php echo base_url()."assets/"; ?>#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Tus Reservas
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url()."index.php/"; ?>#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Reservas Realizadas</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>