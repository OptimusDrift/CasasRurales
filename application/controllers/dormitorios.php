<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dormitorios extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("paquetes_model");
        $this->load->model("dormitorio_model");
    }

    function index()
    {
        $mensaje = "<ul class='py-2'>";
        if ($_POST['idDormitorio'] == 0) {
            $fechas = $this->paquetes_model->ObtenerDiasReservados($_POST['idPaquete']);
            $mensaje .= '<li>';
            $cant = 0;
            foreach ($_POST['lista'] as $lista) {
                $cant += intval($lista);
            }
            $mensaje .= 'Cantidad de personas: ' . $cant . '
            </li>';
        } else {
            $fechas = $this->paquetes_model->ObtenerDiasReservadosDormitorio($_POST['idDormitorio']);
            $mensaje .= '<li> 
                Cantidad de personas: ' . $_POST['lista'][$_POST['val']] . '
                </li>
                ';
        }
        $mensaje .= '</ul>';
        $mensaje .= '<form action="controlarreserva" method="post">
            <div class="form-inline py-2 mt-2">
                <div class="input-group input-group">
                    <div class="input-group-prepend">
                        <span class="btn btn-dark">
                            <i class="fas fa-calendar-alt"></i>
                        </span>
                    </div>
                    <input name="fechas" class="form-control" type="text" id="reservar" >
                </div>
            </div>
            <div class="form-inline py-2">
            <input hidden="">
                <div class="input-group input-group">
                    <div class="input-group-prepend">
                        <span class="btn btn-dark">
                            <i class="fas fa-phone"></i>
                        </span>
                    </div>
                    <input class="form-control" size="5" maxlength="4" type="telephone" id="area" name="ar" placeholder="Area (011)">
                </div>
                <div class="input-group input-group">
                    <input class="form-control" type="telephone" id="telefono" name="tel" placeholder="Ingresa tu teléfono sin 15.">
                </div>
                </div>
            <div class="mt-2">
                <button class="btn btn-primary btn-lg" type="submit"><i class="fas fa-cart-plus fa-lg mr-2"></i> Reservar</button>
            </div>
        </form>';
        echo $mensaje . "~" . $fechas;
        //$this->dormitorio_model->obtenerDormitorio($_POST['valorBusqueda']);
    }
}
