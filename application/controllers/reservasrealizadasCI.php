<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ReservasrealizadasCI extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('reservas_model');
    $this->load->model('propiedades_model');
    $this->load->model('usuario_model');
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
        $botonComprobante = "";
        $estado = "";
        $form = "";
        //arregla error de base de datos 'out of sync'
        $this->db->reconnect();
        $reserva = $reservas[$i];
        if (!$this->reservas_model->ReservaCancelada($reserva['id_reserva'])) {
          if ($this->reservas_model->ReservaPagada($reserva['id_reserva'])) {
            $form = "<form action=\" " . base_url() . "index.php/validarImagenes\" enctype=\"multipart/form-data\" method=\"post\">
                  <input type='text' value='" . $reserva['id_reserva'] . "' name='idReserva' hidden=''>
                  <input class='btn-block' id=\"imagen\" name=\"imagen\" size=\"30\" type=\"file\">
                  <input class='btn btn-block btn-warning' type=\"submit\" value=\"Subir comprobante\" style='width: 200px;'>
                </form>";
          } else {
            $estado = "Pagada!";
            $botonComprobante = '<a href="' . base_url() . 'comprobantes/' . $this->reservas_model->ObtenerImagenesComprobante($reserva['id_reserva'])->row(0)->link . '" target="_blank">
            <input class="btn btn-block btn-success" type="button" value="Ver Comprobante">
            </a>';
            $this->db->close();
          }
        } else {
          $form = "La reserva fue cancelada!";
        }

        $propiedad = $this->propiedades_model->ObtenerInfoPropiedad($reserva['id_propiedad']);
        $propiedad = $propiedad->result_array();
        $propiedad = $propiedad[0];

        $descripcionPropietario = $this->reservas_model->DescripcionPropietario($propiedad['id_propietario']);

        $reservastr["reservastr"] .= "<a href=\"" . base_url() . "index.php/controladorpaquete?paquete=" . $reserva['id_paquete'] . "\" style='text-decoration:none;color:black;'>
            <div class=\"card card-outline card-dark\">
            <div class=\"card-header\">
              <h5 class=\"m-0\">" . $propiedad['nombre_propiedad'] . "</h5>
            </div>
            <div class=\"card-body\">
            <table>

              <tr>
                <td width=\"200\">
                  <img src=\"" . base_url() . "assets/imagenes" . $this->propiedades_model->ObtenerImagenesPropiedades($reserva['id_propiedad'])[0] . ".jpg \" alt=\"reserva1\" class=\"\" height=\"150\">
                </td>
                <td width=\"50\"></td>
                <td width=\"300\">
                  <p class=\"card-text\" align=\"justify\">" . $this->reservas_model->DescripcionReserva($reserva, $propiedad) . "</p>
                </td>
                <td>
                " . $descripcionPropietario . "
                </td>
              </tr>

              <tr>
              <td valign='bottom'>
              " . $botonComprobante . $form . "
              </td>
              <td></td>
              <td><b>" . $estado . "</b></td>
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
    $dato['historialactivo'] = '';
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
