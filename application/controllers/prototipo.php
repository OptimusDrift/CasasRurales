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
        $dato['inicioactivo'] = 'active';
        $dato['misalquileresactivo'] = '';
        $dato['reservapendienteactivo'] = '';
        $dato['propiedadactivo'] = '';
        $dato['paqueteactivo'] = '';
        $dato['misreservaactivo'] = '';
        $dato['reservaactivo'] = '';
        $this->load->view('prototipo/primera');
        $this->load->view('prototipo/manejoDeSesion');
        $this->load->view('prototipo/sinbarranav');
        $this->load->view('prototipo/barraizq', $dato);
        $this->load->view('prototipo/template');
        $this->load->view('prototipo/footeryscrips');
    }
}
