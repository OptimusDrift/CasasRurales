  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2019-2019 WoodenHouse.</strong>
    <div class="float-right d-none d-sm-inline-block">
      <b>Todos los derechos reservados.</b>
    </div>
  </footer>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="<?php echo base_url() . "assets/"; ?>plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo base_url() . "assets/"; ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url() . "assets/"; ?>dist/js/adminlte.min.js"></script>

  <script src="<?php echo base_url() . "assets/"; ?>plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Select2 -->
  <script src="<?php echo base_url() . "assets/"; ?>plugins/select2/js/select2.full.min.js"></script>
  <!-- Bootstrap4 Duallistbox -->
  <script src="<?php echo base_url() . "assets/"; ?>plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
  <!-- InputMask -->
  <script src="<?php echo base_url() . "assets/"; ?>plugins/inputmask/jquery.inputmask.bundle.js"></script>
  <script src="<?php echo base_url() . "assets/"; ?>plugins/moment/moment.min.js"></script>
  <!-- date-range-picker -->
  <script src="<?php echo base_url() . "assets/"; ?>plugins/daterangepicker/daterangepicker.js"></script>
  <!-- bootstrap color picker -->
  <script src="<?php echo base_url() . "assets/"; ?>plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="<?php echo base_url() . "assets/"; ?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url() . "assets/"; ?>dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo base_url() . "assets/"; ?>dist/js/demo.js"></script>
  <!-- jQuery UI -->
  <script src="<?php echo base_url() . "assets/"; ?>plugins/jquery-ui/jquery-ui.min.js"></script>
  <script src="<?php echo base_url() . "assets/"; ?>plugins/fullcalendar/main.min.js"></script>
  <script src="<?php echo base_url() . "assets/"; ?>plugins/fullcalendar-daygrid/main.min.js"></script>
  <script src="<?php echo base_url() . "assets/"; ?>plugins/fullcalendar-timegrid/main.min.js"></script>
  <script src="<?php echo base_url() . "assets/"; ?>plugins/fullcalendar-interaction/main.min.js"></script>
  <script src="<?php echo base_url() . "assets/"; ?>plugins/fullcalendar-bootstrap/main.min.js"></script>

  <script src="<?php echo base_url() . "assets/"; ?>plugins/cambia-foto/cambiar-foto.js"></script>

  <!-- Page script -->
  <script>
    $(function() {
      //Date range picker
      $('#reservation').daterangepicker({
        opens: 'center',
        startDate: moment().add(24, 'hour'),
        endDate: moment().add(72, 'hour'),
        minDate: moment().add(24, 'hour'),
        autoApply: true,
        showDropdowns: true,
        locale: {
          format: 'DD/MM/YYYY',
          "weekLabel": "S",
          "daysOfWeek": [
            "Do",
            "Lu",
            "Ma",
            "Mi",
            "Ju",
            "Vi",
            "Sa"
          ],
          "monthNames": [
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agosto",
            "Septiembre",
            "Octubre",
            "Noviembre",
            "Diciembre"
          ]
        }
      });
    })
    var maxDia = <?php echo json_encode($diaFinalDeReserva); ?>;
    var array = "";

    function ObtenerFechas(boton, pos) {
      var sel = 1;
      var dormitorios = [];
      cantidadDormitorios = $("#completa").val().split(",")[1];
      if ($("#completa").is(":checked")) {
        for (let index = 0; index < cantidadDormitorios; index++) {
          $("#dormitorio" + index).attr("disabled", true);
          dormitorios[0] = 0;
        }
        sel = 0;
      } else {
        for (let index = 0; index < cantidadDormitorios; index++) {
          $("#dormitorio" + index).attr("disabled", false);
        }
      }
      var act = [];
      var completa = false;
      for (let index = 0; index < cantidadDormitorios; index++) {
        if ($("#dormitorio" + index).is(":checked")) {
          console.log("#dormitorio" + index + $("#dormitorio" + index).is(":checked"));
          $("#completa").attr("disabled", true);
          act[index] = index;
          completa = true;
          dormitorios[index] = index + 1;
          sel = 0;
        } else {
          act[index] = -1;
        }
      }
      if (!completa) {
        $("#completa").attr("disabled", false);
      }
      $.post("dormitorios", {
        idPaquete: <?php echo json_encode($idPaquete); ?>,
        idProp: <?php echo json_encode($idPropiedad); ?>,
        lista: <?php echo json_encode($lista); ?>,
        idDormitorio: dormitorios,
        idUsuario: <?php echo json_encode($idUsuario); ?>,
        activas: act,
        cantDormitorios: cantidadDormitorios,
        seleccion: sel
      }, function(mensaje) {
        console.log(mensaje);
        var msj = mensaje.split("~");
        array = msj[1].split(",");
        document.getElementById("formularioReserva").innerHTML = msj[0];
        $(function() {
          //YYYY-MM-DD
          $('#reservar').daterangepicker({
            isInvalidDate: function(date) {
              for (let index = 0; index < array.length; index++) {
                if (date.format('YYYY-MM-DD') == array[index]) {
                  return true;
                }
              }
            },
            opens: 'center',
            startDate: moment().add(24, 'hour'),
            endDate: moment().add(72, 'hour'),
            minDate: moment().add(24, 'hour'),
            autoApply: true,
            maxDate: maxDia,
            showDropdowns: true,
            locale: {
              format: 'DD/MM/YYYY',
              "weekLabel": "S",
              "daysOfWeek": [
                "Do",
                "Lu",
                "Ma",
                "Mi",
                "Ju",
                "Vi",
                "Sa"
              ],
              "monthNames": [
                "Enero",
                "Febrero",
                "Marzo",
                "Abril",
                "Mayo",
                "Junio",
                "Julio",
                "Agosto",
                "Septiembre",
                "Octubre",
                "Noviembre",
                "Diciembre"
              ]
            }
          });
        })
      });
    }

    function ConsisitirForm() {
      consisitido = true;
      i = 0;
      error = "";
      $.post("validarFechas", {
          fechasAConsisitir: $('#reservar').val(),
          fechasParaConsisitir: array,
          minNoches: <?php echo json_encode($minNoches); ?>,
          precio: $('#precio').val()
        },
        function(mensaje) {
          if (mensaje == 'alquilada') {
            $('#reservar').css({
              "border": "1px solid red"
            });
            consisitido = false;
            document.getElementById("preciototal").innerHTML = "Ya esta alquilada entre esas fechas.";
          } else if (mensaje == "minNoches") {
            $('#reservar').css({
              "border": "1px solid red"
            });
            consisitido = false;
            document.getElementById("preciototal").innerHTML = "El minimo de noches es: " + <?php echo json_encode($minNoches); ?>;
          } else {
            $('#reservar').css({
              "border": "1px solid green"
            });
            document.getElementById("preciototal").innerHTML = mensaje;
          }
          try {
            if ($('#area').val().toString().length < 3 || isNaN(Number($('#area').val().toString()))) {
              throw error;
            } else {
              $('#area').css({
                "border": "1px solid green"
              });
            }
          } catch (error) {
            $('#area').css({
              "border": "1px solid red"
            });
            consisitido = false;
          }

          if ($('#telefono').val().toString().length < 7 || isNaN(Number($('#telefono').val().toString()))) {
            $('#telefono').css({
              "border": "1px solid red"
            });
            consisitido = false;
          } else {
            $('#telefono').css({
              "border": "1px solid green"
            });
          }
          if (consisitido) {
            document.getElementById("enviar").submit();
          } else {
            //alert("Los datos ingresados no son validos.");
          }
        })
    }
    //function cambiarFormulario(habitacion) {}
  </script>
  </body>

  </html>