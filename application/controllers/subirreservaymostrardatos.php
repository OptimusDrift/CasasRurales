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
        print_r($_POST);
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
            $this->db->close();
            $j = 0;
            echo count($dorm);
            while (count($dorm) > $j) {
                $this->reservas_model->SubirResPaqDorm($idReserva, $_POST['idPaquete'], $dorm[$j]['id_dormitorio']);
                $j++;
            }
        } else {
            for ($i = 0; $i < intval($_POST['cantidadDormitorios']); $i++) {
                if (isset($_POST['dormitorio' . $i])) {
                    $this->reservas_model->SubirResPaqDorm($idReserva, $_POST['paquete'], $_POST['dormitorio' . $i]);
                }
            }
        }
    }
}
