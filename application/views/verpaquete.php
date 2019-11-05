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
                        <div class="py-2">
                            <?php echo $formulario ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
</div>
<!-- /.card -->