<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Activacion extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('usuario_model');
    }

    function index()
    {
        $dato['red'] = "Welcome";
        $dato['error'] = "";
        if (isset($_GET['codigo'])) {
            if ($this->usuario_model->ActivarUsuario($_GET['codigo'])) {
                $dato['mensaje'] = "Tu cuenta ha sido activada. Inicia sesión para continuar.";


                $this->load->view('primera');
                $this->load->view('login', $dato);
            }
        } else {
            $dato['mensaje'] = "Inicia sesión para comenzar.";
            $this->load->view('login', $dato);
        }
    }
}
