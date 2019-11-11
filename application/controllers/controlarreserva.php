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
    }
    function index()
    {
        $this->load->view('manejoDeSesion');
        //$this->reservas_model->SubirReserva($idusuario, $fechaDeInicio, $fechaFinal, $precio, $codigo, $telefono, $idPaquete, $idDormitorio);
        print_r($_POST);
        $dato['inicioactivo'] = '';
        $dato['misalquileresactivo'] = 'active';
        $dato['reservapendienteactivo'] = '';
        $dato['propiedadactivo'] = '';
        $dato['paqueteactivo'] = 'active';
        $dato['misreservaactivo'] = '';
        $dato['reservaactivo'] = '';
        $dato['misPropiedadesOpen'] = 'menu-open';
        $dato['MisReservasOpen'] = '';
        $this->load->view('primera');
        $this->load->view('barranav',  $_SESSION['alerta']);
        $this->load->view('barraizq', $dato);
        $this->load->view('completarreserva');
        $this->load->view('footeryscrips');
    }
}
