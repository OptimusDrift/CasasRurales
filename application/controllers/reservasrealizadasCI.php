<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReservasrealizadasCI extends CI_Controller {
    function __construct(){
        parent::__construct();
    }
    function index()
	{
    $this->load->model('reservas_model');
        $dato['inicioactivo'] = '';
        $dato['misalquileresactivo'] = '';
        $dato['reservapendienteactivo'] = '';
        $dato['propiedadactivo'] = '';
        $dato['paqueteactivo'] = '';
        $dato['misreservaactivo'] = 'active';
        $dato['reservaactivo'] = 'active';
        $this->load->view('prototipo/primera');
        $this->load->view('prototipo/manejoDeSesion');

        $this->load->view('prototipo/barranav',  $_SESSION['alerta']);
        $this->load->view('prototipo/barraizq', $dato);
        

        $id = $_SESSION['id'];
        $reservas = $this->reservas_model->ObtenerReservasRealizadas($id);
        $reservastr["reservastr"] = "";
        if ($reservas->num_rows() == 0) {
            $reservastr["reservastr"] = "<h1>No se encontraron resultados.</h1>";
        } else 
        {
            $i = 0;
            while($reservas->num_rows() > $i)
            {
                $reservastr["reservastr"] .= "<a href=\"" . base_url() . "index.php/" . "\"paquete\" style='text-decoration:none;color:black;'>
            <div class=\"card card-outline card-dark\">
            <div class=\"card-header\">
              <h5 class=\"m-0\">" . $reservas->row($i)->nombre_propiedad ."</h5>
            </div>
            <div class=\"card-body\">
            <table>
              <tr>
                <td>"
                //  <img src=\"" . base_url() . "assets/imagenes" . $this->usuario_model->ObtenerImagenPortada($reserva->id_propiedad) . "\" alt=\"reserva1\" class=\"\" width=\"200\" height=\"150\">
                ."</td>
                <td>
                </td>
                <td>
                </td>
                <td>"
                  //<p class=\"card-text\" align=\"justify\">" . substr($reserva->descripcion, 0, 300) . "...</p>
                ."</td>
              </tr>
            </table>
            </div>
          </div>
          </a>";
                $i++;
            }
        }

        $this->load->view('prototipo/reservasrealizadas',$reservastr);

        $this->load->view('prototipo/footeryscrips');
  }

}