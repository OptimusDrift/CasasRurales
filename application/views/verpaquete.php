<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <br>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card card-solid">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <div id="imgPrincipal" class="col-12">
                            <?php echo $imagen ?>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <h3 class="my-3"><?php echo $nombre ?></h3>
                        <p><?php echo $descripcion ?></p>

                        <hr>
                        <h4>Servicios</h4>
                        <div class="btn-toggle">
                            <?php echo $servicios ?>
                        </div>
                        <div class="bg-green py-2 px-3 mt-4">
                            <h2 class="mb-auto">
                                <?php echo "Pesos arg: $" . $precio . "/ noche, minimo: " . $minNoches ?>
                            </h2>
                        </div>
                        <form action="controlarreserva" method="post">
                            <div class="form-inline py-2 mt-2">
                                <div class="input-group input-group">
                                    <div class="input-group-prepend">
                                        <span class="btn btn-dark">
                                            <i class="fas fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <input class="form-control" type="text" id="reservar" name="fechas">
                                </div>
                                <div class="input-group input-group ml-2">
                                    <div class="input-group-prepend">
                                        <span class="btn btn-dark">
                                            <i class="fas fa-phone"></i>
                                        </span>
                                    </div>
                                    <input class="form-control" type="number" id="telefono" name="fechas" placeholder="Ingresa tu teléfono.">
                                </div>
                            </div>

                            <div class="mt-2">
                                <button class="btn btn-primary btn-lg" type="submit"><i class="fas fa-cart-plus fa-lg mr-2"></i> Reservar</button>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
</div>
<!-- /.card -->