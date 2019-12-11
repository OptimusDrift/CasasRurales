<body class="hold-transition register-page">
  <div class="register-box">
    <div class="register-logo">
      <img src="<?php echo base_url() . "assets/"; ?>dist/img/WoodenHouse.png"><b>Wooden</b>House
    </div>

    <div class="card">
      <div class="card-body register-card-body">
        <p class="login-box-msg">Registrar una nueva membresía</p>

        <form action="../../index.html" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" id="Nombre" placeholder="Nombre" onfocusout="ConsisitirTexto('Nombre','Debe tener al menos 3 caracteres.')">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="text" class="form-control" id="Apellido" placeholder="Apellido" onfocusout="ConsisitirTexto('Apellido','Debe tener al menos 3 caracteres.')">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="text" class="form-control" id="CBU" placeholder="CBU" onfocusout="ConsisitirNumero('CBU',22,'Deben tener 22 números.')">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="number" maxlength="11" class="form-control" id="CUIL" placeholder="CUIL" onfocusout="ConsisitirNumero('CUIL',11,'Deben tener 11 números sin -.')">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="number" maxlength="10" class="form-control" id="Tel" placeholder="Teléfono" onfocusout="ConsisitirNumero('Tel',10,'Deben tener 10 números sin 0 ni 15.')">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-phone"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="email" class="form-control" id="Correo" placeholder="Correo electrónico" onfocusout="ConsisitirCorreo('Correo', 'Confirmar', 'Los correos deben ser iguales.')">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="email" class="form-control" id="Confirmar" placeholder="Confirmar correo electrónico" onfocusout="ConsisitirCorreo('Correo', 'Confirmar', 'Los correos deben ser iguales.')">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" id="Cont" placeholder="Contraseña" onfocusout="ConsisitirContrasenna('Cont', 'Vuelva', 'Las contraseñas deben ser iguales y debe tener almenos 3 caracteres.')">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" id="Vuelva" placeholder="Vuelva a escribir la contraseña" onfocusout="ConsisitirContrasenna('Cont', 'Vuelva', 'Las contraseñas deben ser iguales y debe tener almenos 3 caracteres.')">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div>
            <font id="errorCampos" color="red">
            </font>
          </div>
          <div class="row">
            <div class="col-8">
              <a href="<?php echo base_url() . "index.php/"; ?>Welcome" class="text-center">Ya estoy registrado.</a>
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