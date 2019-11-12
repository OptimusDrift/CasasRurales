<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Buscarcasa extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('paquetes_model');
    $this->load->model('Propiedades_model');
  }

  function index()
  {
    $this->load->view('manejoDeSesion');
    //! Carga todas las propiedades de una ubicacion.
    $Casas = $this->paquetes_model->BuscarPaquetes($_GET['poblacion'], $_GET['fechas'], $_GET['cantidad']);
    $casaStr["casaStr"] = "";
    $i = 0;
    if ($Casas['paquete'] == null) {
      $casaStr["casaStr"] = "<h1>No se encontraron resultados.</h1>";
    } else {
      foreach ($Casas['paquete'] as $casa) {
        $casaStr["casaStr"] .= "<a href=\"" . base_url() . "index.php/controladorpaquete?paquete=" . $casa['id_paquete'] . "\" style='text-decoration:none;color:black;'>
            <div class=\"card card-outline card-dark\">
            <div class=\"card-header\">
              <h5>" . $casa['nombre_propiedad'] . "</h5>
            </div>
            <div class=\"card-body\">
            <table>
              <tr>
                <td>
                  <img src=\"" . base_url() . "assets/imagenes" . $this->Propiedades_model->ObtenerImagenesPropiedades($casa['id_propiedad'])[0] . ".jpg\" alt=\"casa1\" class=\"\" width=\"200\" height=\"150\">
                </td>
                <td>
                </td>
                <td>
                </td>
                <td>
                  <p class=\"card-text\" align=\"justify\">" . substr($casa['descripcion'], 0, 300) . "...</p>
                </td>
              </tr>
              <tr>
                <td>
                <p class=\"card-text\" align=\"right\"> Cantidad personas: " . $Casas['numeroPersonas'][$i] . "</p>
                </td>
                <td>
                </td>
                <td>
                </td>
                <td>
                  <p class=\"card-text\" align=\"right\"> Precio: (ARS) $" . $casa['precio'] . "/noche, estadia minima: " . $casa['minNoches'] . "</p>
                </td>
              </tr>
            </table>
            </div>
          </div>
          </a>";
        $i++;
      }
    }
    //?Datos de la barra de navegacion
    $dato['inicioactivo'] = '';
    $dato['misalquileresactivo'] = '';
    $dato['reservapendienteactivo'] = '';
    $dato['propiedadactivo'] = '';
    $dato['paqueteactivo'] = '';
    $dato['misreservaactivo'] = '';
    $dato['reservaactivo'] = '';
    $dato['historialactivo'] = '';
    $dato['misPropiedadesOpen'] = '';
    $dato['MisReservasOpen'] = '';
    //?Cargar las vistas
    $this->load->view('primera');
    $this->load->view('barranav', $_SESSION['alerta']);
    $this->load->view('barraizq', $dato);
    $this->load->view('buscarcasa', $casaStr);
    $this->load->view('footeryscrips');
  }
}
