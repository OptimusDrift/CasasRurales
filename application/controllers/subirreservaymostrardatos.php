<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Subirreservaymostrardatos extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("reservas_model");
        $this->load->model("propiedades_model");
        $this->load->model("usuario_model");
        $this->load->model("dormitorio_model");
    }
    //$this->reservas_model->SubirReserva($idusuario, $fechaDeInicio, $fechaFinal, $precio, $codigo, $telefono, $idPaquete, $idDormitorio);
    function index()
    {
        $this->load->view('manejoDeSesion');
        if ($_SESSION['completar'] == '2') {
            $_SESSION['completar'] = '0';
            $idReserva = $this->reservas_model->SubirReserva(
                $_POST['idUsuario'],
                $_POST['FI'],
                $_POST['FF'],
                $_POST['precio'],
                $_POST['codigo'],
                $_POST['telefono']
            );

            if (isset($_POST['completa'])) {
                $dorm = $this->dormitorio_model->ObtenerDormitorios($_POST['idPropiedad'])->result_array();
                $idDorm = $dorm[0]['id_dormitorio'];
                $this->db->close();
                $j = 0;
                while (count($dorm) > $j) {
                    $this->reservas_model->SubirResPaqDorm($idReserva, $_POST['idPaquete'], $dorm[$j]['id_dormitorio']);
                    $j++;
                }
            } else {
                for ($i = 0; $i < intval($_POST['cantidadDormitorios']); $i++) {
                    if (isset($_POST['idDormitorio' . $i])) {
                        $idDorm = $_POST['idDormitorio' . $i];
                        $this->reservas_model->SubirResPaqDorm($idReserva, $_POST['idPaquete'], $_POST['idDormitorio' . $i]);
                    }
                }
            }
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
            $duenno = $this->dormitorio_model->ObtenerDuenno($idDorm);
            $dato['nombre'] = $duenno['nombre'];
            $dato['apellido'] = $duenno['apellido'];
            $dato['cbu'] = $duenno['cbu'];
            $dato['cuil'] = $duenno['cuil'];
            $dato['correo'] = $duenno['correo'];
            $dato['telefono'] = $duenno['telefono'];
            $this->load->view('primera');
            $this->load->view('barranav',  $_SESSION['alerta']);
            $this->load->view('barraizq', $dato);
            $this->load->view('confirmaralquiler', $dato);
            $this->load->view('footeryscrips');
        } else {
            redirect('paginaInicial');
        }
    }
}
