<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ControladorPropiedades extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('propiedades_model');
    }
    
    function index()
    {
        $dato['inicioactivo'] = '';
        $dato['misalquileresactivo'] = 'active';
        $dato['reservapendienteactivo'] = '';
        $dato['propiedadactivo'] = 'active';
        $dato['paqueteactivo'] = '';
        $dato['misreservaactivo'] = '';
        $dato['reservaactivo'] = '';
        $dato['propiedades'] = $this->propiedades_model->obtenerPropiedades();
        $this->load->view('prototipo/primera');
        $this->load->view('prototipo/manejoDeSesion');
        $this->load->view('prototipo/barranav');
        $this->load->view('prototipo/barraizq', $dato);
        $this->load->view('prototipo/propiedadespropietario', $dato);
        $this->load->view('prototipo/footeryscrips');
    }

}

?>