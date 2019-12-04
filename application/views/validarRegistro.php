<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="register-box">
        <div class="register-logo">
            <img src="<?php echo base_url() . "assets/"; ?>dist/img/WoodenHouse.png"><b>Wooden</b>House
        </div>

        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Ingrese el Código de Validación</p>

        <form action="<?php echo base_url();?>index.php/validarRegistro" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="####" name="codigo">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-check"></span>
                            </div>
                        </div>
                </div>
          
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Regístrate</button>
            </div>
            <!-- /.col -->
        </div>

        </form>
    
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
  <!-- /.register-box -->
</body>
</html>