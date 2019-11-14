<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ValidarFechas extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("paquetes_model");
        $this->load->model("dormitorio_model");
    }

    function index()
    {
        $fecI = explode(" -", $_POST['fechasAConsisitir'])[0];
        $diaI = explode("/", $fecI)[0];
        $mesI = explode("/", $fecI)[1];
        $annoI = explode("/", $fecI)[2];
        $fecF = explode("- ", $_POST['fechasAConsisitir'])[1];
        $diaF = explode("/", $fecF)[0];
        $mesF = explode("/", $fecF)[1];
        $annoF = explode("/", $fecF)[2];
        $fechaInicial = new DateTime($annoI . "-" . $mesI . "-" . $diaI);
        $FI = new DateTime($annoI . "-" . $mesI . "-" . $diaI);
        $fechaFinal = new DateTime($annoF . "-" . $mesF . "-" . $diaF);
        $mensaje = "";
        if (($FI->diff($fechaFinal)->days - 1) >= $_POST['minNoches']) {
            while ($fechaInicial->diff($fechaFinal)->days > 0) {
                if ($mensaje == 'alquilada') {
                    break;
                }
                $fechaInicial->modify('+1 day');
                for ($i = 0; $i < count($_POST['fechasParaConsisitir']); $i++) {
                    $f = new DateTime($_POST['fechasParaConsisitir'][$i]);
                    //echo $fechaInicial->format('Y-m-d') .  " " . $_POST['fechasParaConsisitir'][$i] . "  ->  " . $fechaInicial->diff($f)->days . "<br>";
                    if ($fechaInicial->diff($f)->days == 0) {
                        $mensaje = 'alquilada';
                        break;
                    }
                }
            }
            if ($mensaje != 'alquilada') {
                $mensaje = "El precio total es de: $" . ($FI->diff($fechaFinal)->days - 1) * $_POST['precio'];
            }
        } else {
            $mensaje = 'minNoches';
        }

        echo $mensaje;
    }
}
