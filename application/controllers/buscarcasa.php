<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buscarcasa extends CI_Controller {
    function __construct(){
        parent::__construct();
    }
    function index()
	{
        $dato['inicioactivo'] = '';
        $dato['misalquileresactivo'] = '';
        $dato['reservapendienteactivo'] = '';
        $dato['propiedadactivo'] = '';
        $dato['paqueteactivo'] = '';
        $dato['misreservaactivo'] = '';
        $dato['reservaactivo'] = '';
        $this->load->view('prototipo/primera');
        $this->load->view('prototipo/manejoDeSesion');
        $this->load->view('prototipo/barranav');
        $this->load->view('prototipo/barraizq', $dato);
        //vista a cargar
        $this->load->view('prototipo/buscarcasa');
        $this->load->view('prototipo/footeryscrips');
	}
}