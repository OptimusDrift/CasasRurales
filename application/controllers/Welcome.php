<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function index()
	{
		session_start();
		if (isset($_SESSION['correo'])) {
			redirect('paginaInicial');
		} else if (isset($_POST['contrasenna']) && isset($_POST['correo'])) {
			$this->load->model('usuario_model');
			$usuario = $this->usuario_model->login($_POST['correo'], md5($_POST['contrasenna']));
			if (isset($usuario)) {
				$_SESSION['nombre'] = $usuario->nombre;
				$_SESSION['apellido'] = $usuario->apellido;
				$_SESSION['id'] = $usuario->id_usuario;
				$_SESSION['correo'] = $_POST['correo'];
				redirect('paginaInicial');
			} else {
				redirect('login#FAIL');
			}
		}
		$this->load->view('primera');
		$this->load->view('login');
	}
}
