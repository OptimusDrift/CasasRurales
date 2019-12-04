<body class="hold-transition register-page">
  <div class="register-box">
    <div class="register-logo">
      <img src="<?php echo base_url() . "assets/"; ?>dist/img/WoodenHouse.png"><b>Wooden</b>House
    </div>

    <div class="card">
      <div class="card-body register-card-body">
        <p class="login-box-msg">Registrar una nueva membresía</p>

        <form action="<?php echo base_url();?>index.php/validarRegistro" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Nombre" name="nombre">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Apellido" name="apellido">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="CBU" name="cbu">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="CUIL" name="cuil">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Teléfono" name="telefono">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-phone"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Email" name="mail">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Contraseña" name="contrasena">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Vuelva a escribir la contraseña" name="contrasena">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <a href="<?php echo base_url();?>index.php/welcome" class="text-center">Ya estoy registrado.</a>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Regístrate</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
      <!-- /.form-box -->
    </div><!-- /.card -->
  </div>
  <!-- /.register-box -->

  <!-- jQuery -->
  <script src="<?php echo base_url() . 'assets/'; ?>plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo base_url() . 'assets/'; ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>