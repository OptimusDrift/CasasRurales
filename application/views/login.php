<body background="<?php echo base_url() . "assets/"; ?>fondoLogin.jpg">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><b>Wooden</b>House</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/'; ?>plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/'; ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/'; ?>dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  </head>

  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <b>Wooden</b>House
      </div>
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body login-card-body">
          <p class="login-box-msg"><?php echo $mensaje ?></p>
          <form action="<?php echo $red ?>" method="POST">
            <div class="input-group mb-3">
              <input type="email" name="correo" class="form-control" placeholder="Correo electrónico" value="correo1@gmail.com">
              <!--<input name="error" class="form-control" placeholder="Correo electrónico" value="error">-->
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" name="contrasenna" class="form-control" placeholder="Contraseña" value="root1234">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <p style="color:red;" class="m-md-2"><?php echo $error ?></p>
            <div class="row">
              <div class="col-5">
                <button type="button" class="btn btn-primary btn-block" onclick="window.location.href='registro'">Registrarse</button>
              </div>
              <div class="col-2">
              </div>
              <!-- /.col -->
              <div class="col-5">
                <button type="submit" class="btn btn-success btn-block">Ingresar</button>
              </div>
              <!-- /.col -->
            </div>
          </form>
          <!-- /.social-auth-links -->
        </div>
        <!-- /.login-card-body -->
      </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?php echo base_url() . 'assets/'; ?>plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url() . 'assets/'; ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

  </html>