<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function index()
	{
		session_start();
		$this->load->model('notificacion_alerta');
		if (!isset($_SESSION["error"])) {
			$_SESSION["error"] = "";
		}
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
				        //manejo de la alerta de las reservas pendientes a pagar
						$datosAlerta = $this->notificacion_alerta->Alerta();
						$_SESSION['alerta'] = $datosAlerta;
						//////////////////////////
				redirect('paginaInicial');
			} else {
				$_SESSION["error"] = "El nombre de usuario o contraseña es invalido.";
				redirect('Welcome');
			}
		}
		$this->load->view('primera');
		$this->load->view('login', $_SESSION);
	}
}
