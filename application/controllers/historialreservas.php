<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Historialreservas extends CI_Controller
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
        $this->load->view('sinbarranav', $datosAlerta);
        $this->load->view('barraizq', $dato);
        $this->load->view('historialreservas');
        $this->load->view('footeryscrips');
    }
}
