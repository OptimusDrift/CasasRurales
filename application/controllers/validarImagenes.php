<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ValidarImagenes extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('reservas_model');
    }
    function index()
    {
        $this->load->view('manejoDeSesion');

        //?Nombre de la imagen
        //$_FILES['imagen']['name'];
        //?Desde donde se sube
        //$_FILES['imagen']['tmp_name'];
        if ($_FILES['imagen']['name'] == "") {
            redirect('ReservasrealizadasCI');
        }
        $formato = explode(".", $_FILES['imagen']['name'])[1];
        if ($formato == "jpg" || $formato == "JPG") {
            $idReserva = $_POST['idReserva'];
            $link = "C:/wamp64/www/WoodenHouse/comprobantes/" . $idReserva . "/";
            if (!file_exists($link)) {
                mkdir($link, 0777, true);
            }
            if ($this->reservas_model->SubirImagenReserva($idReserva, $_FILES['imagen']['name'])) {
                copy($_FILES['imagen']['tmp_name'], $link . $_FILES['imagen']['name']);
                $this->reservas_model->PagarReserva($idReserva);
            }
            redirect('ReservasrealizadasCI');
        } else {
            echo '<script>confirm("La imagen ingresada no es .jpg"); window.location= "ReservasrealizadasCI"</script>';
        }
    }
}
