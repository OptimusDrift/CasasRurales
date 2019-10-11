<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-image: url(<?php echo base_url().'assets/dist/img/fondoinicio.jpg'; ?>); background-size: 100%;"> 
<br>
<br>
<br>
<br>
<br>
<br>
<div class="card card-outline card-dark ml-5 col-5">
<br>
<!-- Left navbar links  form-inline ml-2-->
<ul class="text-center">
    <form class="form-inline ml-2" action="<?php echo base_url().'index.php/buscarcasa'; ?>" method="post">
      <h3>Reserva alojamientos y experiencias únicas.</h3>
      <li class=" d-none d-sm-inline">
        <!-- SEARCH FORM -->
      <div class="input-group input-group">
        <input class="form-control" type="search" placeholder="Buscar" aria-label="Buscar">
        <div class="input-group-append">
          <button class="btn badge-dark" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
      </li>
      <li class=" d-none d-sm-inline">
      <!-- Calendario -->
      <div class="form-inline ml-2">
        <div class="input-group input-group">
          <div class="input-group-prepend">
            <span class="btn badge-dark">
              <i class="far fa-calendar-alt"></i>
            </span>
          </div>
          <input class="form-control" type="text" id="reservation">
        </div>
      <!-- /Calendario -->
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
