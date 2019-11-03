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
  <!-- Page script -->
  <script>
    $(function() {
      //Date range picker
      $('#reservation').daterangepicker({
        opens: 'left',
        startDate: moment(),
        endDate: moment().add(24, 'hour'),
        minDate: moment(),
        autoApply: true,
        locale: {
          format: 'DD/MM/YYYY'
        }
      });
    })
  </script>
  </body>

  </html>