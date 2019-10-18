<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reservaspendientes extends CI_Controller {
    function __construct(){
        parent::__construct();
    }
    function index()
	{
        $dato['inicioactivo'] = '';
        $dato['misalquileresactivo'] = 'active';
        $dato['reservapendienteactivo'] = 'active';
        $dato['propiedadactivo'] = '';
        $dato['paqueteactivo'] = '';
        $dato['misreservaactivo'] = '';
        $dato['reservaactivo'] = '';
        $this->load->view('prototipo/primera');
        $this->load->view('prototipo/manejoDeSesion');
        $this->load->view('prototipo/barranav');
        $this->load->view('prototipo/barraizq', $dato);
        $this->load->view('prototipo/reservaspendientes');
        $this->load->view('prototipo/footeryscrips');
	}
}