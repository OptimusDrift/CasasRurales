<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ReservasrealizadasCI extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('reservas_model');
    $this->load->model('propiedades_model');
  }
  function index()
  {
    $this->load->view('manejoDeSesion');
    $id = $_SESSION['id'];
    $res = $this->reservas_model->ObtenerReservasRealizadas($id);

    $reservas = $res->result_array();
    $this->db->close();
    $reservastr["reservastr"] = "";
    if (count($reservas) == 0) {
      $reservastr["reservastr"] = "<h1>No se encontraron resultados.</h1>";
    } else {
      $i = 0;
      while (count($reservas) > $i) {
        //arregla error de base de datos 'out of sync'
        $this->db->reconnect();
        $reserva = $reservas[$i];

        $propiedad = $this->propiedades_model->ObtenerInfoPropiedad($reserva['id_propiedad']);
        $reservastr["reservastr"] .= "<a href=\"" . base_url() . "index.php/" . "\"paquete\" style='text-decoration:none;color:black;'>
            <div class=\"card card-outline card-dark\">
            <div class=\"card-header\">
              <h5 class=\"m-0\">" . $propiedad->nombre_propiedad . "</h5>
            </div>
            <div class=\"card-body\">
            <table>
              <tr>
                <td>
                  <img src=\"" . base_url() . "assets/imagenes" . $this->propiedades_model->ObtenerImagenesPropiedades($reserva['id_propiedad'])[0] . ".jpg \" alt=\"reserva1\" class=\"\" width=\"200\" height=\"150\">
                </td>
                <td>
                </td>
                <td>
                </td>
                <td>
                  <p class=\"card-text\" align=\"justify\">" . $this->reservas_model->DescripcionReserva($reserva, $propiedad) . "</p>
                </td>
              </tr>
            </table>
            </div>
          </div>
          </a>";
        $i++;
      }
    }

    $dato['inicioactivo'] = '';
    $dato['misalquileresactivo'] = '';
    $dato['reservapendienteactivo'] = '';
    $dato['propiedadactivo'] = '';
    $dato['paqueteactivo'] = '';
    $dato['misreservaactivo'] = 'active';
    $dato['reservaactivo'] = 'active';
    $dato['misPropiedadesOpen'] = '';
    $dato['MisReservasOpen'] = 'menu-open';
    $this->load->view('primera');
    $this->load->view('barranav',  $_SESSION['alerta']);
    $this->load->view('barraizq', $dato);
    $this->load->view('reservasrealizadas', $reservastr);
    $this->load->view('footeryscrips');
  }
}
