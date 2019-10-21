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
        $this->load->view('prototipo/barranav');
        $this->load->view('prototipo/barraizq', $dato);
        //! Carga todas las propiedades de una ubicacion.
        $this->load->model('usuario_model');
        $Casas = $this->usuario_model->BuscarPaquetes($_POST['poblacion'], $_POST['fechas']);
        $casaStr["casaStr"] = "";
        if ($Casas == null) {
            $casaStr["casaStr"] = "<h1>No se encontraron resultados.</h1>";
        } else {
            foreach ($Casas as $key => $casa) {
              echo base_url() . "assets/imagenes".$this->usuario_model->ObtenerImagenPortada($casa->id_propiedad);
                $casaStr["casaStr"] .= "<a href=\"" . base_url() . "index.php/" . "\"paquete\" style='text-decoration:none;color:black;'>
            <div class=\"card card-outline card-dark\">
            <div class=\"card-header\">
              <h5 class=\"m-0\">" . $casa->nombre_propiedad . "</h5>
            </div>
            <div class=\"card-body\">
            <table>
              <tr>
                <td>
                  <img src=\"" . base_url() . "assets/imagenes" . $this->usuario_model->ObtenerImagenPortada($casa->id_propiedad) . ".jpg\" alt=\"casa1\" class=\"\" width=\"200\" height=\"150\">
                </td>
                <td>
                </td>
                <td>
                </td>
                <td>
                  <p class=\"card-text\" align=\"justify\">" . substr($casa->descripcion, 0, 300) . "...</p>
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
