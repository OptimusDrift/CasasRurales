<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reservaspendientes extends CI_Controller {
    function __construct(){
        parent::__construct();
    }
    function index()
	{
        $this->load->view('prototipo/primera');
        $this->load->view('prototipo/barranav');
        $this->load->view('prototipo/barraizq');
        $this->load->view('prototipo/reservaspendientes');
        $this->load->view('prototipo/footeryscrips');
	}
}