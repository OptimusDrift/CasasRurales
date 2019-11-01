<?php
defined('BASEPATH') or exit('No direct script access allowed');

class cancelarReserva extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('reservas_model');
    $this->load->model('Propiedades_model');
  }
  function index()
  {
    $this->load->view('manejoDeSesion');
    echo $_POST['idReserva'];
   if(isset($_POST['cancelarReserva']))
   {
        if($this->reservas_model->cancelarReserva($_POST['idReserva']))
        { redirect('reservaspendientes');}
   }
   
  }
}
