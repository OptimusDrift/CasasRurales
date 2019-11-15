<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Historialreservas extends CI_Controller
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
    $id = $_SESSION['id'];
    $res = $this->reservas_model->ObtenerHistorialReservas($id);
    $reservas = $res->result_array();
    $this->db->close();

    $reservastr["reservastr"] = "";
    if (count($reservas) == 0) {
      $reservastr["reservastr"] = "<h1>No se encontraron resultados.</h1>";
    } else {
      $i = 0;
      while (count($reservas) > $i) {
        $reserva = $reservas[$i];
        $estado = "";
        $btn = "";
        $btnCancelar = "";
        if ($reservas[$i]['estado_reserva'] == '1') {
          $btnCancelar = "<input type='submit' class='btn btn-block btn-danger' value='Cancelar Reserva' name='cancelarReserva'>";
          if ($reservas[$i]['estado_pago'] == '1') {
            $estado = "La reserva fue pagada!";
            $btn = '<a href="' . base_url() . 'comprobantes/' . $this->reservas_model->ObtenerImagenesComprobante($reserva['id_reserva'])->row(0)->link . '" target="_blank">
            <input class="btn btn-block btn-success" type="button" value="Ver Comprobante">
            </a>';
            $this->db->close();
          } else {
            $estado = "La reserva aun no fue pagada!";
          }
        } else {
          $estado = "La reserva fue cancelada!";
        }
        $propiedad = $this->Propiedades_model->ObtenerInfoPropiedad($reserva['id_propiedad']);
        $propiedad = $propiedad->result_array();
        $propiedad = $propiedad[0];
        $descripcionCliente = $this->reservas_model->DescripcionCliente($reserva['id_cliente'], $reserva['id_reserva']);
        $reservastr["reservastr"] .= "<a href=\"" . base_url() . "index.php/controladorpaquete?paquete=" . $reserva['id_paquete'] . "\" style='text-decoration:none;color:black;'>
                <div class=\"card card-outline card-dark\">
                <div class=\"card-header\">
                  <h5>" . $propiedad['nombre_propiedad'] . "</h5>
                </div>
                <div class=\"card-body\">
                <table>
                  <tr>
                    <td>
                    <img src=\"" . base_url() . "assets/imagenes" . $this->Propiedades_model->ObtenerImagenesPropiedades($reserva['id_propiedad'])[0] . ".jpg \" alt=\"reserva1\" class=\"\" width=\"200\" height=\"150\">
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                      <p class=\"card-text\" align=\"justify\">" . $this->reservas_model->DescripcionReserva($reserva, $propiedad, $descripcionCliente) . "</p>
                    </td>
                  </tr>
             
                  <tr>
                 
                    <td>
                    " . $btn . "
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    " . $estado . "
                    </td>
                    
                    
                    <td>
                    <input type='text' value='" . $reserva['id_reserva'] . "' name='idReservaH' hidden=''> 
                    </td>
                    <td>
                    " . $btnCancelar . "
                    </td>
                  </tr>
                </table>
                </div>
              </div>
              </a>";
        $this->db->close();
        $i++;
      }
    }



    $dato['inicioactivo'] = '';
    $dato['misalquileresactivo'] = 'active';
    $dato['reservapendienteactivo'] = '';
    $dato['propiedadactivo'] = '';
    $dato['paqueteactivo'] = '';
    $dato['misreservaactivo'] = '';
    $dato['reservaactivo'] = '';
    $dato['historialactivo'] = 'active';
    $dato['misPropiedadesOpen'] = 'menu-open';
    $dato['MisReservasOpen'] = '';
    $this->load->view('primera');
    $this->load->view('barranav',  $_SESSION['alerta']);
    $this->load->view('barraizq', $dato);
    $this->load->view('historialreservas', $reservastr);
    $this->load->view('footeryscrips');
  }
}
