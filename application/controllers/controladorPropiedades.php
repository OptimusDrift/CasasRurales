<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ControladorPropiedades extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('propiedades_model');
    $this->load->model('paquetes_model');
  }

  function index()
  {
    $this->load->view('manejoDeSesion');
    $propiedades = $this->propiedades_model->ObtenerPropiedades($_SESSION['id']);
    $propStr["propStr"] = "";
    $i = 0;
    if ($propiedades == null) {
      $propStr["propStr"] = "<h1>No tienes propiedades.</h1>";
    } else {
      while (count($propiedades) > $i) {
        //$reserva = $this->paquetes_model->ObtenerIdPaquetePropiedad($propiedades[$i]['id_propiedad']);
        /*<a href=\"" . base_url() . "index.php/controladorpaquete?paquete=" . $reserva['id_paquete'] . "\" style='text-decoration:none;color:black;'>*/
        $propStr["propStr"] .= "  <div class=\"card card-outline card-dark\">
            <div class=\"card-header\">
              <h5 class=\"m-0\">" . $propiedades[$i]['nombre_propiedad'] . "</h5>
            </div>
            <div class=\"card-body\">
            <table>
              <tr>
                <td>
                  <img src=\"" . base_url() . "assets/imagenes" . $this->propiedades_model->ObtenerImagenesPropiedades($propiedades[$i]['id_propiedad'])[0] . ".jpg\" alt=\"casa1\" class=\"\" width=\"200\" height=\"150\">
                </td>
                <td>
                </td>
                <td>
                </td>
                <td>
                  <p class=\"card-text\" align=\"justify\">" . substr($propiedades[$i]['descripcion'], 0, 300) . "...</p>
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
    $dato['propiedadactivo'] = 'active';
    $dato['paqueteactivo'] = '';
    $dato['misreservaactivo'] = '';
    $dato['reservaactivo'] = '';
    $dato['historialactivo'] = '';
    $dato['misPropiedadesOpen'] = 'menu-open';
    $dato['MisReservasOpen'] = '';
    $this->load->view('primera');
    $this->load->view('barranav', $_SESSION['alerta']);
    $this->load->view('barraizq', $dato);
    $this->load->view('propiedadespropietario', $propStr);
    $this->load->view('footeryscrips');
  }
}
