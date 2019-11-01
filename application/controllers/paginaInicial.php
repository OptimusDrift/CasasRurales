<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PaginaInicial extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('notificacion_alerta');
        $this->load->model('reservas_model');
    }
    function index()
    {
        $this->load->view('manejoDeSesion');
        //manejo de la alerta de las reservas pendientes a pagar
        $datosAlerta = $this->notificacion_alerta->Alerta();
        $_SESSION['alerta'] = $datosAlerta;
        //////////////////////////
        $dato['inicioactivo'] = 'active';
        $dato['misalquileresactivo'] = '';
        $dato['reservapendienteactivo'] = '';
        $dato['propiedadactivo'] = '';
        $dato['paqueteactivo'] = '';
        $dato['misreservaactivo'] = '';
        $dato['reservaactivo'] = '';
        $this->load->view('primera');
        $this->load->view('sinbarranav', $datosAlerta);
        $this->load->view('barraizq', $dato);
        $this->load->view('template');
        $this->load->view('footeryscrips');
    }
}
