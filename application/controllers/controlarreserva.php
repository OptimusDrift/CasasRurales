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
        if ($_SESSION['completar'] == '1') {
            $_SESSION['completar'] = '2';
            $c = "";
            if (isset($_POST['completa'])) {
                $dato['completa'] = '<td colspan="2">
            <h3> Se alquilo la propiedad completa.</h3>
            </td>';
                $c = '<input hidden="" name="completa" value="1">
            <input hidden="" name="idPropiedad" value="' . $_POST['idPropiedad'] . '">';
            } else {
                $dormitorios = $this->dormitorio_model->ObtenerDormitorios($_POST['idPropiedad'])->result_array();
                $this->db->close();
                $dato['dormitorios'] = "";
                $n = 0;
                for ($i = 0; $i < $_POST['cantidadDormitorios']; $i++) {
                    if ($_POST['dormitorio' . $i] != '') {
                        $dato['dormitorios'] .= $dormitorios[$i]['id_dormitorio'] . ", ";
                        $c .= '<input hidden="" name="idDormitorio' . $i . '" value="' . $dormitorios[$i]['id_dormitorio'] . '">';
                        $n++;
                    }
                    $c .= '<input hidden="" name="cantidadDormitorios" value="' . $n . '">';
                }
                $dato['completa'] = '<td align="right">
            <h3> Dormitorios: </h3>
        </td>
        <td>
            <h3>
                ' . $dato['dormitorios'] . '
            </h3>
        </td>';
            }
            $dato['precio'] = $this->paquetes_model->CalcularPrecioFechas($_POST['fechas'], $_POST['precio']);
            $info = $this->propiedades_model->ObtenerInfoPropiedad($_POST['idPropiedad']);
            $dato['propiedad'] = $info->nombre_propiedad;
            $this->db->close();
            $dato['fechas'] = $_POST['fechas'];
            $dato['telefono'] = "(" . $_POST['ar'] . ')-' . $_POST['tel'];
            $dato['input'] = '<input hidden="" name="idUsuario" value="' . $_POST['idUsuario'] . '">
        <input hidden="" name="FI" value="' . $this->paquetes_model->FormatearFechaBDD(preg_split('[-]', $_POST['fechas'])[0], '-')  . '">
        <input hidden="" name="FF" value="' . $this->paquetes_model->FormatearFechaBDD(preg_split('[-]', $_POST['fechas'])[1], '-') . '">
        <input hidden="" name="precio" value="' . $dato['precio'] . '">
        <input hidden="" name="codigo" value="' . $_POST['ar'] . '">
        <input hidden="" name="telefono" value="' . $_POST['tel'] . '">
        <input hidden="" name="idPaquete" value="' . $_POST['idPaquete'] . '">' . $c;
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
        } else {
            redirect('controladorpaquete');
        }
    }
}
