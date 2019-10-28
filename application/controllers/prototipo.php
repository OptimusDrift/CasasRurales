<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prototipo extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }
    function index()
    {   
        $this->load->model('reservas_model');
        $dato['inicioactivo'] = 'active';
        $dato['misalquileresactivo'] = '';
        $dato['reservapendienteactivo'] = '';
        $dato['propiedadactivo'] = '';
        $dato['paqueteactivo'] = '';
        $dato['misreservaactivo'] = '';
        $dato['reservaactivo'] = '';
        $this->load->view('prototipo/primera');
        $this->load->view('prototipo/manejoDeSesion');
        //manejo de la alerta de las reservas pendientes a pagar

        $alerta = $this->reservas_model->Alerta($_SESSION['id']);

        $datosAlerta['numAlertas'] = $alerta->num_rows();
        $datosAlerta['tipoAlerta'] = "alertas de falta de pago";
        

        //echo $datosAlerta['numAlertas'];



        //////////////////////////
        $this->load->view('prototipo/barranav', $datosAlerta);
        $this->load->view('prototipo/barraizq', $dato);
        $this->load->view('prototipo/template');
        $this->load->view('prototipo/footeryscrips');


    }
}
