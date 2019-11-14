<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <center>
        <div class="card card-outline card-dark col-8">
            <div class="card-header">
                <h2>
                    ¡Reservas realizada con exito!.
                </h2>
            </div>
            <div class="card-body">
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <!-- /.col-md-6 -->
                            <div class="col-lg-12">
                                <table>
                                    <tr>
                                        <td align="right">
                                            <h3>Nombre del dueño: </h3>
                                        </td>
                                        <td>
                                            <h3><?php echo $nombre; ?></h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right">
                                            <h3>Apellido: </h3>
                                        </td>
                                        <td>
                                            <h3>
                                                <?php echo $apellido; ?>
                                            </h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right">
                                            <h3>Teléfono de contacto: </h3>
                                        </td>
                                        <td>
                                            <h3>
                                                <?php echo $telefono; ?>
                                            </h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right">
                                            <h3>Correo electronico: </h3>
                                        </td>
                                        <td>
                                            <h3>
                                                <?php echo $correo; ?>
                                            </h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right">
                                            <h3>CBU: </h3>
                                        </td>
                                        <td>
                                            <h3>
                                                <?php echo $cbu; ?>
                                            </h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right">
                                            <h3>CUIL: </h3>
                                        </td>
                                        <td>
                                            <h3>
                                                <?php echo $cuil; ?>
                                            </h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right">
                                            <button type="button" class="btn btn-success" onclick="window.location.href='paginaInicial'">Continuar</button>
                                        </td>
                                    </tr>

                                </table>
                            </div>
                            <!-- /.col-md-6 -->
                        </div>
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
        </div>
    </center>
</div>