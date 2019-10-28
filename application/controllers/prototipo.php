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
        $this->load->model('notificacion_alerta');
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
        $datosAlerta = $this->notificacion_alerta->Alerta();
        $_SESSION['alerta'] = $datosAlerta;
        //////////////////////////
        $this->load->view('prototipo/sinbarranav', $datosAlerta);
        $this->load->view('prototipo/barraizq', $dato);
        $this->load->view('prototipo/template');
        $this->load->view('prototipo/footeryscrips');


    }
}
