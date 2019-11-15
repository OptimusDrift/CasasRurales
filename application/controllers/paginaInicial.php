<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PaginaInicial extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        
        $this->load->model('reservas_model');
    }
    function index()
    {
        $this->load->view('manejoDeSesion');

        $dato['inicioactivo'] = 'active';
        $dato['misalquileresactivo'] = '';
        $dato['reservapendienteactivo'] = '';
        $dato['propiedadactivo'] = '';
        $dato['paqueteactivo'] = '';
        $dato['misreservaactivo'] = '';
        $dato['historialactivo'] = '';
        $dato['reservaactivo'] = '';
        $dato['misPropiedadesOpen'] = '';
        $dato['MisReservasOpen'] = '';
        $this->load->view('primera');
        $this->load->view('sinbarranav', $_SESSION['alerta']);
        $this->load->view('barraizq', $dato);
        $this->load->view('template');
        $this->load->view('footeryscrips');
    }
}
