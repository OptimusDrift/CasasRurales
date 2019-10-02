<body background="<?php echo base_url()."assets/"; ?>fondoLogin.jpg">
<br>
<br>
<br>
<br>
<!-- Horizontal Form -->
<div class="row justify-content-center">
    <div class="card-dark card col-4">
        <div class="card-header">
        <h3 class="card-title">Iniciar Sesión</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form class="form-horizontal">
        <div class="card-body">
            <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
            </div>
            </div>
            <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 control-label">Contraseña</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="inputPassword" placeholder="Contraseña">
            </div>
            </div>
        </div>
        </form> <!--Mover el /form abajo del /div ante ultimo -->
        <!-- /.card-body -->
        <div class="card-footer">
           <!--type="submit" quitar <a> y agregar el type-->
           <a href="<?php echo base_url().'index.php/prototipo';?>"><button class="btn btn-dark">Iniciar Sesión</button></a> 
        </div>
    <!-- /.card-footer -->
</div>