<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ControladorPropiedades extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('propiedades_model');
        $this->load->model('usuario_model');
    }
    
    function index()
    {
        $dato['inicioactivo'] = '';
        $dato['misalquileresactivo'] = 'active';
        $dato['reservapendienteactivo'] = '';
        $dato['propiedadactivo'] = 'active';
        $dato['paqueteactivo'] = '';
        $dato['misreservaactivo'] = '';
        $dato['reservaactivo'] = '';
        $this->load->view('prototipo/manejoDeSesion');
        $this->load->view('prototipo/primera');
        $this->load->view('prototipo/barranav', $_SESSION['alerta']);
        $this->load->view('prototipo/barraizq', $dato);
        $propiedades = $this->propiedades_model->obtenerPropiedades($_SESSION['id']);
        $propStr["propStr"] = "";
        $i = 0;
        if ($propiedades == null) {
            $propStr["propStr"] = "<h1>No tienes propiedades.</h1>";
        } else {
            while($propiedades->num_rows() > $i){
                $propStr["propStr"] .= "<a href=\"" . base_url() . "index.php/" . "\"paquete\" style='text-decoration:none;color:black;'>
            <div class=\"card card-outline card-dark\">
            <div class=\"card-header\">
              <h5 class=\"m-0\">" . $propiedades->row($i)->nombre_propiedad . "</h5>
            </div>
            <div class=\"card-body\">
            <table>
              <tr>
                <td>
                  <img src=\"" . base_url() . "assets/imagenes" . $this->usuario_model->ObtenerImagenPortada($propiedades->row($i)->id_propiedad) . ".jpg\" alt=\"casa1\" class=\"\" width=\"200\" height=\"150\">
                </td>
                <td>
                </td>
                <td>
                </td>
                <td>
                  <p class=\"card-text\" align=\"justify\">" . substr($propiedades->row($i)->descripcion, 0, 300) . "...</p>
                </td>
              </tr>
            </table>
            </div>
          </div>
          </a>";
          $i++;
            }
        }


        $this->load->view('prototipo/propiedadespropietario', $propStr);
        $this->load->view('prototipo/footeryscrips');
    }

}

?>