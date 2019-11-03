<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-image: url(<?php echo base_url() . 'assets/dist/img/fondoinicio.jpg'; ?>); background-size: 100%;">
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <div class="card card-outline card-dark ml-5 col-7">
    <br>
    <h3 class="ml-5">Reserva alojamientos y experiencias únicas.</h3>
    <!-- Left navbar links  form-inline ml-2-->
    <ul class="text-center">
      <form class="form-inline ml-2" action="<?php echo base_url() . 'index.php/buscarcasa'; ?>" method="get">
        <li class=" d-none d-sm-inline">
          <!-- SEARCH FORM -->
          <div class="input-group input-group">
            <input class="form-control" type="search" placeholder="Buscar" aria-label="Buscar" id="poblacion" name="poblacion">
            <div class="input-group-append">
              <button class="btn badge-dark" type="submit">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </li>
        <li class="nav-item d-none d-lg-inline-block">
          <!-- Calendario -->
          <div class="form-inline ml-2">
            <div class="input-group input-group">
              <div class="input-group-prepend">
                <span class="btn badge-dark">
                  <i class="fas fa-calendar-alt"></i>
                </span>
              </div>
              <input class="form-control" type="text" id="reservation" name="fechas">
            </div>
          </div>
          <!-- /Calendario -->
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <div class="form-inline ml-2">
            <div class="input-group input-group">
              <input class="form-control" type="number" aria-label="r" name="cantidad" placeholder="Cantidad de personas" min="1">
            </div>
          </div>
        </li>
        <li class=" d-none d-sm-inline">
          <div class="form-inline ml-2">
            <button type="submit" class="btn  btn-secondary badge-dark">Buscar</button>
          </div>
        </li>
      </form>
      <!-- Meter dentro del form -->
    </ul>
  </div>


  <!-- /.content-wrapper -->
</div>