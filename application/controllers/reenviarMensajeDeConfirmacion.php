<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ReenviarMensajeDeConfirmacion extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('reservas_model');
    }
    function index()
    {
        $this->load->view('manejoDeSesion');
        $this->load->view('primera');

        $this->load->helper('form');
        $config = array();
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.googlemail.com';
        $config['smtp_user'] = 'woodenhousenocontestar@gmail.com';
        $config['smtp_pass'] = 'razengan1223';
        $config['smtp_port'] = '465';
        $config['smtp_timeout'] = '7';
        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n";
        $config['mailtype'] = 'text';
        $config['validation'] = TRUE;
        $this->load->library('email', $config);
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $codigo_registro = uniqid();
        $this->load->model('usuario_model');
        $this->usuario_model->ActualizarCodigo($codigo_registro, $_SESSION['correo']);
        $this->email->from('woodenhousenocontestar@gmail.com', 'Wooden House');
        $this->email->to($_SESSION['correo']);
        $this->email->subject('Mensaje reenviado de confirmación de correo electronico');
        $this->email->message("Hola se te reenvio el mensaje de confirmación, debes activar tu cuenta entrando al siguiente enlace: http://localhost/WoodenHouse/index.php/activacion?codigo='$codigo_registro'");

        if ($this->email->send()) {
            $dato['msj']  = 'Se a reenviado el mensaje de confirmación.';
            $this->load->view('mensajeDeConfirmacion', $dato);
        }
        echo $this->email->print_debugger();
        session_destroy();
    }
}
