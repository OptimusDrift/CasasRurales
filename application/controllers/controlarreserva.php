<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Controlarreserva extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('reservas_model');
        $this->load->model('propiedades_model');
        $this->load->model('paquetes_model');
        $this->load->model('dormitorio_model');
    }
    function index()
    {
        $this->load->view('manejoDeSesion');
        //$this->reservas_model->SubirReserva($idusuario, $fechaDeInicio, $fechaFinal, $precio, $codigo, $telefono, $idPaquete, $idDormitorio);
        print_r($_POST);
        if (isset($_POST['completa'])) {
            $dato['completa'] = '<td colspan="2">
            <h3> Se alquilo la propiedad completa.</h3>
            </td>';
        } else {
            $dormitorios = $this->dormitorio_model->ObtenerDormitorios($_POST['idPropiedad'])->result_array();
            $this->db->close();
            $dato['dormitorios'] = "";
            for ($i = 0; $i < $_POST['cantidadDormitorios']; $i++) {
                if ($_POST['dormitorio' . $i] != '') {
                    $dato['dormitorios'] .= $dormitorios[$i]['id_dormitorio'] . ", ";
                }
            }
            $dato['completa'] = '<td align="right">
            <h3> Nombre de los dormitorios: </h3>
        </td>
        <td>
            <h3>
                ' . $dato['dormitorios'] . '
            </h3>
        </td>';
        }
        $dato['precio'] = $this->paquetes_model->CalcularPrecioFechas($_POST['fechas'], $_POST['precio']);
        $dato['fechas'] = $_POST['fechas'];
        $dato['telefono'] = "(" . $_POST['ar'] . ')-' . $_POST['tel'];
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
        $this->load->view('primera');
        $this->load->view('barranav',  $_SESSION['alerta']);
        $this->load->view('barraizq', $dato);
        $this->load->view('completarreserva', $dato);
        $this->load->view('footeryscrips');
    }
}
