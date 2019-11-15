<?php
defined('BASEPATH') or exit('No direct script access allowed');

class mispaquetes extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('reservas_model');
    $this->load->model('propiedades_model');
    $this->load->model('paquetes_model');
  }
  function index()
  {
    $this->load->view('manejoDeSesion');
    $id = $_SESSION['id'];
    $res = $this->paquetes_model->ObtenerPaquetesDePropietario($id);

    $paquetes = $res->result_array();

    $this->db->close();
    $paquetesrt["paquetesrt"] = "";
    if (count($paquetes) == 0) {
      $paquetesrt["paquetesrt"] = "<h1>No se encontraron resultados.</h1>";
    } else {
      $i = 0;
      while (count($paquetes) > $i) {
        //arregla error de base de datos 'out of sync'
        //$this->db->reconnect();
        $paquete = $paquetes[$i];

        $propiedad = $this->propiedades_model->ObtenerInfoPropiedad($paquete['id_propiedad']);
        $propiedad= $propiedad->result_array();
        $propiedad= $propiedad[0];
        $paquetesrt["paquetesrt"] .= "<a href=\"" . base_url() . "index.php/controladorpaquete?paquete=" . $paquete['id_paquete'] . "\" style='text-decoration:none;color:black;'>
            <div class=\"card card-outline card-dark\">
            <div class=\"card-header\">
              <h5 class=\"m-0\">" . $propiedad['nombre_propiedad'] . "</h5>
            </div>
            <div class=\"card-body\">
            <table>
              <tr>
                <td>
                  <img src=\"" . base_url() . "assets/imagenes" . $this->propiedades_model->ObtenerImagenesPropiedades($propiedad['id_propiedad'])[0] . ".jpg \" alt=\"reserva1\" class=\"\" width=\"200\" height=\"150\">
                </td>
                <td>
                </td>
                <td>
                </td>
                <td>
                  <p class=\"card-text\" align=\"justify\">" . $this->paquetes_model->DescripcionPaquete($paquete, $propiedad) . "</p>
                </td>
              </tr>
              <tr>
              <td>
              </td>
              <td>
              </td>
              <td>
              </td>
              <td>
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
    $dato['misalquileresactivo'] = 'active';
    $dato['reservapendienteactivo'] = '';
    $dato['propiedadactivo'] = '';
    $dato['paqueteactivo'] = 'active';
    $dato['misreservaactivo'] = '';
    $dato['reservaactivo'] = '';
    $dato['historialactivo'] = '';
    $dato['misPropiedadesOpen'] = 'menu-open';
    $dato['MisReservasOpen'] = '';

    $this->load->view('primera');
    $this->load->view('barranav',  $_SESSION['alerta']);
    $this->load->view('barraizq', $dato);
    $this->load->view('mispaquetes', $paquetesrt);
    $this->load->view('footeryscrips');
  }
}
