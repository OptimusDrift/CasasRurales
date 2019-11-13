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
          <div class="card col-8">
              <div class="card-body">
                  <div class="content">
                      <div class="container-fluid">
                          <div class="row">
                              <!-- /.col-md-6 -->
                              <div class="col-lg-12">
                                  <form action="subirreservaymostrardatos" method="POST">
                                      <?php echo $input; ?>
                                      <table>
                                          <tr>
                                              <td align="right">
                                                  <h3>El precio total es: </h3>
                                              </td>
                                              <td>
                                                  <h3><?php echo "$" . $precio; ?></h3>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td align="right">
                                                  <h3>En las fechas: </h3>
                                              </td>
                                              <td>
                                                  <h3>
                                                      <?php echo $fechas; ?>
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
                                                  <h3>Nombre de la propiedad: </h3>
                                              </td>
                                              <td>
                                                  <h3>
                                                      <?php echo $propiedad; ?>
                                                  </h3>
                                              </td>
                                          </tr>
                                          <tr>
                                              <?php echo $completa; ?>
                                          </tr>
                                          <tr>
                                              <td align="right">
                                                  <input type="submit" class="btn btn-success" value="Confirmar Alquiler">
                                              </td>
                                              <td>
                                                  <button type="button" class="btn btn-danger" onclick="cancelar()">Cancelar</button>
                                              </td>
                                          </tr>
                                      </table>
                                  </form>
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