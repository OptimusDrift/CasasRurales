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
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-default text-center active">
                                <input type="radio" name="color_option" id="color_option1" autocomplete="off" checked="">
                                Desayuno
                                <br>
                                <i class="fas fa-circle fa-2x fa-coffee"></i>
                            </label>
                            <label class="btn btn-default text-center">
                                <input type="radio" name="color_option" id="color_option2" autocomplete="off">
                                Wifi
                                <br>
                                <i class="fas fa-circle fa-2x fa-wifi"></i>
                            </label>
                        </div>



                        <div class="bg-gray py-2 px-3 mt-4">
                            <h2 class="mb-0">
                                <?php echo "Pesos arg: $" . $precio . "/ noche, minimo: " . $minNoches ?>
                            </h2>
                        </div>

                        <div class="mt-4">
                            <div class="btn btn-primary btn-lg btn-flat">
                                <i class="fas fa-cart-plus fa-lg mr-2"></i>
                                Reservar
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>