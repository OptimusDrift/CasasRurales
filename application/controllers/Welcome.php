<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		session_start();
		//session_destroy();
		if (isset($_SESSION['correo'])) {
			redirect('prototipo');
		  } else if (isset($_POST['contrasenna']) && isset($_POST['correo'])) {
			$this->load->model('usuario_model');
			$usuario = $this->usuario_model->login($_POST['correo'], md5($_POST['contrasenna']));
            if (isset($usuario)) {
				$_SESSION['nombre'] = $usuario->nombre;
				$_SESSION['apellido'] = $usuario->apellido;
				$_SESSION['correo'] = $_POST['correo'];
				redirect('prototipo');
            }else {
                redirect('login#FAIL');
            }
		  }
		$this->load->view('prototipo/primera');
		$this->load->view('prototipo/login');
	}
}
