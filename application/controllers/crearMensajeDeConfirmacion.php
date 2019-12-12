
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CrearMensajeDeConfirmacion extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('reservas_model');
    }
    function index()
    {
        $this->load->view('primera');
        $codigo_registro = uniqid();
        if ($this->usuario_model->NuevoUsuario($_POST['Correo'], $_POST['CUIL'], $_POST['Nombre'], $_POST['Apellido'], $_POST['CBU'], md5($_POST['Cont']), $_POST['Tel'], $codigo_registro)) {
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
            $this->load->model('usuario_model');
            $this->usuario_model->ActualizarCodigo($codigo_registro, $_POST['Correo']);
            $this->email->from('woodenhousenocontestar@gmail.com', 'Wooden House');
            $this->email->to($_POST['Correo']);
            $this->email->subject('Mensaje de confirmación de correo electronico');
            $this->email->message("Hola " . $_POST['Nombre'] . " " . $_POST['Apellido'] . " debes activar tu cuenta entrando al siguiente enlace: http://localhost/WoodenHouse/index.php/activacion?codigo=$codigo_registro");

            if ($this->email->send()) {
                $dato['msj']  = 'Se a enviado el mensaje de confirmación.';
                $this->load->view('mensajeDeConfirmacion', $dato);
            }
        }
        echo $this->email->print_debugger();
    }
}
