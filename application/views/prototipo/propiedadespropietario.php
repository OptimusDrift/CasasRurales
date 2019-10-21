<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Tus Propiedades</h1>
          </div><!-- /.col -->
<<<<<<< HEAD
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url()."assets/"; ?>login"> Login</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
=======
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

>>>>>>> 47f88fc2cca3907aa727784e0a0c132f027ae80e
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
<<<<<<< HEAD
          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Card title</h5>

                <p class="card-text">
                  <!-- El foreach recorre las propiedades que trajo la consulta, y las lista -->
                  <?php 
                    foreach ($propiedades as $propiedad) { ?> 
                      <ul>
                        <li>  <?php $propiedad->nombre_propiedad; ?>  </li>
                      </ul> 
                  <?php  }  ?>
                  Some quick example text to build on the card title and make up the bulk of the card's
                  content.
                </p>

                <a href="<?php echo base_url()."assets/"; ?>#" class="card-link">Card link</a>
                <a href="<?php echo base_url()."assets/"; ?>#" class="card-link">Another link</a>
              </div>
            </div>

            <div class="card card-primary card-outline">
              <div class="card-body">
                <h5 class="card-title">Card title</h5>

                <p class="card-text">
                  Some quick example text to build on the card title and make up the bulk of the card's
                  content.
                </p>
                <a href="<?php echo base_url()."assets/"; ?>#" class="card-link">Card link</a>
                <a href="<?php echo base_url()."assets/"; ?>#" class="card-link">Another link</a>
              </div>
            </div><!-- /.card -->
          </div>
          <!-- /.col-md-6 -->
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header">
                <h5 class="m-0">Featured</h5>
              </div>
              <div class="card-body">
                <h6 class="card-title">Special title treatment</h6>

                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="<?php echo base_url()."assets/"; ?>#" class="btn btn-primary">Go somewhere</a>
              </div>
            </div>

            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="m-0">Featured</h5>
              </div>
              <div class="card-body">
                <h6 class="card-title">Special title treatment</h6>

                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="<?php echo base_url()."assets/"; ?>#" class="btn btn-primary">Go somewhere</a>
              </div>
            </div>
=======
          <!-- /.col-md-6 -->
          <div class="col-lg-12">
            <?php echo $propStr; ?>
>>>>>>> 47f88fc2cca3907aa727784e0a0c132f027ae80e
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->