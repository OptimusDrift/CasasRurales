<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Buscarcasa extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
  }

  function index()
  {
    $dato['inicioactivo'] = '';
    $dato['misalquileresactivo'] = '';
    $dato['reservapendienteactivo'] = '';
    $dato['propiedadactivo'] = '';
    $dato['paqueteactivo'] = '';
    $dato['misreservaactivo'] = '';
    $dato['reservaactivo'] = '';
    $this->load->view('prototipo/primera');
    $this->load->view('prototipo/manejoDeSesion');
    $this->load->view('prototipo/barranav', $_SESSION['alerta']);
    $this->load->view('prototipo/barraizq', $dato);
    //! Carga todas las propiedades de una ubicacion.
    $this->load->model('paquetes_model');
    $Casas = $this->paquetes_model->BuscarPaquetes($_GET['poblacion'], $_GET['fechas'], $_GET['cantidad']);
    $casaStr["casaStr"] = "";
    if ($Casas == null) {
      $casaStr["casaStr"] = "<h1>No se encontraron resultados.</h1>";
    } else {
      foreach ($Casas as $key => $casa) {
        $casaStr["casaStr"] .= "<a href=\"" . base_url() . "index.php/controladorpaquete?paquete=" . $casa['id_paquete'] . "\" style='text-decoration:none;color:black;' onClick='event.target.parentNode.submit();'>
            <div class=\"card card-outline card-dark\">
            <div class=\"card-header\">
              <h5 class=\"m-0\">" . $casa['nombre_propiedad'] . "</h5>
            </div>
            <div class=\"card-body\">
            <table>
              <tr>
                <td>
                  <img src=\"" . base_url() . "assets/imagenes" . $this->paquetes_model->ObtenerImagenPortada($casa['id_propiedad']) . ".jpg\" alt=\"casa1\" class=\"\" width=\"200\" height=\"150\">
                </td>
                <td>
                </td>
                <td>
                </td>
                <td>
                  <p class=\"card-text\" align=\"justify\">" . substr($casa['descripcion'], 0, 300) . "...</p>
                </td>
              </tr>
            </table>
            </div>
          </div>
          </a>";
      }
    }
    $this->load->view('prototipo/buscarcasa', $casaStr);
    $this->load->view('prototipo/footeryscrips');
  }
}
