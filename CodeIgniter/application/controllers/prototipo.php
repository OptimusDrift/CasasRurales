<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prototipo extends CI_Controller {
    function __construct(){
        parent::__construct();
    }
    function index()
	{
        $this->load->view('prototipo/primera');
        $this->load->view('prototipo/barranav');
        $this->load->view('prototipo/barraizq');
        $this->load->view('prototipo/template');
        $this->load->view('prototipo/footeryscrips');
	}
}